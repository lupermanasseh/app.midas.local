<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Psubscription;
use App\Ldeduction;
use App\Defaultcharge;
use App\User;
use App\Charts\membershipSpread;

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
        //Each loan subscription belongs to a loan
        public function loan(){
            return $this->belongsTo(Loan::class);
        }
        //A loan subscription may have many deductions
        public function loandeductions(){
          return $this->hasMany(Ldeduction::class);
      }

       //A loan subscription may have many defaults
       public function loandefault(){
        return $this->hasMany(Defaultcharge::class);
    }
    
    protected $dates = ['created_at', 'updated_at','loan_start_date','loan_end_date'];


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

    //Sum cumulative amount of IPPIS
    public  function totalIppisDeductions($_id,$activeLoans)
    {
                    $monthly_Deductions = $activeLoans->where('user_id',$_id)
                                       ->sum('monthly_deduction');
                    $totalDeficit = Defaultcharge::deficitTotal($_id);
                    $totalDefaultCharge = Defaultcharge::defaultChargesTotal($_id);
                     return $monthly_Deductions + $totalDeficit + $totalDefaultCharge;
                            
    }

  //method to check loan payment
  public function loanBalance($id){

    $loanSub = Lsubscription::find($id);
    //number_format($active->totalLoanDeductions($active->id),2,'.',',')
    $loanAmount = $loanSub->amount_approved;
    //3 get sum deductions for the product
    $totalDeductions =  $loanSub->totalLoanDeductions($id);
    //find the diff
    $diffRslt = $loanAmount-$totalDeductions;
    dd($diffRslt);
    if($diffRslt <= 0){
        //update the subj obj status to inactive
        //return to active Sub page
        $loanSub->loan_status = 'Inactive';
        $loanSub->loan_end_date = now()->toDateString();
        //$loanSub->review_by = auth()->id();
            $loanSub->save();
    }

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
        ->orderBy('loan_start_date','desc')->get();
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

//Find Total deduction for a given loan subscription
//Pass in loan subscription id
public  function totalLoanDeductions($loan_id)
{
    return Ldeduction::where('lsubscription_id',$loan_id)
                       ->sum('amount_deducted');
}

   //Product guarantor count
   public function guarantor($id){
    //find user
     $user = User::find($id);
     return $user->first_name .' '.$user->last_name;
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


      
}
