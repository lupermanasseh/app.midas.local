@extends('Layouts.admin-app')


@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">LOAN HISTORY/DETAILS</p>
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

    @if (count($loanHistory)>=1)
    <div class="row">
        <p>

            <a href="/loan/deductions/print/{{$loan->id}}" class=" btn pink darken-4" target="_blank"><i
                    class="fas fa-file"></i>
                Plain File</a> |
            <a href="/loan/deductions/printpdf/{{$loan->id}}" class=" btn pink darken-4" target="_blank"><i
                    class="fas fa-file-pdf"></i>
                PDF</a>
        </p>
    </div>
    @endif
    <div class="row">
        <div class="col s12">
            @if (count($loanHistory)>=1)
            <table class="highlight">
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
                        <td>{{$loan->loan_start_date->toFormattedDateString()}}</td>
                        <td>Normal Loan Disbursement</td>
                        <td>{{number_format($loan->amount_approved,2,'.',',')}}</td>
                        <td>-</td>
                        <td>{{number_format($loan->amount_approved,2,'.',',')}}
                        </td>
                    </tr>
                    @foreach ($loanHistory as $myItem)
                    <tr>

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
            @else
            <p>No deduction(s) for this facility yet</p>
            @endif
        </div>
    </div>
</div>
@endsection
