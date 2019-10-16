<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MemberController extends Controller
{
    //
    public function __constructor(){
        //prevent user from seeing signin page
        $this->middleware('guest', ['except'=>'destroy']);
        $this->middleware('guest:admin', ['except'=>'destroy']);
    }

    public function memberLogin(){
        $title = 'Member Login';
        return view('Dashboard.signin',compact('title'));
    }

   
    public function memberAccess(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
    
        if (Auth::attempt(request(['password','email']))){
        return '1234567';
            //return redirect('/admin');
            
        }
        return '1111111';
        // return back()->withErrors([
        //     'message'=>'Wrong Password or Email, Try Again!.'
        // ]);
      
    }
}
