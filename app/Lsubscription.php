<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Psubscription;
use App\Ldeduction;
use App\Defaultcharge;
use App\User;
use App\Charts\membershipSpread;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class Lsubscription extends Model
{
    //
    protected $fillable = [
        'product_id',
        'user_id',
        'ref',
        'guarantor_id1',
        'guarantor_id2',
        'amount_approved',
        'loan_start_date',
        'loan_end_date',
        'custom_tenor',
        'amount_applied',
        'monthly_deduction',
        'net_pay',
        'disbursement_date',
    ];


        //relationship with product
        public function product(){
        return $this->belongsTo(Product::class,'product_id');
        }

      //relationship with user
        public function user(){
        return $this->belongsTo(User::class);
        }

        //loan relationship
        // //Each loan subscription belongs to a loan
        // public function loan(){
        //     return $this->belongsTo(Loan::class);
        // }
        //A loan subscription may have many deductions
        public function loandeductions(){
          return $this->hasMany(Ldeduction::class);
      }

      //A loan subscription may have many entrries in user consolidated loan
      public function consolidatedloans(){
        return $this->hasMany(Userconsolidatedloan::class);
    }
       //A loan subscription may have many defaults
       public function loandefault(){
        return $this->hasMany(Defaultcharge::class);
    }

    protected $dates = ['created_at', 'updated_at','loan_start_date','loan_end_date','disbursement_date'];


    // public function testFunction(){
    //     $filterResult = Lsubscription::whereBetween('created_at',[$this->start_date,$this->end_date])
    //     ->with(['loan','user']);
    //     return $filterResult->where('repayment_mode',$this->pay_type)->unique('user_id');
    // }

    //All active loan subscriptions
    public static function loanSubscriptions(){
         return  static::where('loan_status', 'Active')
         ->with(['user','product'])
         ->get();
    }

    //all loans by user
    public static function allLoans($user_id){
         return  static::where('user_id', $user_id)
                        ->with(['user','product'])
                        ->get();
    }

     //Filter loan subscriptions
     public static function filterResult($start_date,$end_date){
        return static::where('loan_start_date','>=',$start_date)
                        ->where('loan_end_date','<=',$end_date)
                        ->where('loan_status','Active')
                        ->get();
        //return $result->where('repayment_mode',$pay_type);
    }

    //distinct user loan subscriptions
    //TODO : Include the orWhere clause to cater for defaulted loans
    public static function distinctUserLoanSub(){
        $records = static::where('loan_status', 'Active')
                        //->orWhere('loan_status','Defaulted')
                        ->with(['user','product'])
                        ->get();
       return $records->unique('user_id');
   }

//function to fetch loans by disbursement
public function findLoansByDisbursementDate($date){

    $records = Lsubscription::where('disbursement_date', $date)
                            ->orWhere('disbursement_date',$date)
                            ->get();
   return $records;
}

    //Sum cumulative amount of IPPIS
    public  function totalIppisDeductions($_id,$activeLoans)
    {
      //TODO  Include a start date parameter to help select only loans that are due
      $monthly_Deductions = $activeLoans->where('user_id',$_id)
                          ->sum('monthly_deduction');
                          $totalDeficit = Defaultcharge::deficitTotal($_id);
                          $totalDefaultCharge = Defaultcharge::defaultChargesTotal($_id);
                          return $monthly_Deductions + $totalDeficit + $totalDefaultCharge;

    }

  //method to check loan payment
  public function loanBalance($id){

    $loanSub = Lsubscription::find($id);
    $loanAmount = $loanSub->amount_approved;
     //$loanAmount = $loanSub->amount_approved+$loanSub->topup_amount;

    //3 get sum deductions for the product

   $totalDeductions =  $loanSub->totalLoanDeductions($id);
   //$totalDeductions =  number_format($totalDeductions,2,'.',',');
    //find the diff
    $diffRslt = $loanAmount-$totalDeductions;

    //if($diffRslt <= 0){
    if($diffRslt == 0){
        $loanSub->loan_status = 'Inactive';
        $loanSub->save();
    }elseif($diffRslt < 0){
      $loanSub->loan_status = 'overpaid';
      $loanSub->save();
    }

}

//All loan balances by date
public function allLoanBalancesByDate($collection,$id)
{
    $sumBal=0;

    $user_subscriptions = $collection->where('user_id', '=', $id);


    foreach($user_subscriptions as $item){
        //$totalBal=0;
        $approved_amt = $item->amount_approved;
        //$topup_amt = $item->topup_amount;
        //$principal = $approved_amt + $topup_amt;
        //select all deductions by sub_id
        $deductionCollection = Ldeduction::where('lsubscription_id',$item->id)
                                          ->get();
        $loanCredit = $deductionCollection->sum('amount_deducted');
        $loanDebit = $deductionCollection->sum('amount_debited');
        $totalDeductions = $loanCredit-$loanDebit;
        //$deductions = $lsub->totalLoanDeductions($item->id);
        $bal = $approved_amt-$totalDeductions;
        $sumBal = $sumBal+$bal;
    }
    return $sumBal;
}

/**
 * Total saving aggregate
 */
    public function loanBalanceAggregateAt($collection){
      $sumBal=0;



      foreach($collection as $item){

            //total approved loan amount
          $totalApprovedAmt = $collection->where('id',$item->id)
                                           ->sum('amount_approved');


          $deductionCollection = Ldeduction::where('lsubscription_id',$item->id)
                                            ->get();
          $loanCredit = $deductionCollection->sum('amount_deducted');
          $loanDebit = $deductionCollection->sum('amount_debited');
          $totalDeductions = $loanCredit-$loanDebit;

          $bal = $totalApprovedAmt-$totalDeductions;
          $sumBal = $sumBal+$bal;
      }
      return $sumBal;
    }

    //user loan end date
    public function loanEndDate($_id){
        $loanSubObj = Lsubscription::where('user_id',$_id)
        ->where(function($query){
            $query->where('loan_status','Active');
        })
        ->orderBy('loan_end_date','asc')->take(1)->first();

        return $loanSubObj->loan_end_date;
    }


    //subscription end date

    public function SubEndDate($date,$tenor){
        $date_val = new Carbon($date);
        return $date_val->addMonths($tenor)->toDateString();
    }

    //user Product Subscription
    // public function productSubEndDate($_id){
    //     $prodSub = Psubscription::where('user_id',$_id)
    //     ->where(function($query){
    //         $query->where('status','Active');
    //     })
    //     ->orderBy('end_date','desc')->take(1)->first();
    //     if($prodSub == ""){
    //     //Do nothing
    //     }else{
    //         return $prodSub->end_date;
    //     }
    // }
    //compare dates
    // public function compareDates($prodDate,$loanDate){
    //     if($prodDate){
    //         //check which one one is bigger
    //         if($prodDate < $loanDate){
    //             return $loanDate;
    //         }else{
    //             return $prodDate;
    //         }
    //     }else{
    //         return $loanDate;
    //     }
    // }

    //Individual loan deductions
    public  function userLoanDeductions($_id)
    {
        $loanSub = Lsubscription::where('user_id',$_id)
        ->where(function($query){
            $query->where('loan_status','Active');
        })
        ->sum('monthly_repayment');
    }

    //User Active loans
    public static function activeLoans($id){
        return static::where('user_id',$id)
        ->where(function ($query){
            $query->where('loan_status','Active');
        })->with(['product' => function ($query) {
        $query->orderBy('name', 'desc');
        }])
        ->oldest('disbursement_date')->get();
    }

    //user inactive loan
    public static function inactiveLoans($id){
        return static::where('user_id',$id)
                      ->where('loan_status','Inactive')
                      ->get();
    }

    //user paid loans
    public static function paidLoans($id){
        return static::where('user_id',$id)
        ->where(function ($query){
            $query->where('loan_status','Paid');
        })->with(['product' => function ($query) {
        $query->orderBy('name', 'desc');
        }])->get();
    }

      //User pending loans
public static function pendingLoans($id){
  return static::where('user_id',$id)
        ->where(function ($query){
            $query->where('loan_status','=','Pending');
        })->with(['product' => function ($query) {
        $query->orderBy('name', 'desc');
        }])->get();
}

//User over paid subscriptions

public static function overPaidLoans(){
        return static::where('loan_status','overpaid')
              ->orderBy('user_id', 'asc')
              ->get();
      }

//Find Total deduction for a given loan subscription
//Pass in loan subscription id
public  function totalLoanDeductions($loan_id)
{
    $loanDeductObj = new Ldeduction;
    $loanCredit = $loanDeductObj->totalLoanCredit($loan_id);
    $loanDebit = $loanDeductObj->totalLoanDebit($loan_id);
   return $loanBalance = $loanCredit - $loanDebit;
    //return Ldeduction::where('lsubscription_id',$loan_id)
                       //->sum('amount_deducted');
}

   //Product guarantor count
   public function guarantor($id){
    //find user
     $user = User::find($id);
     return $user->first_name .' '.$user->last_name;
}


//Unique loan guarantos
public function uniqueGuarantors(){

  $g1 = DB::table('lsubscriptions')
          ->whereNotNull('guarantor_id1')
          ->where('loan_status','active')
          ->pluck('guarantor_id1');
  $g2 = DB::table('lsubscriptions')
          ->whereNotNull('guarantor_id2')
          ->where('loan_status','active')
          ->pluck('guarantor_id2');
  $concatenated = $g1->concat($g2);
  return $uniqueGuarantors = $concatenated->unique();
}

//first guarantor
public static function guarantorAsFirst($userid){
 return static::where('guarantor_id1', '=', $userid)
                ->get();
}

// //second guarantor
public static function guarantorAsSecond($userid){
return static::where('guarantor_id2', '=', $userid)
                    ->get();

}

//total number loans guaranteed by a user
public function loanGuarantorCount($id){

 $g1 = Lsubscription::where('guarantor_id1', '=', $id)
                    ->where('loan_status','Active')
                    ->count();
 $g2 = Lsubscription::where('guarantor_id2', '=', $id)
                      ->where('loan_status','active')
                    ->count();
          return $g1+$g2;
}

//find total liability by user
public function totalLiability($user_id){
$g1=0.0;
$g2=0.0;
  //select all active loans guranteed as a first guarantor
  $guarantor1 = Lsubscription::where('guarantor_id1',$user_id)
                      ->where('loan_status','Active')
                      ->get();
        if($guarantor1->count()>=1){
          foreach($guarantor1 as $firstg){
          $bal= $this->findCompleteBalance($firstg->id);
            $g1 = $g1+$bal;
          }
        }


      //select all active loans guranteed as second  guarantor
      $guarantor2 = Lsubscription::where('guarantor_id2',$user_id)
                          ->where('loan_status','Active')
                          ->get();
          if($guarantor2->count()>=1){
            foreach($guarantor2 as $secondg){
            $bal2= $this->findCompleteBalance($secondg->id);
              $g2 = $g2+$bal2;
            }
          }

    return $g1+$g2;
  // $sumBal =0;
  // $userGuaranteedLoans = $this->uniqueDebtors($user_id);
  //  foreach($userGuaranteedLoans as $user ){
  //    $newUser = new User;
  //    $bal = $newUser->allLoanBalances($user);
  //    $sumBal =$sumBal+$bal;
  //  }
  //  return $sumBal*0.5;
}

//Unique active loans by a given user
public function uniqueDebtors($userid){

  $g1 = DB::table('lsubscriptions')
            ->where('guarantor_id1',$userid)
            ->where('loan_status','active')
            ->pluck('user_id');
  $g2 = DB::table('lsubscriptions')
            ->where('guarantor_id2',$userid)
            ->where('loan_status','active')
            ->pluck('user_id');
  $concatenated = $g1->concat($g2);
  return $uniqueDebtors = $concatenated->unique();
}

/**
 * Get user total loan loan balance
 * pass in user id
 * @param int $subid
 */
public function findCompleteBalance($subid){
    $ldeductionObj = new Ldeduction;
    $loan = Lsubscription::find($subid);
    //$principal = $loan->amount_approved+$loan->topup_amount;
    $principal = $loan->amount_approved;
    $totalDeductions = $ldeductionObj->totalLoanCredit($subid)-$ldeductionObj->totalLoanDebit($subid);
    return $balance = $principal-$totalDeductions;
  }

public static function subGroup(){

    // $result = static::selectRaw('products.name AS Product, count(*) Numbers')
    //         ->join('products', 'products.id', '=', 'lsubscriptions.product_id')
    //         ->groupBy('products.name')
    //         ->orderBy('Numbers', 'DESC')
    //         ->get();

            $active = Lsubscription::where('loan_status', 'Active')->count();
            $pending = Lsubscription::where('loan_status', 'Pending')->count();
            $reviewed = Lsubscription::where('loan_status', 'Reviewed')->count();
            $paid = Lsubscription::where('loan_status', 'Paid')->count();

            $status_chart = new membershipSpread;
            $status_chart->labels(['Active','Pending','Reviewed','Paid']);
            $status_chart->dataset('Loan Status', 'line', [$active,$pending,$reviewed,$paid]);
            return $status_chart;
}

//user activity
public static function userActivity($id){
                $id = $id;

            $active = Lsubscription::where('user_id',$id)
                                    ->where('loan_status', 'Active')
                                    ->count();
            $pending = Lsubscription::where('user_id',$id)
                                    ->where('loan_status', 'Pending')
                                    ->count();
            $reviewed = Lsubscription::where('user_id',$id)
                                    ->where('loan_status', 'Reviewed')
                                    ->count();
            $paid = Lsubscription::where('user_id',$id)
                                    ->where('loan_status', 'Paid')
                                    ->count();

            $userActivity = new membershipSpread;
            $userActivity->labels(['Active','Pending','Reviewed','Paid']);
            $userActivity->dataset('Foot Prints', 'line', [$active,$pending,$reviewed,$paid]);
            return $userActivity;
}

//return user photo

public function userPhoto($id){
    $user= User::find($id);
    return $user->photo;
}

//image count
public function imageCount($user_id){
  $gs = DB::table('users')->select('photo')
                          ->where('id',$user_id)
                          ->whereNotNull('photo')
                          ->get();
    return $gs->count();
}



}
