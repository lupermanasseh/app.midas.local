<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Lsubscription;
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

        return  $collection =    Lsubscription::
                                 where('disbursement_date','>=',$from)
                                ->where('disbursement_date','<=',$to)
                                ->where('loan_status','Active')
                                ->orderBy('user_id', 'asc')
                                ->get();

        }

    //Recalculate loan Balances, pass in subscription id
    public function recalculateLoanDeductionBalances($subid){

                      //recalculate loan Balances
                      $loanDeductions = Ldeduction::
                                        where('lsubscription_id',$subid)
                                        ->orderBy('entry_month', 'asc')
                                        ->get();

                              //loop to update balances to zero
                              foreach($loanDeductions as $item){
                                $deductItem = Ldeduction::find($item->id);
                                $deductItem->balances = 0.0;
                                $deductItem->save();
                              }

                              //loop to update actual Balances
                              foreach($loanDeductions as $item){

                                //1. select all records based on that date
                                $loanDeductionsByDate = $loanDeductions
                                                   ->where('entry_month','=',$item->entry_month)
                                                   ->sortBy('id');

                                //2. check if there is more than 1 records
                                if($loanDeductionsByDate->count() > 1){
                                  //find all deductions less than this date
                                  $loanDeductionsLessDate = $loanDeductions
                                                     ->where('entry_month','<',$item->entry_month)
                                                     ->sortBy('entry_month');
                                  //find the total balance
                                  $credit = $loanDeductionsLessDate->sum('amount_deducted');
                                  $debit = $loanDeductionsLessDate->sum('amount_debited');
                                  $lessDateBalance = $credit - $debit;

                                  //enter foreach loop
                                  foreach($loanDeductionsByDate as $deduction){
                                    $loanDeductionsByDateFilter = $loanDeductionsByDate->where('id','<',$deduction->id);

                                    $credit = $loanDeductionsByDateFilter->sum('amount_deducted');
                                    $debit = $loanDeductionsByDateFilter->sum('amount_debited');
                                    $filterDateBalance = $credit - $debit;
                                    //add filter date balance with less balance and update new balance for that row

                                    //find individual row
                                    $deductItem = Ldeduction::find($deduction->id);
                                    $credit = $deductItem->amount_deducted;
                                    $debit = $deductItem->amount_debited;
                                    $deductItem->balances = $lessDateBalance + $filterDateBalance + $credit-$debit;
                                    $deductItem->save();
                                    //check for loan balance
                                    $loanSub->loanBalance($deduction->lsubscription_id);
                                  }

                                }
                                else
                                {
                                  //loansubscription object
                                  $loanSub = new Lsubscription;
                                  //total loan Balances
                                  $loanBalances = $this->sumInitialBalances($item->lsubscription_id,$item->entry_month);

                                  //find individual row
                                  $deductItem = Ldeduction::find($item->id);
                                  $credit = $deductItem->amount_deducted;
                                  $debit = $deductItem->amount_debited;
                                  $deductItem->balances = $loanBalances + $credit-$debit;
                                  $deductItem->save();
                                  //check for loan balance
                                  $loanSub->loanBalance($item->lsubscription_id);
                                }

                        }

    }

    //method to sum initial zero balances after and update or deleted

    public function sumInitialBalances($subid,$entry_date)
    {
      $loanDeductions = Ldeduction::
                         where('lsubscription_id',$subid)
                         ->where('entry_month','<',$entry_date)
                         ->orderBy('entry_month', 'asc')
                         ->get();

                        //$filteredDeduction = $loanDeductions->whereNotIn()
                      //Find sum of credit and debit to calcultae balance
                        $credit = $loanDeductions->sum('amount_deducted');
                        $debit = $loanDeductions->sum('amount_debited');
                        return $balance = $credit - $debit;
    }
}
