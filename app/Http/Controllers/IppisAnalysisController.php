<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\IppisAnalysisImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Masterdeduction;
use App\User;
use App\Lsubscription;
use App\Ldeduction;
use Carbon\Carbon;
class IppisAnalysisController extends Controller
{
    //
    // public function index(){
    //     //
    //     $title ='All Active Contributors';
    //     $activeUsers= User::where('status','Active')->withCount(['usersavings' => function ($query) {
    //         $query->latest('entry_date');
    //        }])->paginate(100);
    //     return view('Contributors.index',compact('activeUsers','title'));
    // }

    //Saving master upload form
    public function savingMasterForm(){
        $title ='Upload Saving Master';
        return view('IppisAnalysis.savingUploadForm', compact('title'));
    }

    //saving master upload functionality
    public function importSavingMaster(){
               //begin transaction
    DB::beginTransaction();
    try{
    Excel::import(new SavingMasterImport(),request()->file('savingmaster_import'));
    }catch(\Exception $ex){
        DB::rollback();
       toastr()->error('An error has occurred trying to import Master Saving IPPIS inputs');
        return back();
    }catch(\Error $ex){
        DB::rollback();
        toastr()->error('Something bad has happened');
        return back();
    }
    DB::commit();
    }

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
       toastr()->error('An error has occurred trying to import IPPIS Analysis inputs');
        return back();
    }catch(\Error $ex){
        DB::rollback();
        toastr()->error('Something bad has happened');
        return back();
    }
    DB::commit();
    

    /**
     * Move the below code to a different route
     * Add a button to process the current uploaded master
     * 1. first get the latest IPPIS master upload analysis
     * 2. get the entry date on that upload
     * 3. check if entry date exist in the loan deduction, if yes Display link to show records else
     * 4. Provide a button to trigger the processing
     * 
     */
    //begin transaction to process uploads
    DB::beginTransaction();
    try{
        //find the recent upload and return the date
        $latestMaster = Masterdeduction::latest()->first();
        $latestMasterDate = $latestMaster->entry_date->toDateString();
        

        //find all recent upload by date created
        $allLatestMaster = Masterdeduction::where('entry_date',$latestMasterDate)
                                            ->get();
        
        //find all active loan subscription order by oldest loans
        $activeLoans = Lsubscription::where('loan_status','Active')
                               ->oldest('loan_start_date')
                               ->get();
        
        foreach($allLatestMaster as $latestItem){
            //get the user id by IPPIS number
            $user_id = User::userID($latestItem->ippis_no);
            //get total IPPIS Deduction
            $ippisDeductionTotal = $latestItem->cumulative_amount;

            //user specific subscriptions
            $userSubs = $activeLoans->where('user_id',$user_id);
            //$userSubCount = $userSubs->count();
            //Find the last  element in the activeLoans array
            $remainingDeductible = $ippisDeductionTotal;
            foreach($userSubs as $sub){
               //actual monthly deduction
                $currentAmount = $sub->monthly_deduction;
                 //check for zero ippis analysis balance
                if($remainingDeductible !=0)
                {
                    if($currentAmount <= $remainingDeductible){
                        //there is enough to deduct exact value of expected deduction
                        //create a new deduction
                        $newDeduction = new Ldeduction;
                        $newDeduction->user_id = $sub->user_id;
                        $newDeduction->product_id=$sub->product_id;
                        $newDeduction->lsubscription_id =$sub->id;
                        $newDeduction->amount_deducted = $currentAmount;
                        $newDeduction->entry_month = $latestMasterDate;
                        $newDeduction->notes = $latestMasterDate.' IPPIS loan deduction';
                        $newDeduction->uploaded_by = auth()->id();
                        $newDeduction->save();
                        $remainingDeductible = $remainingDeductible-$currentAmount;
                    }elseif($currentAmount > $remainingDeductible && $remainingDeductible !=0){
                        //there is balance but not enough for what is required, pick the remainingbalance
                        $newDeduction = new Ldeduction;
                        $newDeduction->user_id = $sub->user_id;
                        $newDeduction->product_id=$sub->product_id;
                        $newDeduction->lsubscription_id =$sub->id;
                        $newDeduction->amount_deducted = $remainingDeductible;
                        $newDeduction->entry_month = $latestMasterDate;
                        $newDeduction->notes = $latestMasterDate.' IPPIS loan deduction';
                        $newDeduction->uploaded_by = auth()->id();
                        $newDeduction->save();
                        $remainingDeductible = $remainingDeductible-$remainingDeductible;
                    }

                }elseif($remainingDeductible==0){
                        //no balance is available, update with 0 values
                        $newDeduction = new Ldeduction;
                        $newDeduction->user_id = $sub->user_id;
                        $newDeduction->product_id=$sub->product_id;
                        $newDeduction->lsubscription_id =$sub->id;
                        $newDeduction->amount_deducted = 0;
                        $newDeduction->entry_month = $latestMasterDate;
                        $newDeduction->notes = $latestMasterDate.' IPPIS loan deduction';
                        $newDeduction->uploaded_by = auth()->id();
                        $newDeduction->save();
                        $remainingDeductible = 0;
                }
               
            }
        }//end of first foreach
    }catch(\Exception $e){
        DB::rollback();
        toastr()->error('An error has occurred trying to spread your loan payment.');
        return back();
    }
   DB::commit();
    toastr()->success('IPPIS Loan deduction inputs processed successfully!');
    //redirect to listing page order by latest
    return redirect('/loanDeduction/listings');
}
//

//Distribute Uploaded Analysis
// public function distributeAnalysis(){

// }

}
