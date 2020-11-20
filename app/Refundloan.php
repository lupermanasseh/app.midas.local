<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\DB;

class Refundloan extends Model
{
    //
    protected $fillable = [
        'product_id',
        'user_id',
        'credit',
        'debit',
        'status',
        'refund_balance',
        'reference',
        'transaction_date',
    ];

protected $dates = ['created_at', 'updated_at','transaction_date'];
//relationship with product
public function product(){
return $this->belongsTo(Product::class,'product_id');
}

//relationship with user
public function user(){
return $this->belongsTo(User::class);
}


/// recalculate balances
public function recalculateRefundBalances($userid){

                  $refundsAvailable = Refundloan::
                                    where('user_id',$userid)
                                    ->orderBy('transaction_date', 'asc')
                                    ->get();

                          //loop to update balances to zero
                          foreach($refundsAvailable as $item){
                            $refundItem = Refundloan::find($item->id);
                            $refundItem->refund_balance = 0.0;
                            $refundItem->save();
                          }

                          //loop to update actual Balances
                          foreach($refundsAvailable as $item){

                            //1. select all records based on that date
                            $refundsByDate = $refundsAvailable
                                               ->where('transaction_date','=',$item->transaction_date)
                                               ->sortBy('id');


                            //2. check if there is more than 1 records
                            if($refundsByDate->count() > 1){
                              //find all deductions less than this date
                              $refundsLessDate = $refundsAvailable
                                                 ->where('transaction_date','<',$item->transaction_date)
                                                 ->sortBy('transaction_date');
                              //find the total balance
                              $lesscredit = $refundsLessDate->sum('credit');
                              $lessdebit = $refundsLessDate->sum('debit');
                              $lessDateBalance =  $lessdebit-$lesscredit;

                              //enter foreach loop
                              foreach($refundsByDate as $refund){
                                $refundByDateFilter = $refundsByDate->where('id','<',$refund->id);

                                $filtercredit = $refundByDateFilter->sum('credit');
                                $filterdebit = $refundByDateFilter->sum('debit');
                                $filterDateBalance = $filterdebit-$filtercredit;
                                //add filter date balance with less balance and update new balance for that row

                                //find individual row
                                $updateRefund = Refundloan::find($refund->id);
                                $credit = $updateRefund->credit;
                                $debit = $updateRefund->debit;
                                $bal1 = $lessDateBalance + $filterDateBalance + $debit;
                                $bal2 = $bal1 - $credit;
                                $updateRefund->refund_balance = $bal2;
                                $updateRefund->save();
                                //check for loan balance
                                //$this->updateRefundStatus($userid);
                              }

                            }
                            else
                            {

                              //total loan Balances
                              $refundBalances = $this->initialBalances($item->user_id,$item->transaction_date);

                              //find individual row
                              $updateRefund = Refundloan::find($item->id);
                              $credit = $updateRefund->credit;
                              $debit = $updateRefund->debit;
                              $updateRefund->refund_balance = $refundBalances + $debit-$credit;
                              $updateRefund->save();
                              //check for loan balance
                              //$this->updateRefundStatus($item->user_id);
                            }

                    }

}

//update status of the refund
public function refundBalance($userid){


  $refundsAvailable = Refundloan::
                    where('user_id',$userid)
                    ->get();
  $credit = $refundsAvailable->sum('credit');
  $debit = $refundsAvailable->sum('debit');

  return $balance = $credit-$debit;

}

//find initail balances of the refund table
public function initialBalances($userid,$_date)
{
  $allRefunds = Refundloan::
                     where('user_id',$userid)
                     ->where('transaction_date','<',$_date)
                     ->orderBy('transaction_date', 'asc')
                     ->get();

                    //$filteredDeduction = $loanDeductions->whereNotIn()
                  //Find sum of credit and debit to calcultae balance
                    $credit = $allRefunds->sum('credit');
                    $debit = $allRefunds->sum('debit');
                    return $balance = $debit - $credit;
}

}
