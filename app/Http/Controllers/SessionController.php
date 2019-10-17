<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;

class SessionController extends Controller
{ 
    //protected $redirectTo ='/login';

    public function __constructor(){
        //prevent user from seeing signin page
        $this->middleware('guest', ['except'=>'destroy']);
        $this->middleware('guest:admin',['except'=>'destroy']);
    }
    //show login form
    public function create(){
        $title = "Login";
        return view('Session.create',compact('title'));
    }

    //log user in
    public function store(Request $request){
        $this->validate(request(), [
            'password' =>'required',
            'email' =>'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            //return '1234567';
            return redirect('/admin');
            
        }
        return back()->withErrors([
            'message'=>'Wrong Password or Email, Try Again!.'
        ]);    
        
    }

    //logout
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/login');
    }
}
