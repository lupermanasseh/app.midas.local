@extends('Layouts.user')
@section('admin')



<div>
    <p class="paragraph">SAVINGS</p>
    <table class="highlight">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>{{substr($user->membership_type,0,1)}}/{{$user->id}}</td>
                <td>
                    {{$user->first_name}} {{$user->last_name}}</td>
                <td>Savings (Contribution)</td>
                <td>{{$user->status}}</td>
                <td>
                    <a href="/Dashboard/user/savings">{{number_format($saving->netBalance($user->id),2,'.',',')}}</a>
                </td>
            </tr>
            @if(count($targetsr)>=1)
            @foreach ($targetsr as $tsr)
            <tr>
                <td>{{substr($user->membership_type,0,1)}}/{{$user->id}}</td>
                <td>
                    {{$user->first_name}} {{$user->last_name}}
                </td>
                <td>Target Saving (Bam)</td>
                <td>{{$user->status}}</td>
                <td><a
                        href="/Dashboard/targetsavings/{{$tsr->id}}">{{number_format($targetSaving->targetSavingBalance($tsr->id),2,'.',',')}}</a>
                </td>
            </tr>
            @endforeach
            @else
            @endif
        </tbody>
    </table>
</div>
<div>
    <p>LOANS</p>
    @if(count($activeLoans)>=1)
    <table class="">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
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
                <td>{{substr($user->membership_type,0,1)}}/{{$user->id}}</td>
                <td>
                    {{$user->first_name}} {{$user->last_name}}
                </td>
                <td>{{$myProduct->product->name}}</td>
                <td>{{$myProduct->loan_start_date->toDateString()}}</td>
                <td>{{$myProduct->loan_end_date->toDateString()}}</td>
                <td>{{$myProduct->custom_tenor}}</td>
                <td>{{number_format($myProduct->amount_approved,2,'.',',')}}</td>
                <td>{{number_format($myProduct->monthly_deduction,2,'.',',')}}</td>
                <td><a
                        href="/#/{{$myProduct->id}}">{{number_format($myProduct->amount_approved-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')}}</a>
                </td>
            </tr>
            @endforeach
            @else
            <p>No Active Loans available yet</p>
            @endif

            @if(count($activeLoans)>=1)
            <tr>
                <th colspan="6">Summary</th>
                <th>{{number_format($user->totalApprovedAmount(auth()->id()),2,'.',',')}}</th>
                <th>{{number_format($user->loanSubscriptionTotal(auth()->id()),2,'.',',')}}</th>
                <th>{{number_format($user->allLoanBalances(auth()->id()),2,'.',',')}}</th>
            </tr>
            @else
            @endif

        </tbody>
    </table>
</div>

@endsection