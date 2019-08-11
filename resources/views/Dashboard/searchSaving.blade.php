@extends('Layouts.user')
@section('admin')
<h3>Filtered Savings</h3>
@if (count($records)>=1)
<span><a href="/Dashboard/print/{{$fromDate}}/{{$toDate}}" target="_blank">Print</a></span> | <span><a
        href="/Dashboard/downloadpdf/{{$fromDate}}/{{$toDate}}" target="_blank">Download PDF</a></span>
<table>
    <thead>
        <tr>
            <th>DATE</th>
            <th>DESCRIPTION</th>
            <th>DEBIT</th>
            <th>CREDIT</th>
            <th>BALANCE</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$saving->openingDate($fromDate)}}</td>
            <td>Opening Balance</td>
            <td></td>
            <td></td>
            <td>{{number_format($saving->openingBalance($fromDate,$userObj->id),2,'.',',')}}</td>
        </tr>
        @foreach ($records as $list)
        <tr>
            <td>{{$list->entry_date->toFormattedDateString()}}</td>
            <td>{{$list->notes}}</td>
            <td>{{number_format($list->amount_withdrawn,2,'.',',')}}</td>
            <td>{{number_format($list->amount_saved,2,'.',',')}}</td>

            <td>{{number_format($saving->balanceAsAt($list->amount_saved,$list->amount_withdrawn,$list->id,$userObj->id))}}
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@else
<p>No records found yet</p>
@endif
@endsection