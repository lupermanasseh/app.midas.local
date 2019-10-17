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

   
    public function memberAccess()
    {
        $this->validate(request(), [
            'email'   => 'required|email',
            'password' => 'required|min:2'
        ]);

        if (Auth::attempt(request(['email', 'password']))) {
            
            return redirect('/Dashboard');
            
        }
        return back()->withErrors([
            'message'=>'Wrong Password or Email, Try Again!.'
        ]);
    }

    public function destroy(){
        auth()->logout();
        return redirect('/member/login');
    }
}
