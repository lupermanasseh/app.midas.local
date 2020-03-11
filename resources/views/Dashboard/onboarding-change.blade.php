@extends('Layouts.userSigninLayout')
@section('user-signin')
<div></div>
<div class="user-signinlogocontainer">
    <img src="{{asset('images/logo.png')}}" alt="" class="logo-usersignin">
</div>
<div class="user-signinlogocontainer">
    <span>Hi, {{auth()->user()->first_name}}, change your password!</span>
</div>
<div class="user-signinlogocontainer">
    @if(count($errors)>0) @foreach ($errors->all() as $error)
    <p class="red-text darken-3">{{$error}}</p>
    @endforeach @endif
</div>
<div class="user-signinform">
    <form class="user-customsearch" method="POST" action="/Dashboard/onboarding/{{auth()->user()->id}}">
        {{ csrf_field() }}

        <div class="user-customsearch__item"><input class="custom-input" type="password" name="password"
                class="validate" id="password" required placeholder="new password"></div>

        <div class="user-customsearch__item"><input class="custom-input" type="password" name="password_confirmation"
                class="validate" id="password_confirmation" placeholder="confirm password"></div>

        <div class="user-customsearch__item">
            <button class="user-custom-input" type="submit">change</button>
        </div>
    </form>
</div>
@endsection