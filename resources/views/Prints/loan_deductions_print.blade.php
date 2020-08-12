@extends('Layouts.loandeductions')
@section('print-area')
<table>
    <thead>
        <tr>
            {{-- <th>S/N</th> --}}
            <th>DATE</th>
            <th>DESCRIPTION</th>
            <th>DEBIT</th>
            <th>CREDIT</th>
            <th>BAL</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            {{-- <td>{{1}}</td> --}}
            <td>{{$loan->loan_start_date->toFormattedDateString()}}</td>
            <td>Normal Loan Disbursement</td>
            <td>{{number_format($loan->amount_approved,2,'.',',')}}</td>
            <td>-</td>
            <td>{{number_format($loan->amount_approved,2,'.',',')}}
            </td>
        </tr>
        @foreach($loanHistory as $myItem)
        <tr>
            {{-- <td>{{$i}}</td> --}}
            <td>{{$myItem->entry_month->toFormattedDateString()}}</td>
            <td>{{$myItem->notes}}</td>
            {{-- <td><a href="/user/page/{{$myItem->user_id}}">{{$myItem->user->first_name}}</a></td> --}}
            <td>-</td>
            <td>{{number_format($myItem->amount_deducted,2,'.',',')}}</td>
            <td>{{number_format($loan->amount_approved-$myItem->balances,2,'.',',')}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection