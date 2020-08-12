@extends('Layouts.loanschedule',['userObj'=>$userObj])
@section('print-area')
<table>
    <thead>
        <tr>
            <th>S/N</th>
            <th>DATE</th>
            <th>PRINCIPAL</th>
            <th>MONTHLY REPAYMNT</th>
            <th>CUMM. REPAYMNT</th>
            <th>BAL</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{1}}</td>
            <td>{{$loan->loan_start_date->endOfMonth()->toFormattedDateString()}}</td>
            <td>{{number_format($loan->amount_approved,2,'.',',')}}</td>
            <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
            <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
            <td>{{number_format($loan->amount_approved - $loan->monthly_deduction,2,'.',',')}}
            </td>
        </tr>
        @for($i=2; $i<=$loan->custom_tenor; $i++)
            <tr>
                <td>{{$i}}</td>
                <td>{{$loan->loan_start_date->addMonths($i-1)->endOfMonth()->toFormattedDateString()}}
                </td>
                <td>{{number_format($loan->amount_approved,2,'.',',')}}</td>
                <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
                <td>{{number_format($loan->monthly_deduction*$i,2,'.',',')}}</td>
                <td>{{number_format($loan->amount_approved-$loan->monthly_deduction*$i,2,'.',',')}}
                </td>
            </tr>
            @endfor
    </tbody>
</table>

@endsection