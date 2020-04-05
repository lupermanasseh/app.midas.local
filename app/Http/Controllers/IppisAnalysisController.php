<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\IppisAnalysisImport;
use App\Imports\SavingMasterImport;
use App\Imports\LegacyLoanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Masterdeduction;
use App\User;
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
                            ->groupBy('entry_date')
                            ->selectRaw('sum(saving_cumulative) as saving, entry_date')
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
   //DB::beginTransaction();
    //try{
    Excel::import(new SavingMasterImport(),request()->file('savingmaster_import'));
    //}catch(\Exception $ex){
    //DB::rollback();
       toastr()->error('An error has occurred trying to import Master Saving IPPIS inputs');
        return back();
    //}catch(\Error $ex){
     //DB::rollback();
        toastr()->error('Something bad has happened');
        return back();
    //}
    //DB::commit();
    return redirect ('/mastersaving/summary');
    }


    //list master saving records
    public function recentMasterSaving($date){
        $title = 'Recent IPPIS Savings Inputs';
        $entry_date = new Carbon($date);
        $_date = $entry_date->toDateString();
        //find all recent upload by date created
        $savingMaster = Savingmaster::where('entry_date','=',$_date)
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
    DB::beginTransaction();
    try{
    Excel::import(new IppisAnalysisImport(),request()->file('ippisanalysis_import'));
    }catch(\Exception $ex){
        DB::rollback();
       toastr()->error('An Error Has Occurred Trying To Import IPPIS Loan Analysis Inputs');
        return back();
    }catch(\Error $ex){
        DB::rollback();
        toastr()->error('Something bad has happened');
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
                                ->oldest('entry_date')
                                ->get();

    return view('IppisAnalysis.masterLoanUploadListings',compact('loanMaster','title'));
}

//Post Analysis

public function postSaving($date){
    
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
        toastr()->error('An error has occured posting your savings.');
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
            $mySaving->status = 'Active';
            $mySaving->created_by = auth()->user()->first_name;
            $mySaving->save();

            //Change the status of the record
            
            $savingList->status =  'Inactive';
            $savingList->save();
            }

    }catch(\Exception $ex){
    DB::rollback();
        toastr()->error('An error has occured posting your savings.');
        return back();
    }
   DB::commit();
    toastr()->success('Saving records posted successfully!');
    //redirect to listing page order by latest
    return back();
}

//post loans
public function postLoan($id){

//begin transaction to process uploads
DB::beginTransaction();
try{
    $myLoanSubscription = new Lsubscription;
    //Find user cumulative deduction by id
    $cumulativeDeduct = Masterdeduction::find($id);
    $ippis_no = $cumulativeDeduct->ippis_no;

    //get total ippis deduction 
    $ippisCumulativeDeduction = $cumulativeDeduct->cumulative_amount;

    //find the user id using the IPPIS NUMBER
    $user_id = User::userID($ippis_no);
    if($user_id==0){
        toastr()->error('Wrong IPPIS Number, please check.');
        return back(); 
    }

    //find all active loan subscription order by oldest loans
    /**
     * Find all active loans by a user
     */
    //TODO: Check for loans that are actve or defaulted
    $activeLoans = Lsubscription::where('loan_status','Active')
                                  ->where('user_id',$user_id)
                                  ->oldest('loan_start_date')
                                  ->get();

    $myActualLoanAmount = $myLoanSubscription->totalIppisDeductions($user_id,$activeLoans);
 
    /**
     * Check for the existence of a default charge
     * If any pay for it before proceeding 
     * Write a function to find all active defaults
     */
    $defaultCharges = Defaultcharge::where('user_id',$user_id)
                                    ->where('status','Active')
                                    ->oldest('entry_date')
                                    ->get();
    if($defaultCharges->isNotEmpty()){

        foreach($defaultCharges as $charge){
            //charged amaount
            $charged_amount = $charge->default_charge;
            
            if($ippisCumulativeDeduction !=0 && $charged_amount < $ippisCumulativeDeduction){
                $myDefaultCharge = Defaultcharge::find($charge->id);
                $myDefaultCharge->status = 'Paid';
                $myDefaultCharge->created_by = auth()->user()->first_name;
                $myDefaultCharge->save();
                $ippisCumulativeDeduction = $ippisCumulativeDeduction-$charged_amount;
                //$differenceLeft = $differenceLeft-$differenceLeft;
               }
        }

    } 

    //over deduction 
    if($ippisCumulativeDeduction > $myActualLoanAmount){
        
    
        //find the difference of over deduction
        $differenceLeft = $ippisCumulativeDeduction-$myActualLoanAmount;

        $remainingDeductible = $ippisCumulativeDeduction-$differenceLeft;

        foreach($activeLoans as $sub){
            //product
            $product_name = Product::find($sub->product_id)->name;

            //actual monthly deduction
            //TODO: add the deficit to the currentAmount
            $currentAmount = $sub->monthly_deduction;

            if($remainingDeductible !=0 && $differenceLeft !=0)
            {
               //check for over deduction balance if it exist please attach it to the first loan paid
                $newDeduction = new Ldeduction;
                $newDeduction->user_id = $sub->user_id;
                $newDeduction->product_id=$sub->product_id;
                $newDeduction->lsubscription_id =$sub->id;
                $newDeduction->amount_deducted = $currentAmount;
                $newDeduction->over_deduction = $differenceLeft; //store over deduction amount
                $newDeduction->overdeduction_status = 'Active'; //store over deduction status
                $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                $newDeduction->notes = $cumulativeDeduct->entry_date->toFormattedDateString() .'   '. $product_name.  'MIDAS loan deduction';
                $newDeduction->uploaded_by = auth()->user()->first_name;
                $newDeduction->save();
                $remainingDeductible = $remainingDeductible-$currentAmount;
                $differenceLeft = $differenceLeft-$differenceLeft;
               
            }elseif($currentAmount <= $remainingDeductible){
                //there is enough to deduct exact value of expected deduction
                //create a new deduction
                $newDeduction = new Ldeduction;
                $newDeduction->user_id = $sub->user_id;
                $newDeduction->product_id=$sub->product_id;
                $newDeduction->lsubscription_id =$sub->id;
                $newDeduction->amount_deducted = $currentAmount;
                $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                $newDeduction->notes = $cumulativeDeduct->entry_date->toFormattedDateString() .'  '. $product_name . ' MIDAS loan deduction';
                $newDeduction->uploaded_by = auth()->user()->first_name;
                $newDeduction->save();
                $remainingDeductible = $remainingDeductible-$currentAmount;

            }

        }
    //CHANGE STATUS OF THE MASTER DEDUCTION HERE
    $cumulativeDeduct->status = 'Inactive';
    $cumulativeDeduct->save();
    
    }elseif($ippisCumulativeDeduction < $myActualLoanAmount){
        //under deduction
        $remainingDeductible = $ippisCumulativeDeduction;

        foreach($activeLoans as $sub){
            //product
            $product_name = Product::find($sub->product_id)->name;

            //actual monthly deduction
            $currentAmount = $sub->monthly_deduction;
             
               // 
               if($currentAmount <= $remainingDeductible){
                //there is enough to deduct exact value of expected deduction
                //create a new deduction
                $newDeduction = new Ldeduction;
                $newDeduction->user_id = $sub->user_id;
                $newDeduction->product_id = $sub->product_id;
                $newDeduction->lsubscription_id =$sub->id;
                $newDeduction->amount_deducted = $currentAmount;
                $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                $newDeduction->notes = $cumulativeDeduct->entry_date->toFormattedDateString() .'  '. $product_name. ' MIDAS loan deduction';
                $newDeduction->uploaded_by = auth()->user()->first_name;
                $newDeduction->save();
                $remainingDeductible = $remainingDeductible-$currentAmount;
                }elseif($currentAmount > $remainingDeductible){
                //there is not enough to deduct store the value available
                $newDeduction = new Ldeduction;
                $newDeduction->user_id = $sub->user_id;
                $newDeduction->product_id=$sub->product_id;
                $newDeduction->lsubscription_id =$sub->id;
                $newDeduction->amount_deducted = $remainingDeductible;
                $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                $newDeduction->notes = $cumulativeDeduct->entry_date->toFormattedDateString() .'   '. $product_name. ' MIDAS loan deduction';
                $newDeduction->uploaded_by = auth()->user()->first_name;
                $newDeduction->save();
                
                //create records in default table
                $deficit = $currentAmount-$remainingDeductible;
                $percentageDeficit = $deficit*0.1;
                $chargeDefault = new Defaultcharge;
                $chargeDefault->user_id = $sub->user_id;
                $chargeDefault->product_id = $sub->product_id;
                $chargeDefault->ippis_no = $ippis_no;
                $chargeDefault->lsubscription_id =$sub->id;
                $chargeDefault->default_charge = $percentageDeficit;
                $chargeDefault->deficit = $deficit;
                $chargeDefault->entry_date = $cumulativeDeduct->entry_date;
                $chargeDefault->status = 'Active';
                $chargeDefault->created_by = auth()->user()->first_name;
                $chargeDefault->save();
                $remainingDeductible = $remainingDeductible-$remainingDeductible;
            }

        }

        $cumulativeDeduct->status = 'Inactive';
        $cumulativeDeduct->save();

    }elseif($myActualLoanAmount == $ippisCumulativeDeduction){
        //equal deduction
        $remainingDeductible = $ippisCumulativeDeduction;
        foreach($activeLoans as $sub){
            $product_name = Product::find($sub->product_id)->name;

            //actual monthly deduction
            $currentAmount = $sub->monthly_deduction;
               // 
               if($currentAmount <= $remainingDeductible){
                //there is enough to deduct exact value of expected deduction
                //create a new deduction
                $newDeduction = new Ldeduction;
                $newDeduction->user_id = $sub->user_id;
                $newDeduction->product_id = $sub->product_id;
                $newDeduction->lsubscription_id =$sub->id;
                $newDeduction->amount_deducted = $currentAmount;
                $newDeduction->entry_month = $cumulativeDeduct->entry_date;
                $newDeduction->notes = $cumulativeDeduct->entry_date->toFormattedDateString().' '.$product_name. 'MIDAS loan deduction';
                $newDeduction->uploaded_by = auth()->user()->first_name;
                $newDeduction->save();
                $remainingDeductible = $remainingDeductible-$currentAmount;
                }
        }
        $cumulativeDeduct->status = 'Inactive';
        $cumulativeDeduct->save();
    }
              
}catch(\Exception $e){
    DB::rollback();
    toastr()->error('An error has occured paying your loan.');
    return back();
}
DB::commit();
toastr()->success('Loan deduction inputs processed successfully!');
//redirect to listing page order by latest
return redirect('/post/loans');
//return redirect('/user/loanDeduction/'.$user_id);
}


//form to upload legacy loan information
 public function legacyLoan(){
    $title ='Upload Loan Information';
    return view('IppisAnalysis.legacyLoanForm',compact('title'));
}

//store legacy loan
public function legacyLoanStore(){
    //begin transaction
    DB::beginTransaction();
    try{
    Excel::import(new LegacyLoanImport(),request()->file('legacyloan_import'));
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
    
    return redirect ('/legacy-loans');
        
}



//filter records

public function getUserActive(){
    return User::where('status','Active')
                ->get();
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
