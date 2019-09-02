@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">EDIT LOAN APPLICATIONS</span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/loanSub/update/{{$lSub->id}}">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12 m4 l4">
                    <input placeholder="Reg Number" id="reg_no" value="{{$applicant_reg}}" name="reg_no" type="text"
                        class="validate">
                    <label for="reg_no">Applicant's Reg Number</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input placeholder="GUARANTOR Reg Number" id="guarantor_id1" name="guarantor_id1" value="{{$g1}}"
                        type="text" class="validate">
                    <label for="guarantor_id1">First Guarantor</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input placeholder="GUARANTOR Reg Number" id="guarantor_id2" name="guarantor_id2" value="{{$g2}}"
                        type="text" class="validate">
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
                    <input id="units" name="units" value="{{$lSub->units}}" type="number" class="validate">
                    <label for="units">Units</label>
                    <span>Hint: {{$lSub->units}}</span>
                </div>
                <div class="input-field col s12 m5 l5">
                    <select id="product_item" name="product_item">
                    </select>
                    <label>Product</label>
                    <span>Hint: {{$lSub->product->name}}</span>
                </div>

            </div>

            <div class="row">
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
            </div>

            <button type="submit" class="btn">edit Loan Request</button>
        </form>
    </div>
</div>
@endsection