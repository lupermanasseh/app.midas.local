@extends('Layouts.user')
@section('admin')
<h3>Filtered Loan Deductions</h3>
@if (count($records)>=1)
<table>
    <thead>
        <tr>
            <th>NAME</th>
            <th>AMOUNT</th>
            <th>MODE</th>
            <th>DATE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $list)
        <tr>
            <td>
                {{$list->user->first_name}} {{$list->user->last_name}}
            </td>
            <td>{{number_format($list->amount_deducted,2,'.',',')}}</td>
            <td>
                {{$list->repayment_mode}}
            </td>
            <td>{{$list->entry_month->toFormattedDateString()}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No records found yet</p>
@endif
@endsection