@extends('Layouts.consolidatedloandeductions')
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

        @if (count($consolidatedLoans)>=1)
        @foreach($consolidatedLoans as $myItem)
        <tr>
            {{-- <td>{{$i}}</td> --}}
            <td>{{$myItem->date_entry->toFormattedDateString()}}</td>
            <td>{{$myItem->description}}</td>
            <td style="text-align:right; margin-right:1em;">
              @if($myItem->debit)
              {{number_format($myItem->debit,2,'.',',')}}
              @else

              @endif</td>
            <td style="text-align:right; margin-right:1em;">
            @if($myItem->credit)
            {{number_format($myItem->credit,2,'.',',')}}
            @else

            @endif</td>
            <td style="text-align:right; margin-right:1em;">{{number_format($myItem->balance,2,'.',',')}}</td>
        </tr>
        @endforeach


        <tr>
            <th colspan="2">Summary</th>
            <th style="text-align:right; margin-right:1em;">{{number_format($user->consolidatedLoanDebitTotal($user->id),2,'.',',')}}</th>
            <th style="text-align:right; margin-right:1em;">{{number_format($user->consolidatedLoanCreditTotal($user->id),2,'.',',')}}</th>
            <th style="text-align:right; margin-right:1em;">{{number_format($user->consolidatedLoanBalance($user->id),2,'.',',')}}</th>
        </tr>


        @else
        <tr>
            <th colspan="5">No record(s) yet</th>
        </tr>
        @endif
    </tbody>
</table>

@endsection
