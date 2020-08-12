@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">LOAN REPAYMENT SCHEDULE</p>
        </div>
    </div>


    <div class="row">
        <section class="header-content">
            <div class="col s6 membership-details precision-left">
                <table>
                    <tr>
                        <th>NAME:</th>
                        <td>{{$loan->user->last_name}} {{$loan->user->first_name}}</td>
                    </tr>
                    <tr>
                        <th>REG.NO:</th>
                        <td>{{$loan->user->membership_type}}/{{$loan->user->id}}</td>
                    </tr>
                    <tr>
                        <th>LOAN TYPE:</th>
                        <td>{{$loan->product->name}}</td>
                    </tr>
                    <tr>
                        <th>INT. RATE (%):</th>
                        <td>{{$loan->product->interest*100}}%</td>
                    </tr>
                    <tr>
                        <th>INTEREST:</th>
                        <td>{{number_format($loan->product->interest*$loan->amount_approved,2,'.',',')}}</td>
                    </tr>
                </table>
            </div>

            <div class="col s6 membership-details precision-right">
                <table>
                    <tr>
                        <th>LOAN AMOUNT:</th>
                        <td>{{number_format($loan->amount_approved,2,'.',',')}}</td>
                    </tr>
                    <tr>
                        <th>TENOR:</th>
                        <td>{{$loan->custom_tenor}} MNTHS</td>
                    </tr>
                    <tr>
                        <th>MONTHLY REPAYMNT:</th>
                        <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
                    </tr>
                    <tr>
                        <th>START DATE:</th>
                        <td>{{$loan->loan_start_date->toFormattedDateString()}}</td>
                    </tr>
                    <tr>
                        <th>END DATE:</th>
                        <td>{{$loan->loan_end_date->toFormattedDateString()}}</td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
    <div class="row">
        <p>

            <a href="/loan/schedule/print/{{$loan->id}}" class=" btn pink darken-4" target="_blank"><i
                    class="fas fa-file-pdf"></i>
                Plain File</a> |
            <a href="/loan/schedule/printpdf/{{$loan->id}}" class=" btn pink darken-4" target="_blank"><i
                    class="fas fa-file-pdf"></i>
                PDF</a>
        </p>
    </div>


    <div class="row">
        <div class="col s12">
            <table class="highlight">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>DATE</th>
                        <th>PRINCIPAL</th>
                        <th>MONTHLY REPAYMENT</th>
                        <th>CUMM. PAYMENT</th>
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
                            {{-- <td>{{$loan->user->first_name}} {{$loan->user->last_name}}</td> --}}
                            {{-- <td>{{$loan->product->name}}</td> --}}
                            <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
                            <td>{{number_format($loan->monthly_deduction*$i,2,'.',',')}}</td>
                            <td>{{number_format($loan->amount_approved-$loan->monthly_deduction*$i,2,'.',',')}}
                            </td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection