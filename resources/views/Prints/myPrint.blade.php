@extends('Layouts.print',['Saving'=>$Saving,'to'=>$to,'from'=>$from,'userObj'=>$userObj])
@section('print-area')
<table>
    <thead>
        <tr>
            <th style="text-align:right; margin-right:1em;">DATE</th>
            <th style="text-align:right; margin-right:1em;">DESCRIPTION</th>
            <th style="text-align:right; margin-right:1em;">DEBIT</th>
            <th style="text-align:right; margin-right:1em;">CREDIT</th>
            <th style="text-align:right; margin-right:1em;">BALANCE</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align:right; margin-right:1em;">{{$Saving->openingDate($from)}}</td>
            <td style="text-align:right; margin-right:1em;">Openning Balance</td>
            <td></td>
            <td></td>
            <td style="text-align:right; margin-right:1em;">
                {{number_format($Saving->openingBalance($from,$userObj->id),2,'.',',')}}</td>
        </tr>
        @foreach($statementCollection as $statement)
        <tr>
            <td style="text-align:right; margin-right:1em;">{{$statement->entry_date->toFormattedDateString()}}</td>
            <td style="text-align:right; margin-right:1em;">
                {{$statement->notes}}
            </td>
            <td style="text-align:right; margin-right:1em;">{{number_format($statement->amount_withdrawn),2,'.',','}}
            </td>
            <td style="text-align:right; margin-right:1em;">{{number_format($statement->amount_saved,2,'.',',')}}
            </td>
            {{-- <td style="text-align:right; margin-right:1em;">
                {{number_format($Saving->balanceAsAt($statement->amount_saved,$statement->amount_withdrawn,$statement->id,$userObj->id),2,'.',',')}}
            </td> --}}
            <td style="text-align:right; margin-right:1em;">
                {{number_format($statement->balances,2,'.',',')}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection