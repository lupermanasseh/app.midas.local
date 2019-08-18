@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row subject-header">
        <div class="col s6">
            <span class="text-teal">SEARCH RESULT</span>
        </div>
        <div class="col s6">
            <span><a href="/user/all"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Users">group</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($users)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Surname</th>
                        <th>Last Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td><a href="/userDetails/{{$user->id}}">{{$user->first_name}}</a></td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->status}}</td>
                        <td><a href="/saving/new/{{$user->id}}" class="btn blue darken-3">Add Saving</a> <a
                                href="/targetsaving/new/{{$user->id}}" class="btn purple darken-3">Add
                                TS</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No record found matching your search criteria</p>
            @endif
        </div>
    </div>

</div>
@endsection