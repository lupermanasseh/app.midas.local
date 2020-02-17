<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Saving;
use Carbon\Carbon;
use PDF;
use GuzzleHttp\Client;
use App\Exports\MasterSavingExport;
use Maatwebsite\Excel\Facades\Excel;
class ContributorsController extends Controller
{
    //
    public function index(){
        //
        $title ='All Active Contributors';
        $activeUsers= User::where('status','Active')->withCount(['usersavings' => function ($query) {
            $query->latest('entry_date');
           }])->get();
        // $activeUsers= User::where('status','Active')
        //                     ->latest('date_entry')
        //                     ->get();
        return view('Contributors.index',compact('activeUsers','title'));
    }

    public function inactiveUsers(){
        $title = 'Inactive Users';
        $inactiveUsers= User::where('status','Inactive')->withCount(['usersavings' => function ($query) {
     $query->orderBy('entry_date', 'desc');
    }])->get();
    return view('Contributors.inactiveContributors',compact('inactiveUsers','title'));

    }

    public function recentUploads(){
        
        $title = 'Recent Saving Uploads';
        // List recent uploads 
        $recentUploads= Saving::with('user')->latest()->paginate(100);
        return view('Contributors.recentSavings',compact('recentUploads','title'));

    }

    public function userListings($user_id){
        
        $title = 'User Saving Listing';
        $userSavings = Saving::where('user_id',$user_id)
                            ->where('status','Active')
                            ->with('user')
                            ->latest('entry_date')
                            ->get();
        return view('Contributors.userListings',compact('userSavings','title'));

    }

    public function edit($id)
    {
        $title ='Edit User Saving';
        $Saving = Saving::find($id);
        return view('Contributors.editSaving',compact('Saving','title'));
    }

    public function update(Request $request,$id)
    {

        $this->validate(request(), [
            'amount_saved' =>'required|numeric|between:0.00,999999999.99',
            ]);

                $saving = Saving::find($id);
                $saving->amount_saved = $request['amount_saved'];
                $saving->created_by = auth()->user()->first_name;
                $saving->save();
                if($saving->save()) {
                    toastr()->success('Saving record has been edited successfully!');
                    return redirect('/recent/savings');
                }
            
                toastr()->error('An error has occurred trying to update a saving record!');
                return back();
    }


    
//Display pendfing savings that are waiting approval
public function pending(){
    $title= "Pending Savings";
    $pendings = Saving::where('status','Pending')
                            ->with('user')
                            ->oldest('entry_date')
                            ->get();
    return view('Contributors.pending',compact('title','pendings'));
}

//Approve savings deposit
public function approveSaving($id){
    $saving = Saving::find($id);
    $user_id = $saving->user->id;
    $phone = $saving->user->phone;
    $amount = $saving->amount_saved;

    $saving->status ="Active";
    $saving->save();
    if($saving->save()){

        $currentBalance = number_format($saving->netBalance($user_id),2,'.',',');
        $client = new Client;
        $api = '9IGspBnLAjWENmr9nPogQRN9PuVwAHsSPtGi5szTdBfVmC2leqAe8vsZh6dg';
        $to = $phone;
        $from= 'MIDASTOUCH';
        $message = 'Credit alert. Acct: Savings. Amount: N' .number_format($amount,2,'.',',').'. Balance: N'. $currentBalance;
       $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.$api.'&from='.$from.'&to='.$to.'&body='.$message.'&dnd=1';

       $response = $client->request('GET', $url,['verify'=>false]);
    }else{

    }
}



//Create new individual saving form
public function create($id){
    $title= "New Saving";
    $userid = $id;
    return view('Contributors.create',compact('title','userid'));
}

//Store new saving  individually
public function store(Request $request){
    $this->validate(request(), [
        'user_id'=>'required|integer',
        'date' =>'required|date',
        'notes' =>'required|string',
        'bank' =>'required|string',
        //'bank_add' =>'required|string',
        'depositor' =>'required|string',
        'teller' =>'required|string',
        'amount' =>'required|numeric|between:0.00,999999999.99',
        ]);

            $user_id = $request['user_id'];
            $date = $request['date'];
            $notes = $request['notes'];
            $amount = $request['amount'];
            $bank = $request['bank'];
            //$bank_add = $request['bank_add'];
            $depositor = $request['depositor'];
            $teller = $request['teller'];
       
            $user = User::find($user_id);
            $phone = $user->phone;
            //
            $newsaving = new Saving;
            $newsaving->user_id = $user_id;
            $newsaving->amount_saved = $amount;
            $newsaving->entry_date = $date;
            $newsaving->notes = $notes;
            $newsaving->bank_name = $bank;
            $newsaving->status = 'Pending';
            $newsaving->depositor_name = $depositor;
            $newsaving->teller_no = $teller;
            $newsaving->created_by = auth()->user()->first_name;
            $newsaving->save();
            if($newsaving->save()) {
                    //send saving credit message
                //     $currentBalance = number_format($newsaving->totalCredit($user_id)-$newsaving->totalDebit($user_id),2,'.',',');
                //     $client = new Client;
                //     $api = '9IGspBnLAjWENmr9nPogQRN9PuVwAHsSPtGi5szTdBfVmC2leqAe8vsZh6dg';
                //     $to = $phone;
                //     $from= 'MIDASTOUCH';
                //     $message = 'Credit alert. Acct: Savings. Amount: N' .number_format($amount,2,'.',',').'. Balance: N'. $currentBalance;
                //    $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.$api.'&from='.$from.'&to='.$to.'&body='.$message.'&dnd=1';
   
                //    $response = $client->request('GET', $url,['verify'=>false]);

                toastr()->success('Saving credit record created successfully, but waiting for approval!');
                return redirect('/saving/listings/'.$user_id);
            }
        
            toastr()->error('An error has occurred trying to credit your saving account.');
            return back();
     
}


//saving withdrawal form
public function savingWithdraw($id){
    $title= "Saving Withdrawal";
    $userid =$id;
    return view('Contributors.withdrawal',compact('title','userid'));
}

//saving withdraw store
public function withdrawalStore(Request $request){
    $this->validate(request(), [
        'user_id'=>'required|integer',
        'date' =>'required|date',
        'notes' =>'required|string',
        'amount' =>'required|numeric|between:0.00,999999999.99',
        ]);
        $user_id = $request['user_id'];
        $amt = $request['amount'];
        $date = $request['date'];
        $notes = $request['notes'];
        //new user
        $user = User::find($user_id);
        $phone = $user->phone;

            $newsaving = new Saving;
            //find 25% of balance on total saving
        //    $balanceOnSaving = $newsaving->totalCredit($user_id)-$newsaving->totalDebit($user_id);
        //    $twentyFivePercent = $balanceOnSaving*0.25;
        //    if($amt > $twentyFivePercent){
        //     toastr()->error('You are only allowed to withdraw 25% of total savings!');
        //     return back(); 
        //    }
            $newsaving->user_id = $user_id;
            $newsaving->amount_withdrawn = $amt;
            $newsaving->entry_date = $date;
            $newsaving->notes = $notes;
            $newsaving->status = 'Active';
            $newsaving->created_by = auth()->user()->first_name;
            $newsaving->save();
            if($newsaving->save()) {
                 //send saving debit message
                //  $currentBalance = number_format($newsaving->totalCredit($user_id)-$newsaving->totalDebit($user_id),2,'.',',');
                //  $client = new Client;
                //  $api = '9IGspBnLAjWENmr9nPogQRN9PuVwAHsSPtGi5szTdBfVmC2leqAe8vsZh6dg';
                //  $to = $phone;
                //  $from= 'MIDAS';
                //  $message = 'Debit alert. Acct: Savings. Amount: N' .number_format($amt,2,'.',',').'. Balance: N'. $currentBalance;
                // $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.$api.'&from='.$from.'&to='.$to.'&body='.$message.'&dnd=1';

                // $response = $client->request('GET', $url,['verify'=>false]);
                toastr()->success('Saving account debited successfully!');
                return redirect('/recent/savings');
            }
        
            toastr()->error('An error has occurred trying to debit your saving account');
            return back();
}

//saving search
public function search(){
    $title = "Search Saving";
    return view('Contributors.search',compact('title'));
}
//process search
public function searchProcess(Request $request){
    $title = "Saving Search Result";
    $this->validate(request(), [
        'from' =>'required|date',
        'to' =>'required|date'
        ]);
        $from = $request['from'];
        $to = $request['to'];
    $result= Saving::where('entry_date','>=',$from)
                            ->where('entry_date','<=',$to)
                            ->with('user')
                            ->latest('entry_date')
                            ->get();
    return view('Contributors.searchResult',compact('result','title'));
}
//statement of saving view form
public function statement(){
    $title = 'Find Statement';
    return view('Contributors.statement',compact('title'));
}

public function statementFind(Request $request){ 
    $title = 'Filtered Records';
     $this->validate(request(), [
    'reg_number'=>'required|integer',
     'from' =>'required|date',
     'to' =>'required|date',
     //'category' =>'required|string',
     ]);

     $from = $request['from'];
     $to = $request['to'];
     $pay_number = $request['payment_number'];
     //$category = $request['category'];
    

     //create date instances
     $fromDate = new Carbon($from);
     $toDate = new Carbon($to);
     $fromDate = $fromDate->toDateString();
     $toDate = $toDate->toDateString();

     $saving = new Saving;
     $heading ='Statement of Savings';
     $userObj = User::find($request['reg_number']);
     $user_id = $userObj->id;

     $result = $saving->findSavingRecords($fromDate,$toDate,$user_id);

     return view ('Contributors.statementResult',compact('title','result','fromDate','toDate','saving','userObj','user_id'));
     
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

//print html savings  statement
public function printFile($from,$to,$id){
        
    $title ="Statement of Savings";
    //create new Saving Object
    $Saving = new Saving;
    $userObj = User::find($id);
    $user_id = $userObj->id;
    //call the search method here
    $statementCollection = $Saving->findSavingRecords($from,$to,$user_id);
    
    return view('Prints.myPrint',compact('title','Saving','from','to','statementCollection','userObj'));
}

/**
     * method to download saving statement in pdf
     * pass in from and to dates adn user id
     */
    public function printPdf($from,$to,$id){
        $title = 'Statement of Savings';
        $Saving = new Saving;
        $userObj = User::find($id);
        $user_id = $userObj->id;
        $statementCollection = $Saving->findSavingRecords($from,$to,$user_id);

        $pdf = PDF::loadView('Prints.saving-statement',compact('Saving','title','statementCollection','from','to','userObj'));
        return $pdf->stream();
        // return $pdf->download('statementOfSavings.pdf');
    
    }

    //savings Master
public function savingsMaster(){
    $title = 'Savings Liability';
    return view('Contributors.masterSaving',compact('title'));
}

public function savingsMasterFind(Request $request){
    $title = 'Savings Liability';
    $saving = new Saving;
    $this->validate(request(), [
         'to' =>'required|date',
         ]);
         $to = $request['to'];
    $savingsCollection = $saving->masterSavingsAsAt($to);
    $contributors = Saving::where('status','Active')->get();
    $uniqueContributors = $contributors->unique('user_id');
    return view('Contributors.masterSavingResult',compact('title','savingsCollection','to','saving','uniqueContributors'));
}

//master saving excel download
public function masterSavingExport($to){
    $fileName = 'MIDAS_SAVINGS_AT_'.$to.'.xlsx';
    return Excel::download(new MasterSavingExport($to), $fileName);
}

//Master Saving PDF Print
public function masterSavingPdf($to){
    $title = 'Master Saving';
    $saving = new Saving;
    $savingsCollection = $saving->masterSavingsAsAt($to);
    $contributors = Saving::where('status','Active')->get();
    $uniqueContributors = $contributors->unique('user_id');

    $pdf = PDF::loadView('Prints.masterSavingPdf',compact('title','savingsCollection','to','saving','uniqueContributors'));
    return $pdf->stream();
    // return $pdf->download('statementOfSavings.pdf');

}

    //delete saving
    public function destroy($id)
    {
        $saving = Saving::find($id)->delete();
        if ($saving) {
            toastr()->success('Saving has been discard successfully!');
            return redirect('/recent/savings');
        }
        toastr()->error('An error has occurred trying to remove saving record, please try again later.');
        return back();
    }

}
