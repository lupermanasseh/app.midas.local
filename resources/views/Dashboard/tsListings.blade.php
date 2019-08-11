@extends('Layouts.user')
@section('admin')
<h3>TARGET SAVING LISTINGS</h3>
<table cl>
    <thead>
        <tr>
            <th>NAME</th>
            <th>AMOUNT</th>
            <th>MODE</th>
            <th>DATE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($targetSavingList as $list)
        <tr>
            <td>
                {{$list->user->first_name}} {{$list->user->last_name}}
            </td>
            <td>{{number_format($list->amount,2,'.',',')}}</td>
            <td>
                {{$list->target_saving_mode}}
            </td>
            <td>{{$list->entry_date->toFormattedDateString()}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection