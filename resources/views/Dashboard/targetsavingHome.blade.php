@extends('Layouts.user')
@section('admin')
<h3>TARGET SAVING</h3>
<p><a href="/Dashboard/user/allTargetsavings">All Target Savings</a></p>
<table cl>
    <thead>
        <tr>
            <th>Name</th>
            <th>Start Date</th>
            <th>Status</th>
            <th>History</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($targetSaving as $active)
        <tr>
            <td>
                {{$active->user->first_name}} {{$active->user->last_name}}
            </td>
            <td>{{$active->start_date}}</td>
            <td>
                {{$active->status}}
            </td>
            <td><a href="/Dashboard/targetsavings/{{$active->id}}">History</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection