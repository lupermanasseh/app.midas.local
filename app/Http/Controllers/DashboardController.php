<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use App\Targetsr;
use App\TargetSaving;
use App\Saving;
use App\User;
use App\Ldeduction;
use App\Lsubscription;
use App\Productdeduction;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function onboarding(){
        $title ="Onboarding";
        return view('Dashboard.onboarding-change',compact('title'));
    }

    public function onboardingChange(Request $request,$id){
        $this->validate(request(), [
            'password' =>'required|confirmed|min:6|max:8',
             ]);
            $profile =User::find($id);
            $profile->password = Hash::make($request['password']);
            if ($profile->save()) {
                //toastr()->success('Data has been edited successfully!');
                return redirect('/Dashboard');
            }
    }
    //
    public function index (){
        $title ="Dashboard Home";

        $saving = new Saving;
        $targetSaving = new TargetSaving;
        $user = User::find(auth()->id());
        //Active Product Subscriptions
        $activeLoans = Lsubscription::activeLoans(auth()->id());
        $inactiveLoans = Lsubscription::inactiveLoans(auth()->id());
        //User target saving subscriptions
        $targetsr = Targetsr::where('user_id',$user->id)
                             ->where('status','Active')
                             ->get();
        return view('Dashboard.home',compact('user','saving','inactiveLoans','activeLoans','targetsr','targetSaving','title'));
    }


    //offline
    public function offline (){
        $title ="Offline";
        return view('Dashboard.offline',compact('title'));
    }

     //print html savings  statement
     public function printStatement($from,$to){

        $title ="Statement of Savings";
        //create new Saving Object
        $Saving = new Saving;
        $userObj = User::find(auth()->id());
        $user_id = $userObj->id;
        //call the search method here
        $statementCollection = $Saving->findSavingRecords($from,$to,$user_id);

        return view('Prints.myPrint',compact('title','Saving','from','to','statementCollection','userObj'));
    }

    /**
     * method to download saving statement in pdf
     * pass in from and to dates
     */
    public function downloadStatement($from,$to){
        $title = 'Statement of Savings';
        $Saving = new Saving;
        $userObj = User::find(auth()->id());
        $user_id = $userObj->id;
        $statementCollection = $Saving->findSavingRecords($from,$to,$user_id);

        $pdf = PDF::loadView('Prints.saving-statement',compact('Saving','title','statementCollection','from','to','userObj'));
        return $pdf->stream();
        // return $pdf->download('statementOfSavings.pdf');

    }


    /**
     * Savings listing
     * Goup by created_at date
     * create a link to list savings by year
     * pass in the year
     */
    public function savingsGroup(){
        $title ="Saving Summmary";
        // $savingSummary = Saving::where('user_id',auth()->id())
        // ->orderBy('created_at')
        // ->get()
        // ->groupBy(function($item) {
        //     return $item->created_at->format('Y');
        // });
        $savingSummary = Saving::where('user_id',auth()->id())
        ->orderBy('entry_date','asc')
        ->get();
        return view('Dashboard.savingIndex',compact('title','savingSummary'));
    }

    /**
     * List all user savings
     */
    public function savings(){
        $title ="All Savings";
        $user_id = auth()->id();
        $saving = Saving::where('user_id',$user_id)
                            ->with('user')
                            ->get();
        return view('Dashboard.savings',compact('title','saving'));
    }

    //guarantor details page
    public function loansGuaranteedDetails($id){
        $title ='Guarantor Details';
        $newUser = User::find($id);
        $newSubObj = new Lsubscription;
        $firstGuarantor = Lsubscription::guarantorAsFirst($id);
        $secondGuarantor = Lsubscription::guarantorAsSecond($id);
        return view('Dashboard.detailGuarantor',compact('firstGuarantor','secondGuarantor','title','newUser','newSubObj'));
    }
    /**
     * Detail user savings by year
     * pass in year
     */
    public function savingsByYear($id){
        $title ="All Savings";
        $user_id = auth()->id();
        $saving= Saving::whereYear('entry_date',$id)
        ->with('user')
        ->orderBy('entry_date','asc')->get()->where('user_id',$user_id);
        return view('Dashboard.savings',compact('title','saving'));
    }

    /**
     * Target saving home page
     * list all subscriptions by a user
     */
    public function targetSavingHome()
    {
        //List all Target SavingSubscriptions
        $title ='Target Saving Home';
        $user_id = auth()->id();
        $targetSaving = Targetsr::where('user_id',$user_id)
        ->with('user')
        ->paginate(10);
        return view('Dashboard.targetsavingHome',compact('targetSaving','title'));
    }

    /**
     * list detail deductions for a particular target saving
     * pass in the targetsr id
     */

    public function targetSavingListings($id)
    {

        $title ='Target Saving Listings';
        //$user_id = auth()->id();
        $targetSavingList = TargetSaving::where('targetsr_id',$id)
        ->orderBy('entry_date')
        ->get();
        return view('Dashboard.tsListings',compact('targetSavingList','title'));

    }

    public function allTargetSavings(){
        $title ="All Target Savings";
        $user_id = auth()->id();
        $saving = TargetSaving::where('user_id',$user_id)
        ->with('user')
        ->orderBy('entry_date')
        ->paginate(12);
        return view('Dashboard.allTargetSave',compact('title','saving'));
    }

    /**
     * Loans functionality
     */
    public function allLoans()
    {
        $title ='All Loans';
        $user_id = auth()->id();
        $loans = Lsubscription::where('user_id',$user_id)
                            ->where('loan_status','Active')
                            ->orWhere('loan_status','overpaid')
                            ->with('user')
                            ->get();
        return view('Dashboard.allLoans',compact('loans','title'));
    }

        public function loanDeductionHistory($id)
        {
        $title ='Loan Deductions';
        //$user_id = auth()->id();
        $loan = Lsubscription::find($id);
        $deductions = Ldeduction::where('lsubscription_id',$id)
        ->oldest()
        ->paginate(12);
        return view('Dashboard.loanDeductions',compact('deductions','title','loan'));
        }

        /**
         * Find user loan details
         * pass in loan subscription id
         */
        public function loanDetails($id){
            $title = 'User Loan Details';
            //find the loan subscription details
            $userLoan = Lsubscription::find($id);
            return view('Dashboard.loanDetail',compact('userLoan','title'));
        }


/**
 * User pending apps
 */
public function pendingApps($id)
{
    $title ='Pending Subscription';
    $user_id = $id;
    $loans = Lsubscription::pendingLoans($user_id);
    return view('Dashboard.myPendingApps',compact('loans','title'));
}

/**
 * User paid loans
 */
public function paidLoans($id)
{
    $title ='Paid Loans';
    $user_id = $id;
    $loans = Lsubscription::paidLoans($user_id);
    return view('Dashboard.myPaidLoans',compact('loans','title'));
}

/**
 * Product schemes functioanlity
 */
public function allProducts()
    {
        $title ='All Product Subscription';
        $user_id = auth()->id();
        $products = Psubscription::where('user_id',$user_id)
        ->with('user')
        ->paginate(12);
        return view('Dashboard.allProducts',compact('products','title'));
}

/**
 * Product subscription details
 */
public function productDetails($id)
    {
        $title ='Product Subscription  Details';
        $products = Lsubscription::find($id);
        return view('Dashboard.productDetail',compact('products','title'));
}

/**
 * Product deduction history
 * pass in product subscription id
 */

public function productDeductionHistory($id)
{
$title ='Product Deductions';
//$user_id = auth()->id();
$deductions = Productdeduction::where('psubscription_id',$id)
->latest()
->paginate(12);
return view('Dashboard.productDeductions',compact('deductions','title'));
}

    /**
     * Search functionality method
     */
public function customSearch(Request $request){

           $title = 'Filtered Records';
            $this->validate(request(), [
            'from' =>'required|date',
            'to' =>'required|date',
            //'category' =>'required|string',
            ]);

            $from = $request['from'];
            $to = $request['to'];
            //$category = $request['category'];

            //create date instances
            $fromDate = new Carbon($from);
            $toDate = new Carbon($to);
            $fromDate = $fromDate->toDateString();
            $toDate = $toDate->toDateString();

            $saving = new Saving;
            $heading ='Statement of Savings';
            $userObj = User::find(auth()->id());
            $user_id = $userObj->id;

            $records = $saving->findSavingRecords($fromDate,$toDate,$user_id);

            return view ('Dashboard.searchSaving',compact('title','records','fromDate','toDate','saving','userObj'));

            // if($category =="Loan"){
                //process search for loan
                // $heading ='Filtered Loan Records';
                // $user_id = auth()->id();
                // $collection = Ldeduction::whereBetween('created_at', [$from,$to])
                // ->orderBy('created_at')
                // ->get();
                // $records = $collection->where('user_id',$user_id);

                // return view ('Dashboard.searchLoans',compact('title','records'));
            // }elseif($category=="TS"){
            //     //process search for Target Saving
            //     $heading ='Filtered Target Savings';
            //     $user_id = auth()->id();
            //     $collection = TargetSaving::whereBetween('created_at', [$from,$to])
            //     ->orderBy('created_at')
            //     ->get();
            //     $records = $collection->where('user_id',$user_id);

            //     return view ('Dashboard.searchTs',compact('title','records'));
            // }
            // elseif($category=="Saving"){
            //     //process search for saving
            //     $heading ='Filtered  Savings';
            //     $user_id = auth()->id();
            //     $collection = Saving::whereBetween('created_at', [$from,$to])
            //     ->orderBy('created_at')
            //     ->get();
            //     $records = $collection->where('user_id',$user_id);

            //     return view ('Dashboard.searchSaving',compact('title','records','from','to'));
            // }
    }


}
