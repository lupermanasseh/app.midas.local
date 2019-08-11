@extends('Layouts.user')
@section('admin')
<h3>SAVING SUMMARY</h3>
<p><a href="/Dashboard/user/savings">All Savings</a></p>
<table cl>
    <thead>
        <tr>
            <th>YEAR</th>
            <th>SAVING COUNT</th>
            <th>DETAIL</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($savingSummary as $year=>$savingList)
        <tr>
            <td>
                {{$year}}
            </td>
            <td>{{$savingList->count()}}</td>
            <td><a href="/Dashboard/savings/{{$year}}">History</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection