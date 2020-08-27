@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 m6 l6 subject-header">
            <p class="teal-text">USER LOAN(S)</p>
        </div>
        <div class="col s12 m6 l6 subject-header right">
            <a href="/user/landingPage/{{$id}}"><i class="tiny material-icons">arrow_back</i> RETURN</a>
        </div>
    </div>


    <div class="row user-profiles">
        <div class="col s12 m12 l12  profile-detail">
            <p class="profile__heading text-grey darken-3">
                {{$allLoans->count()}} Loan(s) Available | <span></p>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Prin.</th>
                        <th>Paid</th>
                        <th>Bal</th>
                        <th>Due</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allLoans as $loan)
                    <tr>
                        <td>
                            {{$loan->product->name}}
                        </td>
                        <td>
                            {{number_format($loan->amount_approved,2,'.',',')}}
                        </td>
                        <td><a
                                href="/loanDeduction/history/{{$loan->id}}">{{number_format($loan->totalLoanDeductions($loan->id),2,'.',',')}}</a>
                        </td>
                        <td>{{number_format($loan->amount_approved-$loan->totalLoanDeductions($loan->id),2,'.',',')}}
                        </td>
                        <td>{{$loan->loan_end_date->toFormattedDateString()}}
                        </td>
                        <td>
                            <a href="/loanSub/stop/{{$loan->id}}" class="btn red">Stop</a>
                            <a href="/loan/payment/{{$loan->id}}" class="btn">Repay</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
