@extends('Layouts.admin-app') 
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">EDIT PRODUCT SUBSCRIPTION</span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/subscriptions"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All Subscription">view_list</i></a></span>
            <span><a href="/products"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All Products">apps</i></a></span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/user/ProductEdit/{{$product->id}}">
            {{ csrf_field() }}
            <div class="row">
                {{--
                <div class="input-field col s12 m6 l6">
                    <input placeholder="IPPIS or GFMIS" id="payment_id" name="payment_id" value="{{$product->user->payment_number}}" type="text"
                        class="validate">
                    <label for="payment_id">Payment ID</label>
                </div> --}} {{--
                <div class="input-field col s12 m6 l6">
                    <input placeholder="GUARANTOR IPPIS" id="guarantor_id" name="guarantor_id" value="{{$product->guarantor_id}}" type="text"
                        class="validate">
                    <label for="guarantor_id">Guarantor</label>
                </div> --}}
            </div>
            <div class="row">
                <div class="input-field col s12 m3 l3">
                    <input placeholder="IPPIS or GFMIS" id="payment_id" name="payment_id" value="{{$product->user->payment_number}}" type="text"
                        class="validate">
                    <label for="payment_id">Payment ID</label>
                </div>
                <div class="input-field col s12 m3 l3">
                    <select id="product" name="product">
                        {{-- <option value="" disabled>Choose role</option> --}}
                        @foreach ($prodList as $id=>$name)
                        <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <label>Product List</label> Hint: {{$product->product->name}}
                </div>
                <div class="input-field col s12 m3 l3">
                    <input id="units" name="units" value="{{$product->units}}" type="text" class="validate">
                    <label for="units">Units</label>
                </div>
                <div class="input-field col s12 m3 l3">
                    <input id="net_pay" name="net_pay" value="{{$product->net_pay}}" type="text" class="validate">
                    <label for="net_pay">Net Pay</label>
                </div>
            </div>
            <button type="submit" class="btn">Edit Subscription</button>
        </form>
    </div>
</div>
@endsection