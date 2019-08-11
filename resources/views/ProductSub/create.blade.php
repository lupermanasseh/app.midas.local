@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">NEW PRODUCT SUBSCRIPTION</span>
        </div>
    </div>

    <div class="row">
        <div class="col s12 subject-header">

            <span><a href="/subscriptions"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Subscription">view_list</i></a></span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/productsub">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12 m2 l2">
                    <input placeholder="IPPIS #" id="payment_id" name="payment_id" type="text" class="validate">
                    <label for="payment_id">Payment ID</label>
                </div>
                {{-- <div class="input-field col s12 m3 l3">
                    <input placeholder="GUARANTOR IPPIS" id="guarantor_id" name="guarantor_id" type="text" class="validate">
                    <label for="guarantor_id">Guarantor</label>
                </div> --}}
                <div class="input-field col s12 m5 l5">
                    <select id="product_cat" name="product_cat">
                        @foreach ($catlist as $id=>$name)
                        <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <label>Product Category</label>
                </div>

                <div class="input-field col s12 m5 l5">
                    <select id="product_item" name="product_item">
                    </select>
                    <label>Product</label>
                </div>
            </div>

            <div class="row">

                <div class="input-field col s12 m6 l6">
                    <input id="units" name="units" type="text" class="validate" placeholder="Units Optional">
                    <label for="units">Units</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="net_pay" name="net_pay" type="text" class="validate">
                    <label for="net_pay">Net Pay</label>
                </div>
            </div>
            <button type="submit" class="btn">Subscribe</button>
        </form>
    </div>
</div>
@endsection