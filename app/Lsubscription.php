<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Psubscription;
use App\Ldeduction;
use App\User;
use App\Charts\membershipSpread;

use Carbon\Carbon;
use Calendar;

class Lsubscription extends Model
{
    //
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
                        ->where('loan_start_date','<=',$end_date)
                        ->where('loan_status','Active')
                        ->get();
        //return $result->where('repayment_mode',$pay_type);
    }

    //distinct user loan subscriptions
    public static function distinctUserLoanSub(){
        $records = static::where('loan_status', 'Active')
        ->with(['user','product'])
        ->get();
       return $records->unique('user_id');
   }

    //Sum cumulative amount of IPPIS
    public  function totalIppisDeductions($_id,$activeLoans)
    {
                    return $activeLoans->where('user_id',$_id)
                                       ->sum('monthly_deduction');
                            
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
        }])->get();
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
            $query->where('loan_status','!=','Active');
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

//Calendar function
public static function myCalendar($user_id){
    $events=[];
    $data = Lsubscription::where('user_id',$user_id)
                         ->where('loan_status', 'Active')
                         ->get();
        if($data->count()) {
        foreach ($data as $key => $value) {
        $events[] = Calendar::event(
        $value->title,
        true,
        new Carbon($value->loan_start_date),
        new Carbon($value->loan_end_date),
        null,
        // Add color and link on event
        [
        'color' => '#f05050',
        'url' => 'pass here url and any route',
        ]
        );
            }
         }
        return $calendar = Calendar::addEvents($events);
}


      
}
