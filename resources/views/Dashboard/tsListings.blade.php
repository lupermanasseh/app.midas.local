@extends('Layouts.user')
@section('admin')
<h3>TARGET SAVING LISTINGS</h3>
<table cl>
    <thead>
        <tr>
            <th>DATE</th>
            <th>NAME</th>
            <th>CREDIT</th>
            <th>DEBIT</th>
            <th>DESC</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($targetSavingList as $list)
        <tr>
            <td>{{$list->entry_date->toFormattedDateString()}}</td>
            <td>
                {{$list->user->first_name}} {{$list->user->last_name}}
            </td>
            <td>{{number_format($list->amount,2,'.',',')}}</td>
            <td>{{number_format($list->withdrawal,2,'.',',')}}</td>
            <td>
                {{$list->notes}}
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection