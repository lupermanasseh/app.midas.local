@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">EDIT PROFILE DETAILS</p>
            <span><a href="/userDetails/{{$user->id}}"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Back To User Deatils">arrow_back</i></a></span>
            <span><a href="/user/all"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Users">group</i></a></span>
        </div>
    </div>
    <div class="row">

        <form class="col s12" method="POST" action="/updateProfile/{{$user->id}}">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s6">
                    <input id="staff_no" name="staff_no" value="{{$user->staff_no}}" type="text" class="validate"
                        required>
                    <label for="staff_no">ID Card Number</label>
                </div>

                <div class="input-field col s6">
                    <input id="payment_number" name="payment_number" value="{{$user->payment_number}}" type="text"
                        class="validate" required>
                    <label for="payment_number">IPPIS Number</label>
                </div>

            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="email" name="email" type="email" value="{{$user->email}}" class="validate" required>
                    <label for="email">Email</label>
                </div>
                @can('all')
                <div class="input-field col s6">
                    <select id="role" name="role">
                        <option value="" selected disabled>Cooperator</option>
                        @foreach ($roles as $id=>$role)
                        <option value="{{$id}}">{{$role}}</option>
                        @endforeach
                    </select>
                    <label>System Role</label>
                </div>
                @endcan
            </div>
            <div class="row">
                <div class="input-field col s4">
                    <select id="title" name="title">
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Miss">Miss</option>
                        <option value="Dr">Dr</option>
                    </select>
                    <label>Title</label>
                </div>

                <div class="input-field col s4">
                    <select id="sex" name="sex">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label>Gender</label>
                </div>
                <div class="input-field col s4">
                    <select id="marital_status" name="marital_status">
                        <option value="Married">Married</option>
                        <option value="Single">Single</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widow">Widow</option>
                        <option value="Widower">Widower</option>
                    </select>
                    <label>Marital Status</label>
                </div>
            </div>

            <div class="row">


                <div class="input-field col s4">
                    <input id="first_name" name="first_name" value="{{$user->first_name}}" type="text" class="validate"
                        required>
                    <label for="first_name">Surname</label>
                </div>

                <div class="input-field col s4">
                    <input id="last_name" name="last_name" value="{{$user->last_name}}" type="text" class="validate"
                        required>
                    <label for="last_name">Last name</label>
                </div>
                <div class="input-field col s4">
                    <input id="other_name" name="other_name" value="{{$user->other_name}}" type="text">
                    <label for="other_name">Other name</label>
                </div>

            </div>
            <div class="row">
                <div class="input-field col s4">
                    <select id="member_type" name="member_type">
                        <option value="Ordinary">Ordinary</option>
                        <option value="Associate">Associate</option>
                    </select>
                    <label>Membership Type</label>
                </div>
                <div class="input-field col s4">
                    <select id="employ_type" name="employ_type">
                        <option value="Permanent">Permanent</option>
                        <option value="Temporal">Temporal</option>
                        <option value="Temporal">MIDAS Permanent</option>
                    </select>
                    <label>Employment Type</label>
                </div>
                <div class="input-field col s4">
                    <select id="job_cadre" name="job_cadre">
                        <option value="Senior">Senior</option>
                        <option value="Junior">Junior</option>
                    </select>
                    <label>Job Cadre</label>
                </div>

            </div>

            <div class="row">

                <div class="input-field col s4">
                    <input id="dept" name="dept" value="{{$user->dept}}" type="text" class="validate" required>
                    <label for="dept">Dept</label>
                </div>

                <div class="input-field col s4">
                    <input id="phone" name="phone" value="{{$user->phone}}" type="text" class="validate" required>
                    <label for="phone">Phone</label>
                </div>
                <div class="input-field col s4">
                    <input id="dob" name="dob" value="{{$user->dob}}" type="date" class="validate" required>
                    <label for="dob">DOB</label>
                </div>

            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="home_add" name="home_add" value="{{$user->home_add}}" type="text" class="validate"
                        required>
                    <label for="home_add">Home Address</label>
                </div>
                <div class="input-field col s6">
                    <input id="res_add" name="res_add" value="{{$user->res_add}}" type="text" class="validate" required>
                    <label for="res_add">Residential Address</label>
                </div>
            </div>

            <button type="submit" class="btn">Update Profile</button>
        </form>
    </div>
</div>
@endsection