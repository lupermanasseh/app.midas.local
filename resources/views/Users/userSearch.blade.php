@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row subject-header">
        <div class="col s6">
            <span class="text-teal">SEARCH RESULT</span>
        </div>
        <div class="col s6">
            <span><a href="/user/all"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Users">group</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s6">
            <a href="/saving/new/{{$user->id}}" class="btn blue darken-3">Add Saving</a>
        </div>
        <div class="col s6">
            <a href="/targetsaving/new/{{$user->id}}" class="btn purple darken-3">Add
                TS</a>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <h6>SAVINGS</h6>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            {{-- @if (count($users)>=1) --}}
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
                            <a href="/userDetails/{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a></td>
                        <td>Savings (Contribution)</td>
                        <td>{{$user->status}}</td>
                        <td>
                            <a
                                href="/saving/listings/{{$user->id}}">{{number_format($saving->mySavings($user->id),2,'.',',')}}</a>
                        </td>
                    </tr>
                    @if(count($targetsr)>=1)
                    @foreach ($targetsr as $tsr)
                    <tr>
                        <td>{{substr($user->membership_type,0,1)}}/{{$user->id}}</td>
                        <td>
                            <a href="/userDetails/{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a>
                        </td>
                        <td>Target Saving (Bam)</td>
                        <td>{{$user->status}}</td>
                        <td><a
                                href="/tsSub/detail/{{$tsr->id}}">{{number_format($targetSaving->targetSavingBalance($tsr->id),2,'.',',')}}</a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        @if(count($activeLoans)>=1)
        <div class="col s12">
            <h6>ACTIVE LOANS | <span> <a href="/user/page/{{$user->id}}" class="btn green darken-3">GOT TO
                        PRODUCT(s)</a></span></h6>

        </div>
        @else
        @endif
    </div>
    <div class="row">
        <div class="col s12">

            <table class="">
                @if(count($activeLoans)>=1)
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
                        <th>Schedule</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($activeLoans as $myProduct)
                    <tr>
                        <td>{{substr($user->membership_type,0,1)}}/{{$user->id}}</td>
                        <td>
                            <a href="/userDetails/{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a>
                        </td>
                        <td>{{$myProduct->product->name}}</td>
                        <td>{{$myProduct->loan_start_date->toDateString()}}</td>
                        <td>{{$myProduct->loan_end_date->toDateString()}}</td>
                        <td>{{$myProduct->custom_tenor}}</td>
                        <td>{{number_format($myProduct->amount_approved,2,'.',',')}}</td>
                        <td>{{number_format($myProduct->monthly_deduction,2,'.',',')}}</td>
                        <td><a
                                href="/loanDeduction/history/{{$myProduct->id}}">{{number_format($myProduct->amount_approved-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')}}</a>
                        </td>
                        <td><a href="/loan/schedule/{{$myProduct->id}}" target="_blank">Get</a></td>
                    </tr>
                    @endforeach
                    @else
                    @endif

                    @if(count($activeLoans)>=1)
                    <tr>
                        <th colspan="6">Summary</th>
                        <th>{{number_format($user->totalApprovedAmount($user->id),2,'.',',')}}</th>
                        <th>{{number_format($user->loanSubscriptionTotal($user->id),2,'.',',')}}</th>
                        <th>{{number_format($user->allLoanBalances($user->id),2,'.',',')}}</th>
                    </tr>
                    @else
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection