<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\IppisAnalysisImport;
use App\Imports\SavingMasterImport;
use App\Imports\LegacyLoanImport;
use App\Imports\LegacyLoanDeductionImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Masterdeduction;
use App\Userconsolidatedloan;
use App\Loanoverdeduction;
use App\User;
use App\Refundloan;
use App\Lsubscription;
use App\Ldeduction;
use App\Product;
use App\Saving;
use App\TargetSaving;
use App\Savingmaster;
use App\Defaultcharge;
use Carbon\Carbon;
class IppisAnalysisController extends Controller
{

    public function ippisError(){
        $errors = DB::table('users')->pluck('payment_number');
        $listIppis = Savingmaster::where('status','Active')->get();

        $filtered = $listIppis->whereNotInStrict('ippis_no',$errors);
        return $filtered;
    }
    //
    public function masterSavingSummary(){
        //
        $title ='Master Saving Summary';
        //$filteredIppis = $this->ippisError();
        $masterRecords= Savingmaster::where('status','Active')
                            //->groupBy('entry_date')
                            ->groupBy(['ref_identification','entry_date'])
                            ->selectRaw('sum(saving_cumulative) as saving, entry_date,ref_identification')
                            ->get();
        return view('IppisAnalysis.uploadSummary',compact('masterRecords','title'));
    }

    //Saving master upload form
    public function savingMasterForm(){
        $title ='Upload Saving Master';
        return view('IppisAnalysis.savingUploadForm', compact('title'));
    }

    //saving master upload functionality
    public function importSavingMaster(){
    //begin transaction
    $rand = $this->randomString();
    DB::beginTransaction();
    try{
    Excel::import(new SavingMasterImport($rand),request()->file('savingmaster_import'));
    }catch(\Exception $ex){
    DB::rollback();
       toastr()->error($ex->getMessage());
        return back();
    }catch(\Error $ex){
     DB::rollback();
        toastr()->error($ex->getMessage());
        return back();
    }
    DB::commit();
    return redirect ('/mastersaving/summary');
    }


    //list master saving records
    public function recentMasterSaving($date,$reference){
        $title = 'Recent IPPIS Savings Inputs';
        $entry_date = new Carbon($date);
        $_date = $entry_date->toDateString();
        //find all recent upload by date created
        $savingMaster = Savingmaster::where('entry_date','=',$_date)
                                     ->where('ref_identification','=',$reference)
                                     ->where('status','Active')
                                     ->paginate(100);

        return view('IppisAnalysis.masterSavingListings',compact('savingMaster','title'));
    }

    //upload IPPIS loan inputs form
    public function ippisAnalysisForm(){
        //
        $title ='Upload Ippis Analysis';
        //dd($allLatestMaster);
        return view('IppisAnalysis.uploadForm',compact('title'));
    }

//Import IPPIS LOAN deduction analysis
public function importIppisAnalysis(){
    //begin transaction
    $rand = $this->randomString();
    DB::beginTransaction();
    try{
    Excel::import(new IppisAnalysisImport($rand),request()->file('ippisanalysis_import'));
    }catch(\Exception $ex){
        DB::rollback();
       toastr()->error($ex->getMessage());
        return back();
    }catch(\Error $ex){
        DB::rollback();
        toastr()->error($ex->getMessage());
        return back();
    }
    DB::commit();

    return redirect ('/recentIppisInputs/listing');

}



//recent ippis upload
public function recentIppisLoanInputs(){
    $title = 'Recent IPPIS  Loan Inputs';
    //find all recent upload by date created
    $loanMaster = Masterdeduction::where('status','Active')
                                ->orderBy('ippis_no','asc')
                                //->oldest('entry_date')
                                ->get();

    return view('IppisAnalysis.masterLoanUploadListings',compact('loanMaster','title'));
}

//Post Analysis

public function postSaving($date,$ref){
    //explore possibility to pass a ref string to the function
    DB::beginTransaction();
    try{

        /**
         * Get the saving records from the master by entry date
         * loop through them and find user_id using the ippis number
         * if user_id is not found based on ippis number, then flag the record in the master
         */

        $dateEntry= new Carbon($date);
        $_date = $dateEntry->toDateString();

        //find all recent upload by date created
        //TODO
        $savingsList = Savingmaster::where('entry_date','=',$_date)
                                    ->where('ref_identification','=',$ref)
                                    ->where('status','Active')
                                    ->get();


        //foreach loop
        foreach($savingsList as $listItem){
            //find the user id using the IPPIS NUMBER
            //TODO: Check for error on the userid returned
            $mySaving = new Saving;
            $user_id = User::userID($listItem->ippis_no);

        if($user_id!=0){
            //find the netbalance of user here
            $currentBalances = Saving::mySavings($user_id);
            $totalBalance = $currentBalances+$listItem->saving_cumulative;
            $mySaving->user_id = $user_id;
            $mySaving->amount_saved = $listItem->saving_cumulative;
            $mySaving->balances = $totalBalance;
            $mySaving->entry_date = $listItem->entry_date;
            $mySaving->notes = $listItem->notes;
            $mySaving->status = 'Active';
            $mySaving->ref_string = $ref;
            $mySaving->created_by = auth()->user()->first_name;
            $mySaving->save();

            //Change the status of the record
            $masterSaving = Savingmaster::find($listItem->id);
            $masterSaving->status =  'Inactive';
            $masterSaving->save();
            }

        }

    }catch(\Exception $e){
        DB::rollback();
        toastr()->error($e->getMessage());
        return back();
    }
    DB::commit();
    toastr()->success('Saving records posted successfully!');
    //redirect to listing page order by latest
    return back();
}

//Post savings individually
public function postMySaving($id){

    DB::beginTransaction();
    try{

        //find user master saaving
        $savingList = Savingmaster::find($id);

            //find the user id using the IPPIS NUMBER
            //TODO: Check for error on the userid returned
            $mySaving = new Saving;
            $user_id = User::userID($savingList->ippis_no);

        if($user_id!=0){
            //find the netbalance of user here
            $currentBalances = Saving::mySavings($user_id);
            $totalBalance = $currentBalances+$savingList->saving_cumulative;
            $mySaving->user_id = $user_id;
            $mySaving->amount_saved = $savingList->saving_cumulative;
            $mySaving->balances = $totalBalance;
            $mySaving->entry_date = $savingList->entry_date;
            $mySaving->notes = $savingList->notes;
            $mySaving->ref_string = $savingList->ref_identification;
            $mySaving->status = 'Active';
            $mySaving->created_by = auth()->user()->first_name;
            $mySaving->save();

            //Change the status of the record

            $savingList->status =  'Inactive';
            $savingList->save();
            }

    }catch(\Exception $ex){
    DB::rollback();
        toastr()->error($ex->getMessage());
        return back();
    }
   DB::commit();
    toastr()->success('Saving records posted successfully!');
    //redirect to listing page order by latest and others XX
    return back();
}


//POST MASTER LOAN DEDUCTION IN BULK
public function postLoanBulk(){

//begin transaction to process uploads
DB::beginTransaction();
try{
  //
  Masterdeduction::where('status','Active')
                    //->orderBy('ippis_no','asc')
                    ->chunkById(100, function ($allMasterDeductions) {
    //1. select all the active Records
    //$allMasterDeductions = Masterdeduction::where('status','Active')
                                          //->orderBy('entry_date','asc')
                                          //->get();
    //2. loop through them and fecth id
    foreach ($allMasterDeductions as $masterDeduction) {
      // code...
      $myLoanSubscription = new Lsubscription;
      //Find user cumulative deduction by id
      $cumulativeDeduct = Masterdeduction::find($masterDeduction->id);
      $user_id = $cumulativeDeduct->ippis_no; // reg no replaces ippis_no in the database



      $activeLoans = Lsubscription::where('loan_status','Active')
                                    ->where('user_id',$user_id)
                                    //->where('loan_start_date','<',$cumulativeDeduct->entry_date)
                                    ->where('disbursement_date','<=',$cumulativeDeduct->entry_date)
                                    ->orderBy('custom_tenor','asc')
                                    ->orderBy('disbursement_date','asc')
                                    ->get();

                  //Check if user has more than one loan
                if($activeLoans->count()>1){


                  //get total ippis deduction
                  $ippisCumulativeDeduction = $cumulativeDeduct->cumulative_amount;
                   // dd($ippisCumulativeDeduction);

                  $myActualLoanAmount = $myLoanSubscription->totalIppisDeductions($user_id,$activeLoans);

                  //dd($myActualLoanAmount);
                          /**
                      * Check for the existence of a default charge
                      * If any pay for it before proceeding
                      * Write a function to find all active defaults
                      */



                      /**
                       * comment out default charge code for now end at ###9
                       */

                      // $defaultCharges = Defaultcharge::where('user_id',$user_id)
                      // ->where('status','Active')
                      // ->oldest('entry_date')
                      // ->get();

                      // if($defaultCharges->isNotEmpty()){

                      //     foreach($defaultCharges as $charge){
                      //         //charged amaount
                      //         $charged_amount = $charge->default_charge;

                      //         if($ippisCumulativeDeduction !=0 && $charged_amount < $ippisCumulativeDeduction){
                      //             $myDefaultCharge = Defaultcharge::find($charge->id);
                      //             $myDefaultCharge->status = 'Paid';
                      //             $myDefaultCharge->created_by = auth()->user()->first_name;
                      //             $myDefaultCharge->save();
                      //             $ippisCumulativeDeduction = $ippisCumulativeDeduction-$charged_amount;
                      //             //$differenceLeft = $differenceLeft-$differenceLeft;
                      //            }
                      //     }

                      // ###9 }

                      //Check for under deduction of loans
                      if($ippisCumulativeDeduction < $myActualLoanAmount){

                        $remainingDeductible = $ippisCumulativeDeduction;
                        dd($remainingDeductible);
                      //initialize  variables
                      foreach($activeLoans as $sub){

                        //check to know loan start date
                        //$subDate = $sub->loan_start_date->toDateString();
                        $disbursementDate = $sub->disbursement_date->toDateString();
                        $entryDate = $cumulativeDeduct->entry_date->toDateString();
                        if($disbursementDate > $entryDate){
                        continue;
                        }else{
                          //actual monthly deduction
                          $currentAmount = $sub->monthly_deduction;
                          //allow for deductions
                         if($currentAmount <= $remainingDeductible){
                         //there is enough to deduct exact value of expected deduction

                          //check for remaining loan balance
                          $loanBal = $sub->findCompleteBalance($sub->id);
                          //check if loan remaining balance is less than actual deduction

                          if($loanBal<=$currentAmount){
                            //create a new deduction
                            $newDeduction = new Ldeduction;
                            //total loan balances
                            $now = Carbon::now()->toTimeString();
                            $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                            $newDeduction->user_id = $sub->user_id;
                            $newDeduction->product_id = $sub->product_id;
                            $newDeduction->lsubscription_id =$sub->id;
                            $newDeduction->amount_deducted = $loanBal;
                            $newDeduction->balances = $loanDeductionBalance + $loanBal;
                            $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                            $newDeduction->entry_time = $now;
                            $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                            $newDeduction->notes = $cumulativeDeduct->description;
                            $newDeduction->uploaded_by = auth()->user()->first_name;
                            $newDeduction->save();
                            $remainingDeductible = $remainingDeductible-$loanBal;

                              //recaculate loan balances
                            $newDeduction->recalculateLoanDeductionBalances($sub->id);
                              //stop loan
                            $myLoanSubscription->loanBalance($sub->id);

                          }else{
                            //create a new deduction
                            $newDeduction = new Ldeduction;
                            //total loan balances
                            $now = Carbon::now()->toTimeString();
                            $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                            $newDeduction->user_id = $sub->user_id;
                            $newDeduction->product_id = $sub->product_id;
                            $newDeduction->lsubscription_id =$sub->id;
                            $newDeduction->amount_deducted = $currentAmount;
                            $newDeduction->balances = $loanDeductionBalance + $currentAmount;
                            $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                            $newDeduction->entry_time = $now;
                            $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                            $newDeduction->notes = $cumulativeDeduct->description;
                            $newDeduction->uploaded_by = auth()->user()->first_name;
                            $newDeduction->save();
                            $remainingDeductible = $remainingDeductible-$currentAmount;

                            //recaculate loan balances
                            $newDeduction->recalculateLoanDeductionBalances($sub->id);
                            //stop loan
                            $myLoanSubscription->loanBalance($sub->id);
                          }//end check for less balance


                          }elseif($currentAmount > $remainingDeductible && $remainingDeductible !=0){
                          //there is no enough to deduct store the value available

                          //check the remaining balance
                          $loanBal = $sub->findCompleteBalance($sub->id);
                          //check if loan remaining balance is less than actual deduction
                          if($loanBal<=$remainingDeductible){
                            //
                            $newDeduction = new Ldeduction;
                            //total loan balances
                            $now = Carbon::now()->toTimeString();
                            $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                            $newDeduction->user_id = $sub->user_id;
                            $newDeduction->product_id=$sub->product_id;
                            $newDeduction->lsubscription_id = $sub->id;
                            $newDeduction->amount_deducted = $loanBal;
                            $newDeduction->balances = $loanDeductionBalance + $loanBal;
                            $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                            $newDeduction->entry_time = $now;
                            $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                            $newDeduction->notes = $cumulativeDeduct->description;
                            $newDeduction->uploaded_by = auth()->user()->first_name;
                            $remainingDeductible = $remainingDeductible-$remainingDeductible;
                            $newDeduction->save();

                            //recaculate loan balances
                            $newDeduction->recalculateLoanDeductionBalances($sub->id);
                              //stop loan
                              $myLoanSubscription->loanBalance($sub->id);
                          }else{
                            $newDeduction = new Ldeduction;
                            //total loan balances
                            $now = Carbon::now()->toTimeString();
                            $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                            $newDeduction->user_id = $sub->user_id;
                            $newDeduction->product_id=$sub->product_id;
                            $newDeduction->lsubscription_id =$sub->id;
                            $newDeduction->amount_deducted = $remainingDeductible;
                            $newDeduction->balances = $loanDeductionBalance + $remainingDeductible;
                            $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                            $newDeduction->entry_time = $now;
                            $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                            $newDeduction->notes = $cumulativeDeduct->description;
                            $newDeduction->uploaded_by = auth()->user()->first_name;
                            $remainingDeductible = $remainingDeductible-$remainingDeductible;
                            $newDeduction->save();
                            //create records in default table
                            // $deficit = $currentAmount-$remainingDeductible;
                            // $percentageDeficit = $deficit*0.1;
                            // $chargeDefault = new Defaultcharge;
                            // $chargeDefault->user_id = $sub->user_id;
                            // $chargeDefault->product_id = $sub->product_id;
                            // $chargeDefault->ippis_no = $ippis_no;
                            // $chargeDefault->lsubscription_id =$sub->id;
                            // $chargeDefault->default_charge = $percentageDeficit;
                            // $chargeDefault->deficit = $deficit;
                            // $chargeDefault->default_reference = $cumulativeDeduct->master_reference;
                            // $chargeDefault->entry_date = $cumulativeDeduct->entry_date;
                            // $chargeDefault->status = 'Active';
                            // $chargeDefault->created_by = auth()->user()->first_name;
                            // $chargeDefault->save();
                            // $remainingDeductible = $remainingDeductible-$remainingDeductible;

                            //recaculate loan balances
                            $newDeduction->recalculateLoanDeductionBalances($sub->id);
                              //stop loan
                              $myLoanSubscription->loanBalance($sub->id);
                          }

                   }elseif($currentAmount > $remainingDeductible && $remainingDeductible ==0){
                     //
                     $newDeduction = new Ldeduction;
                     //total loan balances
                     $now = Carbon::now()->toTimeString();
                     $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                     $newDeduction->user_id = $sub->user_id;
                     $newDeduction->product_id=$sub->product_id;
                     $newDeduction->lsubscription_id =$sub->id;
                     $newDeduction->amount_deducted = $remainingDeductible;
                     $newDeduction->balances = $loanDeductionBalance + $remainingDeductible;
                     $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                     $newDeduction->entry_time = $now;
                     $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                     $newDeduction->notes = $cumulativeDeduct->description;
                     $newDeduction->uploaded_by = auth()->user()->first_name;
                     $remainingDeductible = $remainingDeductible-$remainingDeductible;
                     $newDeduction->save();
                     //create records in default table
                     // $deficit = $currentAmount-$remainingDeductible;
                     // $percentageDeficit = $deficit*0.1;
                     // $chargeDefault = new Defaultcharge;
                     // $chargeDefault->user_id = $sub->user_id;
                     // $chargeDefault->product_id = $sub->product_id;
                     // $chargeDefault->ippis_no = $ippis_no;
                     // $chargeDefault->lsubscription_id =$sub->id;
                     // $chargeDefault->default_charge = $percentageDeficit;
                     // $chargeDefault->deficit = $deficit;
                     // $chargeDefault->default_reference = $cumulativeDeduct->master_reference;
                     // $chargeDefault->entry_date = $cumulativeDeduct->entry_date;
                     // $chargeDefault->status = 'Active';
                     // $chargeDefault->created_by = auth()->user()->first_name;
                     // $chargeDefault->save();
                     // $remainingDeductible = $remainingDeductible-$remainingDeductible;

                     //recaculate loan balances
                     $newDeduction->recalculateLoanDeductionBalances($sub->id);
                       //stop loan
                       $myLoanSubscription->loanBalance($sub->id);
                   }

                }//end check for date

                }//end foreach
                      $cumulativeDeduct->status = 'Inactive';
                      $cumulativeDeduct->save();
            } //end check for under deduction

            //over deduction check
            elseif($ippisCumulativeDeduction > $myActualLoanAmount){

                //
                $remainingDeductible = $ippisCumulativeDeduction;

                   //new over loan deduction object
                   //$newOverDeduction = new Loanoverdeduction;

                  //find the difference of over deduction
                  //$differenceLeft = $ippisCumulativeDeduction-$myActualLoanAmount;

                  //$remainingDeductible = $ippisCumulativeDeduction-$differenceLeft;
                  //$remainingDeductible = $ippisCumulativeDeduction;

                  //check if there is over deduction
                  // if($differenceLeft){
                  //   //save over deduction in the loanoverdeduction in its table
                  //   $newOverDeduction->saveOverDeduction($cumulativeDeduct,$differenceLeft);
                  // }

                  //initialise loop varibales
                  $overDeductionIteration = 0;
                  $loanCount = $activeLoans->count();

                  //start posting
                  foreach($activeLoans as $sub){

                    //check for the last iteration
                    if($overDeductionIteration == $loanCount-1){


                      //check for remaining active loans before this posting the last one
                      $activeLoansBeforeLastPost = Lsubscription::where('loan_status','Active')
                                                ->where('user_id',$sub->user_id)
                                                ->where('loan_start_date','<',$cumulativeDeduct->entry_date)
                                                ->orderBy('custom_tenor','asc')
                                                ->orderBy('disbursement_date','asc')
                                                ->get();


                          //check balance remaining on the last iteration loan

                            $loanBal = $sub->findCompleteBalance($sub->id);

                          if($remainingDeductible > $loanBal && $activeLoansBeforeLastPost->count()==1){
                            //The last iteration is the only remaining loan just pay everything

                            //create a new deduction
                            $newDeduction = new Ldeduction;

                            //total loan balances
                            $now = Carbon::now()->toTimeString();
                            $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                            $newDeduction->user_id = $sub->user_id;
                            $newDeduction->product_id=$sub->product_id;
                            $newDeduction->lsubscription_id =$sub->id;
                            $newDeduction->amount_deducted = $remainingDeductible;
                            $newDeduction->balances = $loanDeductionBalance + $remainingDeductible;
                            $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                            $newDeduction->entry_time =$now;
                            $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                            $newDeduction->notes = $cumulativeDeduct->description;
                            $newDeduction->uploaded_by = auth()->user()->first_name;
                            $newDeduction->save();
                            //$remainingDeductible = $remainingDeductible-$loanBal;

                            //recaculate loan balances
                            $newDeduction->recalculateLoanDeductionBalances($sub->id);
                              //stop loan
                            $myLoanSubscription->loanBalance($sub->id);

                      }elseif($remainingDeductible > $loanBal && $activeLoansBeforeLastPost->count()>1){
                        //remaining deductible is greater than remaing loan balance and more loan(s) available, pay the last loan balance
                        //create a new deduction
                        $newDeduction = new Ldeduction;

                        //total loan balances
                        $now = Carbon::now()->toTimeString();
                        $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                        $newDeduction->user_id = $sub->user_id;
                        $newDeduction->product_id=$sub->product_id;
                        $newDeduction->lsubscription_id =$sub->id;
                        $newDeduction->amount_deducted = $loanBal;
                        $newDeduction->balances = $loanDeductionBalance + $loanBal;
                        $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                        $newDeduction->entry_time =$now;
                        $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                        $newDeduction->notes = $cumulativeDeduct->description;
                        $newDeduction->uploaded_by = auth()->user()->first_name;
                        $newDeduction->save();
                        $remainingDeductible = $remainingDeductible-$loanBal;

                        //recaculate loan balances
                        $newDeduction->recalculateLoanDeductionBalances($sub->id);
                          //stop loan
                        $myLoanSubscription->loanBalance($sub->id);

                        //check if user has active loan(s) left, if yes pay the first in that order
                        $remainingActiveLoans = Lsubscription::where('loan_status','Active')
                                                  ->where('user_id',$sub->user_id)
                                                  ->where('loan_start_date','<',$cumulativeDeduct->entry_date)
                                                  ->orderBy('custom_tenor','asc')
                                                  ->orderBy('disbursement_date','asc')
                                                  ->get();

                              if($remainingActiveLoans->count()==1){
                                //only one loan remaining, loop through the loan and post the remaining deductible
                                foreach($remainingActiveLoans as $remainingActiveLoan){

                                      //post all remaining deductible
                                      //create a new deduction
                                      $newDeduction = new Ldeduction;

                                      $now = Carbon::now()->toTimeString();
                                      $loanDeductionBalance = $newDeduction->myLoanDeductions($remainingActiveLoan->id);
                                      $newDeduction->user_id = $remainingActiveLoan->user_id;
                                      $newDeduction->product_id=$remainingActiveLoan->product_id;
                                      $newDeduction->lsubscription_id =$remainingActiveLoan->id;
                                      $newDeduction->amount_deducted = $remainingDeductible;
                                      $newDeduction->balances = $loanDeductionBalance + $remainingDeductible;
                                      $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                                      $newDeduction->entry_time =$now;
                                      $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                                      $newDeduction->notes = $cumulativeDeduct->description;
                                      $newDeduction->uploaded_by = auth()->user()->first_name;
                                      $newDeduction->save();
                                      $remainingDeductible = $remainingDeductible-$remainingDeductible;

                                      //recaculate loan balances
                                      $newDeduction->recalculateLoanDeductionBalances($remainingActiveLoan->id);
                                        //stop loan
                                      $myLoanSubscription->loanBalance($remainingActiveLoan->id);
                                }

                              }elseif($remainingActiveLoans->count() > 1){
                                //initialise internal loop counter

                                $innerIteration = 0;
                                $remainingLoanCount = $remainingActiveLoans->count();
                                //loop through the loans and post based on remianing balances
                                foreach($remainingActiveLoans as $remainingActiveLoan){
                                  //check for loan balance

                                  if($innerIteration == $remainingLoanCount-1){
                                    //last innner iteration, dump remaining balance
                                    //post all remaining deductible
                                    //create a new deduction
                                    //dd($remainingDeductible);
                                    $newDeduction = new Ldeduction;

                                    $now = Carbon::now()->toTimeString();
                                    $loanDeductionBalance = $newDeduction->myLoanDeductions($remainingActiveLoan->id);
                                    $newDeduction->user_id = $remainingActiveLoan->user_id;
                                    $newDeduction->product_id=$remainingActiveLoan->product_id;
                                    $newDeduction->lsubscription_id =$remainingActiveLoan->id;
                                    $newDeduction->amount_deducted = $remainingDeductible;
                                    $newDeduction->balances = $loanDeductionBalance + $remainingloanBal;
                                    $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                                    $newDeduction->entry_time =$now;
                                    $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                                    $newDeduction->notes = $cumulativeDeduct->description;
                                    $newDeduction->uploaded_by = auth()->user()->first_name;
                                    $newDeduction->save();
                                    $remainingDeductible = $remainingDeductible-$remainingDeductible;
                                    //dd($remainingDeductible);
                                    //recaculate loan balances
                                    $newDeduction->recalculateLoanDeductionBalances($remainingActiveLoan->id);
                                      //stop loan
                                    $myLoanSubscription->loanBalance($remainingActiveLoan->id);
                                  }else{
                                    //
                                    $remainingloanBal = $remainingActiveLoan->findCompleteBalance($remainingActiveLoan->id);

                                    if($remainingDeductible == 0){
                                      break;
                                    }else{

                                      if($remainingDeductible < $remainingloanBal){
                                        //post all remaining deductible
                                        //create a new deduction
                                        $newDeduction = new Ldeduction;

                                        $now = Carbon::now()->toTimeString();
                                        $loanDeductionBalance = $newDeduction->myLoanDeductions($remainingActiveLoan->id);
                                        $newDeduction->user_id = $remainingActiveLoan->user_id;
                                        $newDeduction->product_id=$remainingActiveLoan->product_id;
                                        $newDeduction->lsubscription_id =$remainingActiveLoan->id;
                                        $newDeduction->amount_deducted = $remainingDeductible;
                                        $newDeduction->balances = $loanDeductionBalance + $remainingloanBal;
                                        $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                                        $newDeduction->entry_time =$now;
                                        $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                                        $newDeduction->notes = $cumulativeDeduct->description;
                                        $newDeduction->uploaded_by = auth()->user()->first_name;
                                        $newDeduction->save();
                                        $remainingDeductible = $remainingDeductible-$remainingDeductible;

                                        //recaculate loan balances
                                        $newDeduction->recalculateLoanDeductionBalances($remainingActiveLoan->id);
                                          //stop loan
                                        $myLoanSubscription->loanBalance($remainingActiveLoan->id);

                                      }elseif($remainingDeductible > $remainingloanBal){
                                        //pick the remaining balance
                                        //create a new deduction
                                        $newDeduction = new Ldeduction;

                                        $now = Carbon::now()->toTimeString();
                                        $loanDeductionBalance = $newDeduction->myLoanDeductions($remainingActiveLoan->id);
                                        $newDeduction->user_id = $remainingActiveLoan->user_id;
                                        $newDeduction->product_id=$remainingActiveLoan->product_id;
                                        $newDeduction->lsubscription_id =$remainingActiveLoan->id;
                                        $newDeduction->amount_deducted = $remainingloanBal;
                                        $newDeduction->balances = $loanDeductionBalance + $remainingloanBal;
                                        $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                                        $newDeduction->entry_time =$now;
                                        $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                                        $newDeduction->notes = $cumulativeDeduct->description;
                                        $newDeduction->uploaded_by = auth()->user()->first_name;
                                        $newDeduction->save();
                                        $remainingDeductible = $remainingDeductible-$remainingloanBal;

                                        //recaculate loan balances
                                        $newDeduction->recalculateLoanDeductionBalances($remainingActiveLoan->id);
                                          //stop loan
                                        $myLoanSubscription->loanBalance($remainingActiveLoan->id);
                                      }
                                    }
                                  }
                                  //increment inner loop counter here
                                  $innerIteration++;
                                }//end foreach for remaining loans

                              }
                      }elseif($remainingDeductible < $loanBal){
                        //post everything available

                        //create a new deduction
                        $newDeduction = new Ldeduction;

                        //total loan balances
                        $now = Carbon::now()->toTimeString();
                        $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                        $newDeduction->user_id = $sub->user_id;
                        $newDeduction->product_id=$sub->product_id;
                        $newDeduction->lsubscription_id =$sub->id;
                        $newDeduction->amount_deducted = $remainingDeductible;
                        $newDeduction->balances = $loanDeductionBalance + $loanBal;
                        $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                        $newDeduction->entry_time =$now;
                        $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                        $newDeduction->notes = $cumulativeDeduct->description;
                        $newDeduction->uploaded_by = auth()->user()->first_name;
                        $newDeduction->save();
                        $remainingDeductible = $remainingDeductible - $remainingDeductible;

                        //recaculate loan balances
                        $newDeduction->recalculateLoanDeductionBalances($sub->id);
                          //stop loan
                        $myLoanSubscription->loanBalance($sub->id);
                      }
                      //end check for loan balance

                    } //end check for last iteration
                    else{

                    //check to know loan start date
                    //$subDate = $sub->loan_start_date->toDateString();
                    $disbursementDate = $sub->disbursement_date->toDateString();
                    $entryDate = $cumulativeDeduct->entry_date->toDateString();
                    if($disbursementDate > $entryDate){
                    continue;
                    }else{
                      //
                      $currentAmount = $sub->monthly_deduction;

                    if($currentAmount <= $remainingDeductible){
                      //there is enough to deduct exact value of expected deduction

                      //check for remaining balance of the loan

                      //check the loan balance
                      $loanBal = $sub->findCompleteBalance($sub->id);
                      //check if loan remaining balance is less than actual deduction

                      if($loanBal<=$currentAmount){
                        //pick the loan balance
                        //create a new deduction
                        $newDeduction = new Ldeduction;

                        //total loan balances
                        $now = Carbon::now()->toTimeString();
                        $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                        $newDeduction->user_id = $sub->user_id;
                        $newDeduction->product_id=$sub->product_id;
                        $newDeduction->lsubscription_id =$sub->id;
                        $newDeduction->amount_deducted = $loanBal;
                        $newDeduction->balances = $loanDeductionBalance + $loanBal;
                        $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                        $newDeduction->entry_time =$now;
                        $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                        $newDeduction->notes = $cumulativeDeduct->description;
                        $newDeduction->uploaded_by = auth()->user()->first_name;
                        $newDeduction->save();
                        $remainingDeductible = $remainingDeductible-$loanBal;

                        //recaculate loan balances
                        $newDeduction->recalculateLoanDeductionBalances($sub->id);
                          //stop loan
                        $myLoanSubscription->loanBalance($sub->id);
                      }else{
                        //do the normal deduction
                        //create a new deduction
                        $newDeduction = new Ldeduction;

                        //total loan balances
                        $now = Carbon::now()->toTimeString();
                        $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                        $newDeduction->user_id = $sub->user_id;
                        $newDeduction->product_id=$sub->product_id;
                        $newDeduction->lsubscription_id =$sub->id;
                        $newDeduction->amount_deducted = $currentAmount;
                        $newDeduction->balances = $loanDeductionBalance + $currentAmount;
                        $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                        $newDeduction->entry_time =$now;
                        $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                        $newDeduction->notes = $cumulativeDeduct->description;
                        $newDeduction->uploaded_by = auth()->user()->first_name;
                        $newDeduction->save();
                        $remainingDeductible = $remainingDeductible-$currentAmount;

                        //recaculate loan balances
                        $newDeduction->recalculateLoanDeductionBalances($sub->id);
                          //stop loan
                        $myLoanSubscription->loanBalance($sub->id);

                      }
                  }
              }//end start date check
          }

          $overDeductionIteration++;
          }
          //end foreach loop for overdeduction
              //CHANGE STATUS OF THE MASTER DEDUCTION HERE
              $cumulativeDeduct->status = 'Inactive';
              $cumulativeDeduct->save();

          }//end over deduction check
          //==================================

          //check for actual or equal deduction
          elseif($myActualLoanAmount == $ippisCumulativeDeduction){

                      //equal deduction
                      $remainingDeductible = $ippisCumulativeDeduction;

                        //initialise loop varibales
                    $equalDeductionIteration = 0;
                    $equalLoanCount = $activeLoans->count();

                     foreach($activeLoans as $sub){

                      //check for the last iteration
                    if($equalDeductionIteration == $equalLoanCount-1)
                    {
                      //create a new deduction
                      $newDeduction = new Ldeduction;
                      //total loan balances
                      $now = Carbon::now()->toTimeString();
                      $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                      $newDeduction->user_id = $sub->user_id;
                      $newDeduction->product_id = $sub->product_id;
                      $newDeduction->lsubscription_id =$sub->id;
                      $newDeduction->amount_deducted = $remainingDeductible;
                      $newDeduction->balances = $loanDeductionBalance + $remainingDeductible;
                      $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                      $newDeduction->entry_time = $now;
                      $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                      $newDeduction->notes = $cumulativeDeduct->description;
                      $newDeduction->uploaded_by = auth()->user()->first_name;
                      $newDeduction->save();
                      //$remainingDeductible = $remainingDeductible-$currentAmount;

                      //recaculate loan balances
                      $newDeduction->recalculateLoanDeductionBalances($sub->id);
                      //stop loan
                      $myLoanSubscription->loanBalance($sub->id);
                    }
                    else{
                      //check to know loan start date
                          //$subDate = $sub->loan_start_date->toDateString();
                          $disbursementDate = $sub->disbursement_date->toDateString();
                          $entryDate = $cumulativeDeduct->entry_date->toDateString();
                          if($disbursementDate > $entryDate){
                          continue;
                        }else{

                          //actual monthly deduction
                          $currentAmount = $sub->monthly_deduction;

                              //there is enough to deduct exact value of expected deduction
                              //check for remaining loan balance
                              $loanBal = $sub->findCompleteBalance($sub->id);

                              //check if loan remaining balance is less than actual deduction
                              if($loanBal<=$currentAmount){

                                //create a new deduction
                                $newDeduction = new Ldeduction;
                                //total loan balances
                                $now = Carbon::now()->toTimeString();
                                $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                                $newDeduction->user_id = $sub->user_id;
                                $newDeduction->product_id = $sub->product_id;
                                $newDeduction->lsubscription_id =$sub->id;
                                $newDeduction->amount_deducted = $loanBal;
                                $newDeduction->balances = $loanDeductionBalance + $loanBal;
                                $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                                $newDeduction->entry_time = $now;
                                $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                                $newDeduction->notes = $cumulativeDeduct->description;
                                $newDeduction->uploaded_by = auth()->user()->first_name;
                                $newDeduction->save();
                                $remainingDeductible = $remainingDeductible-$loanBal;

                                //recaculate loan balances
                                $newDeduction->recalculateLoanDeductionBalances($sub->id);
                                //stop loan
                                $myLoanSubscription->loanBalance($sub->id);
                              }
                                else{

                                  //create a new deduction
                                  $newDeduction = new Ldeduction;
                                  //total loan balances
                                  $now = Carbon::now()->toTimeString();
                                  $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                                  $newDeduction->user_id = $sub->user_id;
                                  $newDeduction->product_id = $sub->product_id;
                                  $newDeduction->lsubscription_id =$sub->id;
                                  $newDeduction->amount_deducted = $currentAmount;
                                  $newDeduction->balances = $loanDeductionBalance + $currentAmount;
                                  $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                                  $newDeduction->entry_time = $now;
                                  $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                                  $newDeduction->notes = $cumulativeDeduct->description;
                                  $newDeduction->uploaded_by = auth()->user()->first_name;
                                  $newDeduction->save();
                                  $remainingDeductible = $remainingDeductible-$currentAmount;

                                  //recaculate loan balances
                                  $newDeduction->recalculateLoanDeductionBalances($sub->id);
                                  //stop loan
                                  $myLoanSubscription->loanBalance($sub->id);
                                }


                        }//end check date
                    } //alternative block for last iteration

                    //increment loop here
                    $equalDeductionIteration++;

                      }//end for each for equal deduction
                      $cumulativeDeduct->status = 'Inactive';
                      $cumulativeDeduct->save();
                  }

              // //post cumulative amount to consolidated loan ledger
              //
              $newConsolidatedDeduct = new Userconsolidatedloan();

              $now = Carbon::now()->toTimeString();
              $newConsolidatedDeduct->user_id = $user_id;
              $newConsolidatedDeduct->description = $cumulativeDeduct->description;
              $newConsolidatedDeduct->date_entry = $cumulativeDeduct->entry_date;
              $newConsolidatedDeduct->entry_time = $now;
              $newConsolidatedDeduct->credit = $cumulativeDeduct->cumulative_amount;
              $newConsolidatedDeduct->ref_identification = $cumulativeDeduct->master_reference;
              $newConsolidatedDeduct->save();
              $newConsolidatedDeduct->userConsolidatedBalances($user_id);

            }elseif($activeLoans->count()==1){
              //user has one loan only, post when balance is checked

              //create a new deduction
              //get total ippis deduction
              $remainingDeductible = $cumulativeDeduct->cumulative_amount;
                  foreach($activeLoans as $sub){

                  //pay what is available
                  $newDeduction = new Ldeduction;


                  //total loan balances
                  $now = Carbon::now()->toTimeString();
                  $loanDeductionBalance = $newDeduction->myLoanDeductions($sub->id);
                  $newDeduction->user_id = $sub->user_id;
                  $newDeduction->product_id=$sub->product_id;
                  $newDeduction->lsubscription_id =$sub->id;
                  $newDeduction->amount_deducted = $remainingDeductible;
                  $newDeduction->balances = $loanDeductionBalance + $remainingDeductible;
                  $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                  $newDeduction->entry_time =$now;
                  $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                  $newDeduction->notes = $cumulativeDeduct->description;
                  $newDeduction->uploaded_by = auth()->user()->first_name;
                  $newDeduction->save();

                  //recaculate loan balances
                  $newDeduction->recalculateLoanDeductionBalances($sub->id);
                    //stop loan
                  $myLoanSubscription->loanBalance($sub->id);

                  //CHANGE STATUS OF THE MASTER DEDUCTION HERE
                  $cumulativeDeduct->status = 'Inactive';
                  $cumulativeDeduct->save();

                  //post to the user consolidated ledger
                  // //post cumulative amount to consolidated loan ledger
                  //
                  $newConsolidatedDeduct = new Userconsolidatedloan();

                  $now = Carbon::now()->toTimeString();
                  $newConsolidatedDeduct->user_id = $user_id;
                  $newConsolidatedDeduct->description = $cumulativeDeduct->description;
                  $newConsolidatedDeduct->date_entry = $cumulativeDeduct->entry_date;
                  $newConsolidatedDeduct->entry_time = $now;
                  $newConsolidatedDeduct->credit = $cumulativeDeduct->cumulative_amount;
                  $newConsolidatedDeduct->ref_identification = $cumulativeDeduct->master_reference;
                  $newConsolidatedDeduct->save();
                  $newConsolidatedDeduct->userConsolidatedBalances($user_id);
                //}
              }

            }else{
              /**User has no loan
              1.create a default loan for the user and post the money on it
              */

                $cumAmount = $cumulativeDeduct->cumulative_amount;

                $loan_sub = new Lsubscription();
                $loan_sub->product_id = 24;
                $loan_sub->user_id = $user_id;
                //$loan_sub->monthly_deduction = $cumAmount;
                $loan_sub->custom_tenor = 1;
                //$loan_sub->amount_applied = $cumAmount;
                $loan_sub->wrong_deduction = $cumAmount;
                //$loan_sub->net_pay = $cumAmount;
                $loan_sub->approved_date = $cumulativeDeduct->entry_date;
                $loan_sub->loan_start_date = $cumulativeDeduct->entry_date;
                $loan_sub->loan_end_date = $cumulativeDeduct->entry_date;
                $loan_sub->disbursement_date = $cumulativeDeduct->entry_date;
                $loan_sub->loan_status = 'Active';
                $loan_sub->approve_by = auth()->user()->first_name;
                $loan_sub->save();

                //
                $defaultLoanID = $loan_sub->id;
                //

                $defaultSubObj = Lsubscription::find($defaultLoanID);
                //create a corresponding debit in the loan deduction table


                $newDeduction = new Ldeduction;


                   //total loan balances
                $now = Carbon::now()->toTimeString();
                $loanDeductionBalance = $newDeduction->myLoanDeductions($defaultLoanID);
                $newDeduction->user_id = $user_id;
                $newDeduction->product_id=$defaultSubObj->product_id;
                $newDeduction->lsubscription_id =$defaultLoanID;
                $newDeduction->amount_deducted = $cumAmount;
                $newDeduction->balances = $loanDeductionBalance + $cumAmount;
                $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                $newDeduction->entry_time =$now;
                $newDeduction->deduct_reference = $cumulativeDeduct->master_reference;
                $newDeduction->notes = 'Over Deduction Post - '.$cumulativeDeduct->description;
                $newDeduction->uploaded_by = auth()->user()->first_name;
                $newDeduction->save();

                  //recaculate loan balances
                $newDeduction->recalculateLoanDeductionBalances($defaultSubObj->id);
                  //stop loan
                //$myLoanSubscription->loanBalance($defaultSubObj->id);


    //second idea
                // $refund = new Refundloan();
                // $refund->user_id = $user_id;
                // $refund->product_id = 24;//24
                // $refund->credit = $cumAmount;
                // $refund->description = 'Wrong Loan Deduction- '.$cumulativeDeduct->description;
                // $refund->refund_balance = 0.0;
                // $refund->transaction_date = $cumulativeDeduct->entry_date;
                // $refund->reference = $cumulativeDeduct->master_reference;
                // $refund->created_by = auth()->user()->first_name;
                // $refund->save();
                // $refund->recalculateRefundBalances($user_id);

                //deactivate master loan deduction
                $cumulativeDeduct->status = 'Inactive';
                $cumulativeDeduct->save();

              //post to consolidated ledger also
              $newConsolidatedDeduct = new Userconsolidatedloan();

              $now = Carbon::now()->toTimeString();
              $newConsolidatedDeduct->user_id = $user_id;
              $newConsolidatedDeduct->description = 'Wrong Loan Deduction- '.$cumulativeDeduct->description;
              $newConsolidatedDeduct->date_entry = $cumulativeDeduct->entry_date;
              $newConsolidatedDeduct->entry_time = $now;
              $newConsolidatedDeduct->credit = $cumulativeDeduct->cumulative_amount;
              $newConsolidatedDeduct->ref_identification = $cumulativeDeduct->master_reference;
              $newConsolidatedDeduct->save();
              $newConsolidatedDeduct->userConsolidatedBalances($user_id);
        }

    }//end foreach loop

}); // chunking code bracket
     /** */
}catch(\Exception $e){
    DB::rollback();
    toastr()->error($e->getMessage());
    return back();
}
DB::commit();
toastr()->success('Loan deduction inputs processed successfully!');
//redirect to listing page order by latest
return redirect('/post/loans');
//return redirect('/user/loanDeduction/'.$user_id);
}
//






//form to upload legacy loan subscriptions information
 public function legacyLoan(){
    $title ='Upload Loan Information';
    return view('IppisAnalysis.legacyLoanForm',compact('title'));
}

//store legacy loan subscriptions
public function legacyLoanStore(){
    //begin transaction
    $rand = $this->randomString();
    DB::beginTransaction();
    try{
    Excel::import(new LegacyLoanImport($rand),request()->file('legacyloan_import'));
    }catch(\Exception $ex){
        DB::rollback();
       toastr()->error($ex->getMessage());
        return back();
    }
    DB::commit();
    toastr()->success('Loan subscription(s) created successfully!');
    //return redirect ('/legacy-loans');
    return redirect ('/show/legacysubs');
}



//upload form legacy loan deductions
public function legacyLoanDeductionForm(){
    //
    $title ='Upload Legacy Loan Deductions';

    return view('IppisAnalysis.uploadLegacyLoanDeductions',compact('title'));
}

//legacy loan deductions import
public function legacyLoanDeductions(){
    //begin transaction
    $rand = $this->randomString();
    DB::beginTransaction();
    try{
    Excel::import(new LegacyLoanDeductionImport($rand),request()->file('legacyloandeduction_import'));
    }catch(\Exception $ex){
        DB::rollback();
       toastr()->error($ex->getMessage());
        return back();
    }
    DB::commit();
    toastr()->success('Loan deductions(s) created successfully!');
    return redirect ('/legacy-loandeduct-form');
}


//activaet legacy loan subscriptions
//upload form legacy loan deductions
public function showPendingLegacySubs(){
    //
    $title ='Show Pending Legacy Subs';

    $collection = Lsubscription::where('loan_status','Pending')->get();

    return view('IppisAnalysis.showLegacySubs',compact('collection','title'));
}

//activate legacy loan subscriptions
public function activateBulkLegacySubs(){
  DB::beginTransaction();
  try{
    $collection = Lsubscription::where('loan_status','Pending')->get();

    foreach($collection as $myItem){
      $now = Carbon::now()->toTimeString();
      //$date = $user->disbursement_date." ".$now;

      //inser records
      $newData = new Userconsolidatedloan();
      $newData->user_id = $myItem->user_id;
      $newData->lsubscription_id = $myItem->id;
      $newData->description = $myItem->product->name . ' Loan';
      $newData->date_entry = $myItem->disbursement_date;
      $newData->entry_time = $now;
      $newData->ref_identification = $myItem->ref;
      $newData->debit = $myItem->amount_approved;
      $newData->save();
      $newData->userConsolidatedBalances($myItem->user_id);

      //update loan to active
      $sub = Lsubscription::find($myItem->id);
      $sub->loan_status = 'Active';
      $sub->save();
    }
  }catch(\Exception $ex){
      DB::rollback();
     toastr()->error($ex->getMessage());
      return back();
  }
  DB::commit();
  toastr()->success('Records created successfully!');
  return back();

}


//random string
public function randomString(){
    $randomString = rand(10,1000);

    $dateNow = Carbon::now();
    $formattedDate = $dateNow->toDateString();
    return $randomString.'-'.$formattedDate;
}

//filter records
public function getUserActive(){
    return User::where('status','Active')
                ->get();
}

//check for loan deduction start date //obsolete
public function startLoan($sub_date,$entry_date){
    $bolean_value= TRUE;

    //check for date comparison
    if($sub_date < $entry_date){
        //allow loan to deduct
        return $bolean_value;
    }else{
        //do not allow loan to deduct
        return !$bolean_value;
    }
}

//legacy code
// public function oldcode($id){
//     /**
//      * TODO
//      * wrap the code in a  transaction
//      * once a loan is posted, change status in the  masterdeduction table to posted
//      * spread the loan accordingly
//      */

// //begin transaction to process uploads
// DB::beginTransaction();
// try{
//     //find the recent upload and return the date
//     //$latestMaster = Masterdeduction::latest()->first();
//     //$latestMasterDate = $latestMaster->entry_date->toDateString();

//     //find all recent upload by date created
//     //$allLatestMaster = Masterdeduction::where('entry_date',$latestMasterDate)
//                                         //->get();



//     //Find user cumulative deduction by id
//     $cumulativeDeduct = Masterdeduction::find($id);
//     $ippis_no = $cumulativeDeduct->ippis_no;
//     //get total ippis deduction
//     $ippisCumulativeDeduction = $cumulativeDeduct->cumulative_amount;

//     //find the user id using the IPPIS NUMBER
//     $user_id = User::userID($ippis_no);
//     dd($user_id);


//     //find all active loan subscription order by oldest loans
//     /**
//      * Find all active loans by a user
//      */
//     $activeLoans = Lsubscription::where('loan_status','Active')
//                                   ->where('user_id',$user_id)
//                                 ->oldest('loan_start_date')
//                                 ->get();

//     foreach($allLatestMaster as $latestItem){
//         //get the user id by IPPIS number
//         $user_id = User::userID($latestItem->ippis_no);
//         //get total IPPIS Deduction

//         $ippisDeductionTotal = $latestItem->cumulative_amount;

//         //user specific subscriptions
//         $userSubs = $activeLoans->where('user_id',$user_id);
//         //$userSubCount = $userSubs->count();
//         //Find the last  element in the activeLoans array
//         $remainingDeductible = $ippisDeductionTotal;
//         foreach($userSubs as $sub){
//            //actual monthly deduction
//             $currentAmount = $sub->monthly_deduction;
//              //check for zero ippis analysis balance
//             if($remainingDeductible !=0)
//             {
//                 if($currentAmount <= $remainingDeductible){
//                     //there is enough to deduct exact value of expected deduction
//                     //create a new deduction
//                     $newDeduction = new Ldeduction;
//                     $newDeduction->user_id = $sub->user_id;
//                     $newDeduction->product_id=$sub->product_id;
//                     $newDeduction->lsubscription_id =$sub->id;
//                     $newDeduction->amount_deducted = $currentAmount;
//                     $newDeduction->entry_month = $latestMasterDate;
//                     $newDeduction->notes = $latestMasterDate.' IPPIS loan deduction';
//                     $newDeduction->uploaded_by = auth()->id();
//                     $newDeduction->save();
//                     $remainingDeductible = $remainingDeductible-$currentAmount;
//                 }elseif($currentAmount > $remainingDeductible && $remainingDeductible !=0){
//                     //there is balance but not enough for what is required, pick the remainingbalance
//                     $newDeduction = new Ldeduction;
//                     $newDeduction->user_id = $sub->user_id;
//                     $newDeduction->product_id=$sub->product_id;
//                     $newDeduction->lsubscription_id =$sub->id;
//                     $newDeduction->amount_deducted = $remainingDeductible;
//                     $newDeduction->entry_month = $latestMasterDate;
//                     $newDeduction->notes = $latestMasterDate.' IPPIS loan deduction';
//                     $newDeduction->uploaded_by = auth()->id();
//                     $newDeduction->save();
//                     $remainingDeductible = $remainingDeductible-$remainingDeductible;
//                 }

//             }elseif($remainingDeductible==0){
//                     //no balance is available, update with 0 values
//                     $newDeduction = new Ldeduction;
//                     $newDeduction->user_id = $sub->user_id;
//                     $newDeduction->product_id=$sub->product_id;
//                     $newDeduction->lsubscription_id =$sub->id;
//                     $newDeduction->amount_deducted = 0;
//                     $newDeduction->entry_month = $latestMasterDate;
//                     $newDeduction->notes = $latestMasterDate.' IPPIS loan deduction';
//                     $newDeduction->uploaded_by = auth()->id();
//                     $newDeduction->save();
//                     $remainingDeductible = 0;
//             }

//         }
//     }//end of first foreach
// }catch(\Exception $e){
//     DB::rollback();
//     toastr()->error('An error has occurred trying to spread your loan payment.');
//     return back();
// }
// DB::commit();
// toastr()->success('IPPIS Loan deduction inputs processed successfully!');
// //redirect to listing page order by latest
// return redirect('/loanDeduction/listings');
// }
}
