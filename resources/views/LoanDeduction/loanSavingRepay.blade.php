@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">LOAN REPAYMENT:: SAVING</h6>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/user/page/{{$subscription->user->id}}"><i class="small material-icons tooltipped"
                        data-position="bottom" data-tooltip="Go Back">arrow_back</i></a></span>

        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/saving/repay">
            {{ csrf_field() }}

            <div class="row">
                <div class="input-field col s12 m4 l4">
                    <input id="sub_id" name="sub_id" value="{{$subscription->id}}" type="hidden">
                    <input id="user_id" name="user_id" value="{{$subscription->user_id}}" type="hidden">
                    <input id="amount" name="amount" type="text" class="validate">
                    <label for="amount">Enter Amount</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="entry_date" name="entry_date" type="text" class="validate datepicker">
                    <label for="entry_date">Date</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="notes" name="notes" type="text" class="validate">
                    <label for="notes">Notes</label>
                </div>

            </div>

            <button type="submit" class="btn">Repay Loan</button>
        </form>
    </div>
</div>
@endsection