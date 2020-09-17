<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userconsolidatedloan extends Model
{

  protected $fillable = [
     'user_id',
     'lsubscription_id',
     'amount_deducted',
     'entry_month',
     'notes',
     'uploaded_by',
 ];

protected $dates = ['created_at', 'updated_at','date_entry'];

    //relationship with user
      public function user(){
      return $this->belongsTo(User::class);
      }

        //Each record belongs to a loan subscription
        public function loansubscription(){
            return $this->belongsTo(Lsubscription::class,'lsubscription_id');
        }


        //Recalculate loan Balances, pass in subscription id
        public function userConsolidatedBalances($userid){

                          //recalculate loan Balances
                          $consolidatedLoanDeductions = Userconsolidatedloan::
                                            where('user_id',$userid)
                                            ->orderBy('date_entry', 'asc')
                                            ->orderBy('entry_time', 'asc')
                                            ->get();

                                  //loop to update balances to zero
                                  foreach($consolidatedLoanDeductions as $item){
                                    $deductItem = Userconsolidatedloan::find($item->id);
                                    $deductItem->balance = 0.0;
                                    $deductItem->save();
                                  }

                                  //loop to update actual Balances
                                  foreach($consolidatedLoanDeductions as $item){

                                    //1. select all records based on that date
                                    $loanDeductionsByDate = $consolidatedLoanDeductions
                                                       ->where('date_entry','=',$item->date_entry)
                                                       ->sortBy('id');

                                    //2. check if there is more than 1 records
                                    if($loanDeductionsByDate->count() > 1){
                                      //find all deductions less than this date
                                      $loanDeductionsLessDate = $consolidatedLoanDeductions
                                                         ->where('date_entry','<',$item->date_entry)
                                                         ->sortBy('date_entry');
                                      //find the total balance
                                      $credit = $loanDeductionsLessDate->sum('credit');
                                      $debit = $loanDeductionsLessDate->sum('debit');
                                      $lessDateBalance =  $debit - $credit;

                                      //enter foreach loop
                                      foreach($loanDeductionsByDate as $deduction){
                                        $loanDeductionsByDateFilter = $loanDeductionsByDate->where('id','<',$deduction->id);

                                        $credit = $loanDeductionsByDateFilter->sum('credit');
                                        $debit = $loanDeductionsByDateFilter->sum('debit');
                                        $filterDateBalance = $debit - $credit;
                                        //add filter date balance with less balance and update new balance for that row

                                        //find individual row
                                        $deductItem = Userconsolidatedloan::find($deduction->id);
                                        $credit = $deductItem->credit;
                                        $debit = $deductItem->debit;
                                        $diffBal = $debit - $credit;
                                        $deductItem->balance = $lessDateBalance + $filterDateBalance + $diffBal;
                                        $deductItem->save();
                                      }

                                    }
                                    else
                                    {

                                      //total loan Balances
                                      $loanBalances = $this->initialConsolidatedLoanBalances($item->user_id,$item->date_entry);

                                      //find individual row
                                      $deductItem = Userconsolidatedloan::find($item->id);
                                      $credit = $deductItem->credit;
                                      $debit = $deductItem->debit;
                                      $myBal = $debit-$credit;
                                      $deductItem->balance = $loanBalances + $myBal;
                                      $deductItem->save();
                                    }

                            }

        }

        //method to sum initial zero balances after and update or deleted

        public function initialConsolidatedLoanBalances($userid,$entry_date)
        {
          $loanDeductions = Userconsolidatedloan::
                             where('user_id',$userid)
                             ->where('date_entry','<',$entry_date)
                             ->orderBy('date_entry', 'asc')
                             ->orderBy('entry_time', 'asc')
                             ->get();


                            $credit = $loanDeductions->sum('credit');
                            $debit = $loanDeductions->sum('debit');
                            return $balance = $debit - $credit;
        }
}
