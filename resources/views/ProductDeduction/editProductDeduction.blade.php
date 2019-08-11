@extends('Layouts.admin-app') 
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h5 class="teal-text">EDIT DEDUCTION DETAILS</h5>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/productDeduction/listings"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Go Back">arrow_back</i></a></span>

        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/productDeduction/update/{{$deduction->id}}">
            {{ csrf_field() }} {{--
            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <input placeholder="IPPIS or GFMIS" id="payment_id" name="payment_id" value="{{$deduction->user->payment_number}}" type="text"
                        class="validate">
                    <label for="payment_id">Payment ID</label>
                </div>
            </div> --}}
            <div class="row">
                {{--
                <div class="input-field col s12 m6 l6">
                    <select id="product" name="product">
                        @foreach ($prodList as $id=>$name)
                        <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <label>Product List</label>
                    <span>Hint: {{$deduction->product->name}}</span>
                </div> --}}

                <div class="input-field col s12">

                    <input id="amount" name="amount" value="{{$deduction->monthly_deduction}}" type="text" class="validate">
                    <label for="amount">Payment</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m4 l4">
                    <input id="bank_name" name="bank_name" value="{{$deduction->bank_name}}" type="text" class="validate">
                    <label for="bank_name">Bank Name</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="depositor_name" name="depositor_name" value="{{$deduction->depositor_name}}" type="text">
                    <label for="depositor_name">Depositor Name</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="teller_number" name="teller_number" value="{{$deduction->teller_no}}" type="text">
                    <label for="teller_number">Teller Number</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <select id="mode" name="mode">
                                <option value="IPPIS">IPPIS</option>
                                <option value="Bank">Bank</option>
                            </select>
                    <label>Payment Mode</label>
                    <span>Hint: {{$deduction->deduction_mode}}</span>
                </div>

                <div class="input-field col s12 m6 l6">
                    <input id="entry_date" name="entry_date" value="{{$deduction->entry_date->toDateString()}}" type="text" class="validate datepicker">
                    <label for="entry_date">Date</label>
                </div>

            </div>
            <button type="submit" class="btn">Edit Product Deduction</button>
        </form>
    </div>
</div>
@endsection