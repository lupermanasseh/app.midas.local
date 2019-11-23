@extends('Layouts.userSigninLayout')
@section('user-signin')
<div></div>
<div class="user-signinlogocontainer">
    <p>Oops! Something went wrong</p>
    {{-- <img src="{{asset('images/logo.png')}}" alt="" class="logo-usersignin"> --}}
</div>

<div class="user-signinform">
    <div class="user-customsearch__item">
        <p><a href="/Dashboard">Home</a></p>
    </div>
</div>
@endsection