@extends('Layouts.admin-app') 
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h5 class="teal-text">PRODUCT REPAYMENT</h5>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/prodSub/active"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Go Back">arrow_back</i></a></span>

        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/productRepay/store">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <input disabled id="payment_id" name="payment_id" value="{{$subscription->user->payment_number}}" type="text" class="validate">
                    <label for="payment_id">Payment ID</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="user_id" name="user_id" value="{{$subscription->user->id}}" type="hidden">
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="sub_id" name="sub_id" value="{{$subscription->id}}" type="hidden">
                </div>
            </div>
            <div class="row">

                <div class="input-field col s12 m6 l6">
                    <select id="product" name="product">
                        <option value="{{$subscription->product->id}}">{{$subscription->product->name}}</option>
                    </select>
                    <label>Product List</label>
                </div>

                <div class="input-field col s12 m6 l6">

                    <input id="amount" name="amount" type="text" class="validate">
                    <label for="amount">Enter Amount</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m3 l3">
                    <input id="bank_name" name="bank_name" type="text" class="validate">
                    <label for="bank_name">Bank Name</label>
                </div>
                <div class="input-field col s12 m3 l3">
                    <input id="bank_add" name="bank_add" type="text" class="validate">
                    <label for="bank_add">Bank Add</label>
                </div>
                <div class="input-field col s12 m3 l3">
                    <input id="depositor_name" name="depositor_name" type="text" class="validate">
                    <label for="depositor_name">Depositor Name</label>
                </div>
                <div class="input-field col s12 m3 l3">
                    <input id="teller_number" name="teller_number" type="text" class="validate">
                    <label for="teller_number">Teller Number</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m4 l4">
                    <select id="mode" name="mode">
                            <option value="Bank">Bank</option>
                    </select>
                    <label>Payment Mode</label>
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
            <button type="submit" class="btn">Repay</button>
        </form>
    </div>
</div>
@endsection