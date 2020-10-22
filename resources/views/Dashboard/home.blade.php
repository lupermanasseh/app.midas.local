@extends('Layouts.user')
@section('admin')
<div>

    @if(count($activeLoans)>=1)
    <p>LOANS</p>
    <table class="">
        <thead>
            <tr>
                <!-- <th>#</th>
                <th>Name</th> -->
                <th>Loan Type</th>
                <th>S/Date</th>
                <th>E/Date</th>
                <th>Tenor</th>
                <th>Amt</th>
                <th>Repymt</th>
                <th>Bal</th>
            </tr>
        </thead>
        <tbody>



            @foreach ($activeLoans as $myProduct)
            <tr>
                <!-- <td>{{substr($user->membership_type,0,1)}}/{{$user->id}}</td>
                <td>
                    {{$user->first_name}} {{$user->last_name}}
                </td> -->
                <td>{{$myProduct->product->name}}</td>
                <td>{{$myProduct->loan_start_date->toDateString()}}</td>
                <td>{{$myProduct->loan_end_date->toDateString()}}</td>
                <td>{{$myProduct->custom_tenor}}</td>
                <td>{{number_format($myProduct->amount_approved+$myProduct->topup_amount,2,'.',',')}}</td>
                <td>{{number_format($myProduct->monthly_deduction,2,'.',',')}}</td>
                <td><a
                        href="/user/loans/{{$myProduct->id}}">{{number_format($myProduct->amount_approved+$myProduct->topup_amount-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')}}</a>
                </td>
            </tr>
            @endforeach
            @else
            <p>No Active Loans available yet</p>
            @endif

            @if(count($activeLoans)>=1)
            <tr>
                <th colspan="4">Summary</th>
                <th>{{number_format($user->totalApprovedAmount(auth()->id()),2,'.',',')}}</th>
                <th>{{number_format($user->loanSubscriptionTotal(auth()->id()),2,'.',',')}}</th>
                <th>{{number_format($user->allLoanBalances(auth()->id()),2,'.',',')}}</th>
            </tr>
            @else
            @endif

        </tbody>
    </table>

    @if(count($inactiveLoans)>=1)
    <p>INACTIVE LOANS</p>
    <table class="">
        <thead>
            <tr>
                <!-- <th>#</th>
                <th>Name</th> -->
                <th>Loan Type</th>
                <th>S/Date</th>
                <th>E/Date</th>
                <th>Tenor</th>
                <th>Amt</th>
                <th>Repymt</th>
                <th>Bal</th>
            </tr>
        </thead>
        <tbody>



            @foreach ($inactiveLoans as $inactive)
            <tr>
                <!-- <td>{{substr($user->membership_type,0,1)}}/{{$user->id}}</td>
                <td>
                    {{$user->first_name}} {{$user->last_name}}
                </td> -->
                <td>{{$inactive->product->name}}</td>
                <td>{{$inactive->loan_start_date->toDateString()}}</td>
                <td>{{$inactive->loan_end_date->toDateString()}}</td>
                <td>{{$inactive->custom_tenor}}</td>
                <td>{{number_format($inactive->amount_approved+$inactive->topup_amount,2,'.',',')}}</td>
                <td>{{number_format($inactive->monthly_deduction,2,'.',',')}}</td>
                <td><a
                        href="/user/loans/{{$inactive->id}}">{{number_format($inactive->amount_approved+$inactive->topup_amount-$inactive->totalLoanDeductions($inactive->id),2,'.',',')}}</a>
                </td>
            </tr>
            @endforeach
            @else
            <p>No Inactive Loans available yet</p>
            @endif

        </tbody>
    </table>
</div>

@endsection
