<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Targetsr;
use App\TargetSaving;
use App\User;
use Carbon\Carbon;
use App\Exports\TargetSavingExport;
use App\Imports\TargetSavingImport;
use Maatwebsite\Excel\Facades\Excel;
use GuzzleHttp\Client;

class TargetSavingController extends Controller
{
    //

    public function index(){
        $title ='Active Target Saving Deductions';
        $ts = Targetsr::where('status','Active')->oldest()->with(['user'])
        ->paginate(20);
        return view('TargetSaving.index',compact('ts','title'));
    }


    //Export
    public function export(){
        $jstNow = Carbon::now()->toDateString();
        $fileName = 'MIDAS_TARGETSAVINGS_'.$jstNow.'.xlsx';
        return Excel::download(new TargetSavingExport(), $fileName);
    }

    //create upload form
    public function tsUpload(){
        $title = 'Upload User Target Savings';
      return view('TargetSaving.tsUpload',compact('title'));
    }


    public function tsImport(){

        try{
      Excel::import(new TargetSavingImport(),request()->file('ts_import'));
        }catch(\Exception $ex){
            toastr()->error('An error has occurred trying to import target savings');
                return back();
        }catch(\Error $ex){
            toastr()->error('Something bad has happened');
            return back();
        }
      
        toastr()->success('Target savings uploaded successfully!');
        //redirect to listing page order by latest
        return redirect('/recent/targetsavings');
    
    }

//Recent target savings uploads
public function recentTargetSavings(){ 
    $title = 'Recent Target Saving';
    // List recent target saving uploads 
    $recentTs= TargetSaving::with('user')->latest('entry_date')->paginate(100);
    return view('TargetSaving.recentTargetSaving',compact('recentTs','title'));

}

public function edit($id){ 
    $title = 'Edit Target Saving';
    // List recent u
    $tSaving = TargetSaving::find($id);
    return view('TargetSaving.editTargetSaving',compact('tSaving','title'));

}

//Update Target Saving Record
public function update(Request $request, $id){
    $targetsaving = TargetSaving::find($id);
    $this->validate(request(), [
        'amount' =>'required|numeric|between:0.00,999999999.99',
        ]);

            $targetsaving->amount = $request['amount'];
            //$targetsaving->created_by = auth()->id();
            $targetsaving->save();
            if($targetsaving->save()) {
                toastr()->success('Target saving record has been edited successfully!');
                return redirect('/recent/targetsavings');
            }
        
            toastr()->error('An error has occurred trying to update a target saving record!');
            return back();
}

//Delete Target Saving Record
public function destroy($id){
    $ts_saving = TargetSaving::find($id)->delete();
    if ($ts_saving) {
        toastr()->success('Target saving has been discarded successfully!');
        return redirect('/recent/targetsavings');
    }

    toastr()->error('An error has occurred trying to remove target saving record, please try again later.');
    return back();
}


//Show create form for new target saving
public function create($id){
$title = "New Target Saving";
$userid = $id;
return view('TargetSaving.create',compact('title','userid'));
}


//Store New Target Saving
public function store(Request $request){
    $this->validate(request(), [
        'user_id'=>'required|integer',
        'date' =>'required|date',
        'notes' =>'required|string',
        'bank' =>'required|string',
        'bank_add' =>'required|string',
        'depositor' =>'required|string',
        'teller' =>'required|string',
        'amount' =>'required|numeric|between:0.00,999999999.99',
        ]);

            $user_id = $request['user_id'];
            $date = $request['date'];
            $notes = $request['notes'];
            $amount = $request['amount'];
            $bank = $request['bank'];
            $bank_add = $request['bank_add'];
            $teller = $request['teller'];
            $depositor = $request['depositor'];

            $tsSaving = new TargetSaving;
            $user = User::find($user_id);
            $phone = $user->phone;
       
            //find active target subscription
            $tsid = $tsSaving->activeTargetsr($user_id);
            if($tsid ==""){
                toastr()->error('You have no active subscription to this service');
                return redirect('/user/page/'.$user_id); 
               }

            
            
            $tsSaving->user_id = $user_id;
            $tsSaving->targetsr_id = $tsid;
            $tsSaving->amount = $amount;
            $tsSaving->entry_date = $date;
            $tsSaving->notes = $notes;
            $tsSaving->bank_name = $bank;
            $tsSaving->bank_add = $bank_add;
            $tsSaving->depositor_name = $depositor;
            $tsSaving->teller_no = $teller;
            $tsSaving->created_by = auth()->id();
            $tsSaving->save();
            if($tsSaving->save()) {

                //send message
                $currentTsBalance = number_format($tsSaving->targetSavingBalance($tsid),2,'.',',');
                $client = new Client;
                $api = '9IGspBnLAjWENmr9nPogQRN9PuVwAHsSPtGi5szTdBfVmC2leqAe8vsZh6dg';
                $to = $phone;
                $from= 'MIDAS';
                $message = 'Credit alert. Acct: Target Savings. Amount: N' .number_format($amount,2,'.',',').'. Bal: N'. $currentTsBalance;
               $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.$api.'&from='.$from.'&to='.$to.'&body='.$message.'&dnd=1';

               $response = $client->request('GET', $url,['verify'=>false]);
               toastr()->success('Target saving account credited successfully!');
               return redirect('/tsSub/detail/'.$tsid);
            }
        
            toastr()->error('An error has occurred trying to create a new target saving');
            return back();

}

//pass in targetsr id
    public function tsListings($id){
        
    $title = 'Target Saving Listing';
    $tsSavings = TargetSaving::where('targetsr_id',$id)
    ->with('user')
    ->latest('entry_date')
    ->paginate(50);
    return view('TargetSaving.tsDetail',compact('tsSavings','title'));
    }

    //register new/review ts saving
public function regTs($id){
    $title = "New TS Saving";
    $userid = $id;
    return view('TargetSaving.tsReg',compact('title','userid'));
}

//store register new/review ts saving
public function regTsStore(Request $request){
    //validate
    $this->validate(request(), [
        'user_id' =>'required|numeric',
        'amount' =>'required|numeric||between:0.00,999999999.99',
        'start_date' =>'required|date',
        'end_date' =>'required|date',
    ]);

    //select active records an deactivate them
    $tsreviews = Targetsr::where('user_id',$request['user_id'])
                                ->where('status','Active')
                                ->get();
        if(count($tsreviews)>=1){
            //deactivate here
            toastr()->error('Deactivate previous saving record and try again.');
            return redirect('/user/page/'.$request['user_id']);
        }

        $saving = new Targetsr;
        $saving->user_id = $request['user_id'];
        $saving->status = 'Active';
        $saving->monthly_saving=$request['amount'];
        $saving->start_date=$request['start_date'];
        $saving->end_date=$request['end_date'];
        $saving->review_by = auth()->id();
        if($saving->save()){
            toastr()->success('Target Saving registration completed successfully');
            return redirect('/user/page/'.$request['user_id']);
        }
        toastr()->error('Unable to create saving amount.');
        return back();
}

//Target saving withdrawal form
public function tsWithdraw($id){
    $title= "Target Saving Withdrawal";
    $userid =$id;
    return view('TargetSaving.withdraw',compact('title','userid'));
}

//Target saving withdrawal store
public function tsWithdrawalStore(Request $request){
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

            $tsSaving = new TargetSaving;
            $tsid = $tsSaving->activeTargetsr($user_id);
            if($tsid ==""){
                toastr()->error('You have no active subscription to this service');
                return redirect('/user/page/'.$user_id); 
               }
            $tsBal = $tsSaving->targetSavingBalance($tsid);
        
           if($amt > $tsBal){
            toastr()->error('You do not have enough balance on this account');
            return back(); 
           }
            $tsSaving->user_id = $user_id;
            $tsSaving->targetsr_id = $tsid;
            $tsSaving->withdrawal = $amt;
            $tsSaving->entry_date = $date;
            $tsSaving->notes = $notes;
            $tsSaving->created_by = auth()->id();
            $tsSaving->save();
            if($tsSaving->save()) {
                 //send saving debit message
                 $currentTsBalance = number_format($tsSaving->targetSavingBalance($tsid),2,'.',',');
                 $client = new Client;
                 $api = '9IGspBnLAjWENmr9nPogQRN9PuVwAHsSPtGi5szTdBfVmC2leqAe8vsZh6dg';
                 $to = $phone;
                 $from= 'MIDAS';
                 $message = 'Debit notification. Acct: Target Savings. Amount: N' .number_format($amt,2,'.',',').'. Balance: N'. $currentTsBalance;
                $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.$api.'&from='.$from.'&to='.$to.'&body='.$message.'&dnd=1';

                $response = $client->request('GET', $url,['verify'=>false]);
                toastr()->success('Target saving account debited successfully!');
                return redirect('/tsSub/detail/'.$tsid);
            }
            toastr()->error('An error has occurred trying to debit your target saving account');
            return back();
}

//Target saving search
public function tsSearch(){
    $title = "Search Target Saving";
    return view('TargetSaving.search',compact('title'));
}
//process search
public function searchProcess(Request $request){
    $title = "TS Search Result";
    $this->validate(request(), [
        'from' =>'required|date',
        'to' =>'required|date'
        ]);
        $from = $request['from'];
        $to = $request['to'];
    $recentTs= TargetSaving::where('entry_date','>=',$from)
                            ->where('entry_date','<=',$to)
                            ->with('user')
                            ->latest('entry_date')
                            ->paginate(100);
    return view('TargetSaving.searchResult',compact('recentTs','title'));
}


}
