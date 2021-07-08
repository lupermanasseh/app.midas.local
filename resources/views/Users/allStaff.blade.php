@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12">
            <span class="teal-text">ALL USERS</span>
        </div>

    </div>

    <div class="row">

        <div class="col s12">
            <span><a href="/New" class="btn blue">New Staff</a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($allStaff)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allStaff as $staff)
                    <tr>
                        <td>{{$staff->last_name}} {{$staff->first_name}} </td>
                        @foreach ($staff->roles as $role)
                        <td>{{$role->name}}</td>
                        @endforeach
                        <td>{{$staff->email}}</td>
                        <td>{{$staff->status}}</td>
                        <td><a href="" class="btn">Deactivate</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No Users Created Yet</p>
            @endif
        </div>
    </div>

</div>
@endsection
