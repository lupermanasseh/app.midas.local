<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Admin;
use App\Role;
use App\Nok;
use App\Bank;
use Carbon\Carbon;
use App\Savingreview;
use App\Exports\UsersExport;
use App\Imports\UserImport;
use App\Imports\NokUserImport;
use App\Imports\BankUserImport;
use App\Imports\SavingReviewUserImport;
use Maatwebsite\Excel\Facades\Excel;

class RegistrationController extends Controller
{
    //constructor
    public function __constructor(){
    //prevent user from seeing signin page
    $this->middleware('auth');
    }

  //Register  new staff
  public function addUser (){
    $title ="Add Staff";
    return view('Registration.newStaff',compact('title'));
}

  //Store  new staff
  public function addUserStore (Request $request){
    //validate the form
    $this->validate(request(), [
        'password' =>'required|confirmed',
        'email' =>'email',
        //'title'=>'required',
        'first_name'=>'required|string',
        'last_name'=>'required|string',
        'other_name'=>'required|string',
        'phone'=>'required',
        //'dob'=>'required|date',
        //'home_add'=>'required|max:100',
        //'res_add'=>'required|max:100',
        'sex'=>'required',
    ]);
    

    $admin = new Admin();

    $admin->password = Hash::make($request['password']);
    $admin->email = $request['email'];
    //$user->title = $request['title'];
    $admin->first_name = $request['first_name'];
    $admin->last_name = $request['last_name'];
    $admin->other_name = $request['other_name'];
    $admin->phone = $request['phone'];
    //$user->dob = $request['dob'];
    //$user->home_add = $request['home_add'];
    //$user->res_add = $request['res_add'];
    $admin->sex = $request['sex'];
    $admin->save();
    //Create the staff
   // $user = User::create(request(['payment_number','password','email']));
    $admin->roles()->attach(request(['role']));

    if ($admin->save()) {
       // $user_id = $user->userID($payment_number);
        toastr()->success('Data has been saved successfully!');
        return back();
        //return redirect()->route('posts.index');
       // return redirect('/userDetails/'.$user_id);
    }

    toastr()->error('An error has occurred please try again later.');
    return back();
}

    //Register  new  member
    public function createUser (){
        $title ="New User";
        return view('Registration.newUser',compact('title'));
    }
    

 
   //Store  new member
   public function storeUser (Request $request){
    //validate the form
    $this->validate(request(), [
        'payment_number'=>'required|numeric||between:0.00,999999999.99',
        'password' =>'required|confirmed',
        'email' =>'email',
        'title'=>'required',
        'first_name'=>'required|string',
        'last_name'=>'required|string',
        'employ_type'=>'required|string',
        'member_type'=>'required',
        'dept'=>'required',
        'phone'=>'required',
        'dob'=>'required|date',
        'dofa'=>'required|date',
        'home_add'=>'required|max:100',
        'res_add'=>'required|max:100',
        'sex'=>'required',
        'job_cadre'=>'required',
        'staff_no'=>'required|numeric||between:0.00,999999999.99',
        'marital_status'=>'required',
    ]);
    

    $user = new User();
    $payment_number = $request['payment_number'];
    $user->payment_number = $payment_number;
    $user->password = Hash::make($request['password']);
    $user->email = $request['email'];
    $user->title = $request['title'];
    $user->first_name = $request['first_name'];
    $user->last_name = $request['last_name'];
    $user->other_name = $request['other_name'];
    $user->employ_type = $request['employ_type'];
    $user->membership_type = $request['member_type'];
    $user->dept = $request['dept'];
    $user->dofa = $request['dofa'];
    $user->phone = $request['phone'];
    $user->dob = $request['dob'];
    $user->home_add = $request['home_add'];
    $user->res_add = $request['res_add'];
    $user->sex = $request['sex'];
    $user->job_cadre = $request['job_cadre'];
    $user->staff_no = $request['staff_no'];
    $user->marital_status = $request['marital_status'];
    $user->save();
    //Create the staff
   // $user = User::create(request(['payment_number','password','email']));
    //$user->roles()->attach(request(['role']));

    if ($user->save()) {
        $user_id = $user->userID($payment_number);
        toastr()->success('Data has been saved successfully!');

        //return redirect()->route('posts.index');
        return redirect('/userDetails/'.$user_id);
    }

    toastr()->error('An error has occurred please try again later.');
    return back();
}

//form for nok 
public function nextOfKin ($id){
    $title ="User NOK";
    $id = $id;
    return view('Registration.userNok',compact('title','id'));
}

//Save next of kin
public function nokStore (Request $request){
    
    //validate the form
    $this->validate(request(), [
        'email' =>'email',
        'title'=>'required',
        'sex'=>'required',
        'user_id'=>'required',
        'relationship'=>'required',
        'first_name'=>'required',
        'last_name'=>'required',
        'phone'=>'required',
    ]);
       
        $user_nok = new Nok();
        $user_id = $request['user_id'];
        $user_nok->user_id = $user_id;
        $user_nok->relationship = $request['relationship'];
        $user_nok->email = $request['email'];
        $user_nok->gender = $request['sex'];
        $user_nok->title = $request['title'];
        $user_nok->first_name = $request['first_name'];
        $user_nok->last_name = $request['last_name'];
        $user_nok->other_name = $request['other_name'];
        $user_nok->phone = $request['phone'];   
        $user_nok->save();

        if ($user_nok->save()) {
            toastr()->success('User Next of Kin has been saved successfully!');
    
            return redirect('/userDetails/'.$user_id);
        }
        toastr()->error('An error has occurred please try again later.');
        return back();  
}


//form for USER BANK DETAILS
public function bank($id){
    $title ="User Bank Detail";
    $id = $id;
    return view('Registration.userBank',compact('title','id'));
}

//Save bank Store
public function bankStore (Request $request){
    //validate the form
    $this->validate(request(), [
        'bank_name' =>'required',
        //'bank_branch' =>'required',
        'user_id' =>'required',
        'sort_code' =>'required',
        //'acct_name' =>'required',
        'acct_number' =>'required|integer|digits:10',
    ]);

 
        
        $user_id = $request['user_id'];
        $user_bank = new Bank();
        $user_bank->bank_name = $request['bank_name'];
        //$user_bank->bank_branch = $request['bank_branch'];
        $user_bank->sort_code = $request['sort_code'];
        //$user_bank->acct_name = $request['acct_name'];
        $user_bank->acct_number = $request['acct_number'];
        $user_bank->user_id = $user_id;
        $user_bank->save();
        if ($user_bank->save()) {
            toastr()->success('User bank details has been saved successfully!');
    
            return redirect('/userDetails/'.$user_id);
        }
        toastr()->error('An error has occurred trying to save record, please try again later.');
        return back();
   
   
}
public function photoCreate($id){

    $title = "Upload User Photo Image";
    $id = $id;
    return view('Registration.uploadPhoto',compact('title','id'));
}

//Upload user image
public function photoStore(Request $request){
    //validate the form
    $this->validate(request(), [
        'photo_image' =>'image|max:1999',
        'user_id' =>'required',
    ]);
        $myFile = $request['photo_image'];
        $filenameWithExt = $request->file('photo_image')->getClientOriginalName();
        //filename without extension
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
        $extension = $request->file('photo_image')->getClientOriginalExtension();
        //filename to store
        $filenameToStore = $filename.'_'.time().'.'.$extension;

        //move to public folder as an asset
        $myFile->move('uploads/userImages',$filenameToStore);



        //image path
        //$path = $request->file('photo_image')->storeAs('public/photos',$filenameToStore);
 
        
        $user_id = $request['user_id'];
        $user = User::find($user_id);

        //$user->photo = $filenameToStore;
        $user->photo = 'uploads/userImages/'.$filenameToStore;
        $user->save();
        if ($user->save()) {
            toastr()->success('Photo uploaded');
    
            return redirect('/userDetails/'.$user_id);
        }
        toastr()->error('An error has occured uploading photo.');
        return back();
}

//register new saving
public function createSaving($id){
    $title = "New Saving";
    $id = $id;
    return view('Registration.createSaving',compact('title','id'));
}

//store saving
public function createSavingStore(Request $request){
    //validate
    $this->validate(request(), [
        'user_id' =>'required|numeric||between:0.00,999999999.99',
        'amount' =>'required|numeric||between:0.00,999999999.99',
    ]);

    //select active records an deactivate them
    $savingrviews = Savingreview::where('user_id',$request['user_id'])
                                ->where('status','Active')
                                ->get();
        if(count($savingrviews)>=1){
            //deactivate here
            toastr()->error('Deactivate previous saving record and try again.');
            return redirect('/userDetails/'.$request['user_id']);
        }
        $saving = new Savingreview;
        $saving->user_id = $request['user_id'];
        $saving->status = 'Active';
        $saving->current_amount=$request['amount'];
        $saving->created_by = auth()->id();
        if($saving->save()){
            toastr()->success('Saving amount created successfully');
            return redirect('/userDetails/'.$request['user_id']);
        }
        toastr()->error('Unable to create saving amount.');
        return back();
}

//deactivate saving
//TODO
/**
 * To deactivate a saving
 * 1. You must first clear yourself of all pending financial obligations
 * 
 */
public function deactivateSavingReview($id){
    $id = $id;
    $savingReview = Savingreview::find($id);
    $savingReview->status='Inactive';
    if($savingReview->save()){
        toastr()->success('Saving amount now inactive');
        return redirect('/userDetails/'.$savingReview->user_id);
    }
    toastr()->error('Unable to perform requested operation.');
    return back();
}

//filter users

public function filter(){
    $title = "Filter Membership";
    return view('Registration.filterUsers',compact('title'));
}

public function filterProcess(Request $request){
    $title = "Filter Membership Result";
  
    $this->validate(request(), [
   // 'payment_type' =>'required',
    'status' =>'required|string',
    'cadre' =>'required|string',
    'end_date' =>'required|date',
    ]);

    //$payment_type = $request['payment_type'];
    $status = $request['status'];
    $end_date = $request['end_date'];
    $cadre = $request['cadre'];
    $members = User::filterMembers($status,$end_date,$cadre);

    return view('Registration.filterUsersResult',compact('title','members','status','end_date','cadre'));
}

//download members
public function membersDownload($status,$end_date,$cadre){
    $end_date = new Carbon($end_date);
    $end_date = $end_date->toDateString();
    $fileName = 'MIDAS_MEMBERS_AS_AT_'.$end_date.'.xlsx';
    return Excel::download(new UsersExport($status,$end_date,$cadre), $fileName);
}


//member bulk upload form
public function uploadForm(){
$title ="Members Upload form";
return view('Registration.userBulkUpload',compact('title'));
}

// bulk upload members
public function membersUpload(){
    DB::beginTransaction();
        try{
        Excel::import(new UserImport(),request()->file('user_import'));
        }catch(\Exception $ex){
            DB::rollback();
              toastr()->error('Unable to upload bulk user data!');
            return back();
        }catch(\Error $ex){
            DB::rollback();
              toastr()->error('Something bad has happened');
              return back();
        }

            DB::commit();
          toastr()->success('Members bulk upload  successful!');
          //redirect to listing page order by latest
          //return back();
          return redirect('/user/all');
      }

      //nok bulk upload
public function nokUploadForm(){
    $title ="NOK Upload form";
    return view('Registration.nokBulk',compact('title'));
    }

    //Nok bulk upload members
public function nokBulkUpload(){
   DB::beginTransaction();
    try{
    Excel::import(new NokUserImport(),request()->file('nok_import'));
      }catch(\Exception $ex){
       DB::rollback();
          toastr()->error('Unable to upload bulk NOK data!');
              return back();
      }catch(\Error $ex){
        DB::rollback();
          toastr()->error('Something bad has happened');
          return back();
      }
  DB::commit();
      toastr()->success('NOK bulk data upload  successful!');
      //redirect to listing page order by latest
      //return back();
      return redirect('/user/nok');
  }

//bulk upload bank details
  public function bankUploadForm(){
    $title ="Bulk Bank Upload Form";
    return view('Registration.bankBulk',compact('title'));
    }

    //bank upload process
    public function bankBulkUpload(){
       DB::beginTransaction();
        try{
        Excel::import(new BankUserImport(),request()->file('bank_import'));
          }catch(\Exception $ex){
              DB::rollback();
              toastr()->error('Unable to upload bulk Bank data!');
                  return back();
          }catch(\Error $ex){
             DB::rollback();
              toastr()->error('Something bad has happened');
              return back();
          }
          DB::commit();
          toastr()->success('Bank bulk data upload  successful!');
          //redirect to listing page order by latest
          //return back();
          return redirect('/user/bank');
      }

//Saving registration bulk upload form
public function savingRegUploadForm(){
    $title = "SAVING REG - BULK UPLOAD";
    return view('Registration.savingReg',compact('title'));
}

//
   //bank upload process
   public function savingRegUpload(){
  DB::beginTransaction();
    try{ 
    Excel::import(new SavingReviewUserImport(),request()->file('savingreg_import'));
      }catch(\Exception $ex){
        DB::rollback();
          toastr()->error('Unable to create bulk saving registrations!');
              return back();
      }catch(\Error $ex){
        DB::rollback();
          toastr()->error('Something bad has happened');
          return back();
      }
     DB::commit();
      toastr()->success('Monthly  contribution amount uploaded  successfully!');
      //redirect to listing page order by latest
      return back();
      //return redirect('/recent/savings');
  }


  //Target saving registration bulk upload
public function tsUploadForm(){
    $title = "TS REG - BULK UPLOAD";
    return view('Registration.tsBulk',compact('title'));
}

//
   //ts upload process
   public function tsBulkUpload(){
   
    try{
    Excel::import(new TsUserImport(),request()->file('ts_import'));
      }catch(\Exception $ex){
          
          toastr()->error('Unable to create bulk target saving registrations!');
              return back();
      }catch(\Error $ex){
         
          toastr()->error('Something bad has happened');
          return back();
      }
     
      toastr()->success('Target saving registration bulk data upload  successful!');
      //redirect to listing page order by latest
      return back();
      //return redirect('/recent/savings');
  }


}
