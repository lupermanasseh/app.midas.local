@extends('Layouts.admin-app')

@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">NEW LOAN</span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/pendingLoans"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Pending Loans">view_list</i></a></span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/loanSub/store">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12 m4 l4">
                    <input placeholder="IPPIS or GFMIS" id="payment_id" name="payment_id" type="text" class="validate">
                    <label for="payment_id">Payment ID</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input placeholder="GUARANTOR IPPIS" id="guarantor_id1" name="guarantor_id1" type="text"
                        class="validate">
                    <label for="guarantor_id1">First Guarantor</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input placeholder="GUARANTOR IPPIS" id="guarantor_id2" name="guarantor_id2" type="text"
                        class="validate">
                    <label for="guarantor_id2">Second Guarantor</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m5 l5">
                    <select id="product_cat" name="product_cat">
                        @foreach ($catlist as $id=>$name)
                        <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <label>Product Category</label>
                </div>
                <div class="input-field col s12 m2 l2">
                    <input id="units" name="units" type="number" class="validate">
                    <label for="units">Units</label>
                </div>
                <div class="input-field col s12 m5 l5">
                    <select id="product_item" name="product_item">
                    </select>
                    <label>Product</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m3 l3">
                    <input id="amount_applied" name="amount_applied" type="text" class="validate">
                    <label for="amount_applied">Amount Applied</label>
                </div>
                <div class="input-field col s12 m3 l3">
                    <input id="net_pay" name="net_pay" type="text" class="validate">
                    <label for="net_pay">Net Pay</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="custom_tenor" name="custom_tenor" type="text"
                        placeholder="Eg 3 or 5 (values in months Optional)">
                    <label for="custom_tenor">Custom Tenor</label>
                </div>
            </div>

            <button type="submit" class="btn">Submit Request</button>
        </form>
    </div>
</div>
@endsection