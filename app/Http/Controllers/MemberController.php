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
            'password' => 'required'
            //'password' => 'required|min:6'
        ]);

        if (Auth::attempt(request(['email', 'password']))) {
            //check for default password
            if(auth()->user()->password=='$2y$10$rw9maVUQyXpKPwyo47/UlO.6GQRvVOYmnGN4UvzBwjoQgwxlw8uAG'){
                
                return redirect('/Dashboard/onboarding');
            }
            
            return redirect('/Dashboard');
            
        }
        return back()->withErrors([
            'message'=>'Wrong Password or Email, Try Again!.'
        ]);
    }

    public function destroy(){
        auth()->logout();
        return redirect('/Dashboard/login');
    }
}
