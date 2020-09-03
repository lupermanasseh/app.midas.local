<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Ldeduction extends Model
{

     protected $fillable = [
        'user_id',
        'product_id',
        'lsubscription_id',
        'amount_deducted',
        'entry_month',
        'notes',
        'uploaded_by',
    ];

    protected $dates = ['created_at', 'updated_at','entry_month'];

     //Each loan deduction belongs to a user
     public function user(){
        return $this->belongsTo(User::class);
    }

    //Each loan deduction belongs to a loan subscription
    public function loansubscription(){
        return $this->belongsTo(Lsubscription::class,'lsubscription_id');
    }

      //Each loan deduction belongs to a loan Product
    //   public function loan(){
    //     return $this->belongsTo(Loan::class);
    // }

    //Each loan deduction belongs to a loan Product
    public function product(){
        return $this->belongsTo(Product::class);
    }

    //Loan Deduction history
    //pass in subscription id
    public static function loanHistory($id){
        // return static::where('lsubscription_id',$id)
        // ->with(['product' => function ($query) {
        // $query->orderBy('name', 'desc');
        // }])->oldest()->get();

        return static::where('lsubscription_id',$id)
                      ->oldest('entry_month')->get();
    }

     /**
     * Total debit by the user using lsubscription id
     * @param int $id
     */
    public function totalLoanDebit($id){
        return Ldeduction::where('lsubscription_id',$id)
                           ->sum('amount_debited');
    }

    /**
     * Total debit by the user using lsubcription id
     * @param int $id
     */
    public function totalLoanCredit($id){
        return Ldeduction::where('lsubscription_id',$id)
                         ->sum('amount_deducted');
    }


    /**
     * Get user total loan deductions
     * pass in user id
     * @param int $subid
     */
    public static function myLoanDeductions($subid){
        $ldeductionObj = new Ldeduction;
        //$totalSaving = Saving::where('user_id',$id)->sum('amount_saved');
        return $totalDeductions = $ldeductionObj->totalLoanCredit($subid)-$ldeductionObj->totalLoanDebit($subid);
      }

       /**
     * Find loan deductions by date
     */
    public function findLoanDeductionByDate($from,$to){
        $from = new Carbon($from);
        $from = $from->toDateString();
        $destDate = new Carbon($to);
        $to = $destDate->toDateString();
        return  $collection =    Ldeduction::
                                 where('entry_month','>=',$from)
                                ->where('entry_month','<=',$to)
                                ->orderBy('user_id', 'asc')
                                //->oldest()
                                ->get();

        }

        //All loan balances by date
        public function allLoanBalancesByDate($collection,$id)
        {
            $sumBal=0;
            //$lsub = new Lsubscription;
            // $all_loans = Lsubscription::where('user_id', '=', $id)
            // ->where(function ($query) {
            //     $query->where('loan_status', '=', 'Active');
            // })->get();
            $user_subscriptions = $collection->where('user_id', '=', $id)
                                              ->unique('lsubscription_id');


            foreach($user_subscriptions as $item){
                //$totalBal=0;
                $approved_amt = $item->loanSubscription->amount_approved;
                $loanCredit = $collection->where('lsubscription_id', $item->lsubscription_id)
                                          ->sum('amount_deducted');
                $loanDebit = $collection->where('lsubscription_id', $item->lsubscription_id)
                                          ->sum('amount_debited');
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

          $unique_subscriptions = $collection->unique('lsubscription_id');

          foreach($unique_subscriptions as $item){
              //$totalBal=0;
              $approved_amt = $item->loanSubscription->amount_approved;
            
              $loanCredit = $collection->where('lsubscription_id', $item->lsubscription_id)
                                        ->sum('amount_deducted');
              $loanDebit = $collection->where('lsubscription_id', $item->lsubscription_id)
                                        ->sum('amount_debited');
              $totalDeductions = $loanCredit-$loanDebit;
              //$deductions = $lsub->totalLoanDeductions($item->id);
              $bal = $approved_amt-$totalDeductions;
              $sumBal = $sumBal+$bal;
          }
          return $sumBal;
        }
}
