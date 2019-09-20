@extends('Layouts.loanschedule',['userObj'=>$userObj])
@section('print-area')
<table>
    <thead>
        <tr>
            <th>S/N</th>
            <th>DATE</th>
            <th>NAME</th>
            <th>PRODUCT</th>
            <th>REPYMT</th>
            <th>AMNT</th>
            <th>BAL</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{1}}</td>
            <td>{{$loan->loan_start_date->toFormattedDateString()}}</td>
            <td>{{$loan->user->first_name}} {{$loan->user->last_name}}</td>
            <td>{{$loan->product->name}}</td>
            <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
            <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
            <td>{{number_format($loan->amount_approved - $loan->monthly_deduction,2,'.',',')}}
            </td>
        </tr>
        @for($i=2; $i<=$loan->custom_tenor; $i++)
            <tr>
                <td>{{$i}}</td>
                <td>{{$loan->loan_start_date->addMonths($i-1)->toFormattedDateString()}}
                </td>
                <td>{{$loan->user->first_name}} {{$loan->user->last_name}}</td>
                <td>{{$loan->product->name}}</td>
                <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
                <td>{{number_format($loan->monthly_deduction*$i,2,'.',',')}}</td>
                <td>{{number_format($loan->amount_approved-$loan->monthly_deduction*$i,2,'.',',')}}
                </td>
            </tr>
            @endfor
    </tbody>
</table>

@endsection