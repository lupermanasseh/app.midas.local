@extends('Layouts.userSigninLayout')
@section('user-signin')
<div></div>
<div class="user-signinlogocontainer">
    <img src="{{asset('images/logo.png')}}" alt="" class="logo-usersignin">
</div>
<div class="user-signinlogocontainer">
    @if(count($errors)>0) @foreach ($errors->all() as $error)
    <p class="red-text darken-3">{{$error}}</p>
    @endforeach @endif
</div>
<div class="user-signinform">
    <form class="user-customsearch" method="POST" action="/member/access">
        {{ csrf_field() }}

        <div class="user-customsearch__item"><input class="custom-input" type="text" name="email" id="email"
                placeholder="E Mail"></div>

        <div class="user-customsearch__item"><input class="custom-input" type="password" name="password" id="password"
                placeholder="Password"></div>

        <div class="user-customsearch__item">
            <button class="user-custom-input" type="submit">Login</button>
        </div>
    </form>
</div>
@endsection