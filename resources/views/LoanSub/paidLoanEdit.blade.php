@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">EDIT EXISTING LOAN</span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m12 l12 subject-header right">
          <a class="btn" href="/user/landingPage/{{$lSub->user_id}}"><i class="tiny material-icons">arrow_back</i>Back</a>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/paidloan/update/{{$lSub->id}}">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12 m4 l4">
                    <input placeholder="loan_amount" id="loan_amount" value="{{$lSub->amount_approved}}" name="loan_amount" type="text"
                        class="validate">
                    <label for="loan_amount">Loan Amount</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input placeholder="tenor" id="tenor" name="tenor" value="{{$lSub->custom_tenor}}"
                        type="text" class="validate">
                    <label for="tenor">Tenor</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input placeholder="deduction" id="deduction" name="deduction" value="{{$lSub->monthly_deduction}}"
                        type="text" class="validate">
                    <label for="deduction">Monthly Deduction</label>
                </div>
            </div>

            <div class="row">

                <!-- <div class="input-field col s12 m2 l2">
                    <input id="units" name="units" value="{{$lSub->units}}" type="number" class="validate">
                    <label for="units">Units</label>
                    <span>Hint: {{$lSub->units}}</span>
                </div> -->
                <div class="input-field col s12 m4 l4">
                    <input id="start_date" name="start_date" value="{{$lSub->loan_start_date}}" type="text" class="validate datepicker">
                    <label for="start_date">Loan Start Date</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="end_date" name="end_date" value="{{$lSub->loan_end_date}}" type="text" class="validate datepicker">
                    <label for="end_date">Loan End Date</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="disbursement_date" name="disbursement_date" value="{{$lSub->disbursement_date}}" type="text" class="validate datepicker">
                    <label for="disbursement_date">Disbursement Date</label>
                </div>

            </div>

            <!-- <div class="row">
                <div class="input-field col s12 m3 l3">
                    <input id="amount_applied" name="amount_applied" value="{{$lSub->amount_applied}}" type="text"
                        class="validate">
                    <label for="amount_applied">Amount Applied</label>
                </div>
                <div class="input-field col s12 m3 l3">
                    <input id="net_pay" name="net_pay" type="text" value="{{$lSub->net_pay}}" class="validate">
                    <label for="net_pay">Net Pay</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="custom_tenor" name="custom_tenor" type="text" value="{{$lSub->custom_tenor}}"
                        placeholder="Eg 3 or 5 (values in months Optional)">
                    <label for="custom_tenor">Custom Tenor</label>
                </div>
            </div> -->

            <button type="submit" class="btn">Save</button>
        </form>
    </div>
</div>
@endsection
