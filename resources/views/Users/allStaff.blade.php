@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row subject-header">
        <div class="col s6">
            <span class="text-teal">ALL USERS</span>
        </div>
        <div class="col s6">
            <span><a href="/New"><i class="small material-icons">person_add</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($users)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allStaff as $staff)
                    <tr>
                        <td>{{$staff->first_name}} {{$staff->first_name}}</td>
                        <td>{{$staff->roles()->name}}</td>
                        <td>{{$staff->status}}</td>
                        <td>Action</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$users->links()}} @else
            <p>No Users Created Yet</p>
            @endif
        </div>
    </div>

</div>
@endsection