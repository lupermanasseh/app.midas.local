@extends('Layouts.print',['Saving'=>$Saving,'to'=>$to,'from'=>$from,'userObj'=>$userObj])
@section('print-area')
<table>
    <thead>
        <tr>
            <th>DATE</th>
            <th>DESCRIPTION</th>
            <th>DEBIT (=N=)</th>
            <th>CREDIT (=N=)</th>
            <th>BALANCE (=N=)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$Saving->openingDate($from)}}</td>
            <td>Openning Balance</td>
            <td></td>
            <td></td>
            <td>{{number_format($Saving->openingBalance($from,$userObj->id),2,'.',',')}}</td>
        </tr>
        @foreach($statementCollection as $statement)
        <tr>
            <td>{{$statement->entry_date->toFormattedDateString()}}</td>
            <td>
                {{$statement->notes}}
            </td>
            <td>{{number_format($statement->amount_withdrawn),2,'.',','}}</td>
            <td>{{number_format($statement->amount_saved,2,'.',',')}}
            </td>
            <td>{{number_format($Saving->balanceAsAt($statement->amount_saved,$statement->amount_withdrawn,$statement->id,$userObj->id),2,'.',',')}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection