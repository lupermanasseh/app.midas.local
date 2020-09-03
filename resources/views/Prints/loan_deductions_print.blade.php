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
            <td>@if($loan->disbursement_date)
            {{$loan->disbursement_date->toFormattedDateString()}}
            @else
            NOT AVAILABLE
            @endif</td>
            <td>Normal Loan Disbursement</td>
            <td style="text-align:right; margin-right:1em;">{{number_format($loan->amount_approved,2,'.',',')}}</td>
            <td>-</td>
            <td style="text-align:right; margin-right:1em;">{{number_format($loan->amount_approved,2,'.',',')}}
            </td>
        </tr>
        @if (count($loanHistory)>=1)
        @foreach($loanHistory as $myItem)
        <tr>
            {{-- <td>{{$i}}</td> --}}
            <td>{{$myItem->entry_month->toFormattedDateString()}}</td>
            <td>{{$myItem->notes}}</td>
            {{-- <td><a href="/user/page/{{$myItem->user_id}}">{{$myItem->user->first_name}}</a></td> --}}
            <td style="text-align:right; margin-right:1em;">
              @if($myItem->amount_debited)
              {{number_format($myItem->amount_debited,2,'.',',')}}
              @else
              -
              @endif</td>
            <td style="text-align:right; margin-right:1em;">
            @if($myItem->amount_deducted)
            {{number_format($myItem->amount_deducted,2,'.',',')}}
            @else
            -
            @endif</td>
            <td style="text-align:right; margin-right:1em;">{{number_format($loan->amount_approved-$myItem->balances,2,'.',',')}}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <th colspan="5">No deduction(s) for this facility yet</th>
        </tr>
        @endif
    </tbody>
</table>

@endsection
