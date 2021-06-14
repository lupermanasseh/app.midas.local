@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s3">
            <h5 class="teal-text">Add Staff User</h5>
        </div>

        <form class="col s12" method="POST" action="/add/user/store">
            {{ csrf_field() }}

            <div class="row">
                <div class="input-field col s6">
                    <input id="password" name="password" type="password" class="validate" required>
                    <label for="password">Password</label>
                </div>

                <div class="input-field col s6">
                    <input id="password_confirmation" name="password_confirmation" type="password" class="validate"
                        required>
                    <label for="password_confirmation">Confirm Password</label>
                </div>
            </div>


            <div class="row">
                <div class="input-field col s6">
                    <input id="email" name="email" type="email" class="validate" required>
                    <label for="email">Email</label>
                </div>
                @can('all')
                <div class="input-field col s6">
                    <select id="role" name="role">
                        @foreach ($roles as $id=>$role)
                        <option value="{{$id}}">{{$role}}</option>
                        @endforeach
                    </select>
                    <label>Role</label>
                </div>
                @endcan
            </div>
            <div class="row">

                <div class="input-field col s6">
                    <select id="sex" name="sex">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label>Gender</label>
                </div>
                <div class="input-field col s6">
                    <input id="phone" name="phone" type="text" class="validate" required>
                    <label for="phone">Phone</label>
                </div>
                {{-- <div class="input-field col s4">
                    <select id="marital_status" name="marital_status">
                        <option value="Married">Married</option>
                        <option value="Single">Single</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widow">Widow</option>
                        <option value="Widower">Widower</option>
                    </select>
                    <label>Marital Status</label>
                </div> --}}
            </div>

            <div class="row">


                <div class="input-field col s4">
                    <input id="sur_name" name="sur_name" type="text" class="validate" required>
                    <label for="sur_name">Surname</label>
                </div>

                <div class="input-field col s4">
                    <input id="first_name" name="first_name" type="text" class="validate" required>
                    <label for="first_name">Firstname</label>
                </div>
                <div class="input-field col s4">
                    <input id="other_name" name="other_name" type="text">
                    <label for="other_name">Othername</label>
                </div>

            </div>

            <button type="submit" class="btn">Create</button>
        </form>
    </div>
</div>
@endsection
