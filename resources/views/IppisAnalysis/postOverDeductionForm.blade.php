@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">POST LOAN OVER DEDUCTION</span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/loan/overdeduction"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Loan Overdeduction List">view_list</i></a></span>
        </div>
    </div>

    <div class="row user-profiles">
        <div class="col s12 m12 l12 profile">
            <p class="profile__heading text-grey darken-3">PROFILE</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name">{{$user->payment_number}}</span>
            <span class="profile__user-name">{{$user->first_name}} {{$user->last_name}}</span>
            <span class="profile__user-name">TOTAL CONTR
                <a
                    href="/saving/listings/{{$user->id}}">{{number_format($user->totalSavings($user->id),2,'.',',')}}</a></span>
            <span class="profile__user-name">MNTH SAVE
                {{number_format($user->monthlySaving($user->id),2,'.',',')}}</span>
        </div>
    </div>


    <div class="row">
        <form class="col s12" method="POST" action="/loanoverdeduction/store">
            {{ csrf_field() }}

            <div class="row">

                <div class="input-field col s12 m4 l4">
                    <input id="user_id" name="user_id" type="hidden" value="{{$user->id}}" class="validate">
                    <input id="overdeduct_id" name="overdeduct_id" type="hidden" value="{{$overdeductionObj->id}}" class="validate">
                    <input id="amount" name="amount" value="{{$overdeductionObj->overdeduction_amount}}" type="number" step=".01"
                        class="validate" disabled>
                    <label for="amount">Amount</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="_date" name="_date" value="{{$overdeductionObj->entry_date->toFormattedDateString()}}" type="text" class="validate datepicker" required disabled>
                    <label for="start_date">Date</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <select id="loan_id" name="loan_id">
                        @foreach ($userActiveLoans as $myProduct)
                        <option value="{{$myProduct->id}}">{{$myProduct->product->name}}/[{{number_format($myProduct->user->singleLoanBalance($myProduct->id),2,'.',',')}}]</option>
                        @endforeach
                    </select>
                    <label>Active Loan(s)</label>
                </div>
            </div>

            <button type="submit" class="btn">Save</button>
        </form>
    </div>
</div>
@endsection
