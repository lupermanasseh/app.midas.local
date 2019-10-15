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
    public function store(){
        $this->validate(request(), [
            'password' =>'required',
            'payment_number' =>'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('/admin');
        }
       
        //attempt to login
        // if(!Auth::attempt(request(['password','payment_number']))){
        //     return back()->withErrors([
        //         'message'=>'Please check your login credentials and try again.'
        //     ]);
        // } 
        // //check to see if user has roles
        // $user = User::where('payment_number', request(['payment_number']))->first();
        // if($user->checkRole())
        // {
        //     return redirect('/admin');
        // }
        //     return redirect('/Dashboard/home');
        
        
        //check if id exist in role
        //if true, then staff and user, create a link to show user portal for staff only
        //otherwise redirect to user portal


        //redirect
        //return redirect('/Dashboard');
        
    }

    //logout
    public function destroy(){
        auth()->logout();
        return redirect('/login');
    }
}
