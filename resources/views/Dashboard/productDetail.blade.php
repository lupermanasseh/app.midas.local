@extends('Layouts.user')
@section('admin')
<p>PRODUCT SUBSCRIPTION DETAILS</p>
<div class="user-profiles">
    <div class="profile">
        <div class="myloandetail">
            <p class="review__rating">PRODUCT DETAILS</p>
            <span>Product Name: {{$products->product->name}}</span>
            <span>Tenor: {{$products->product->tenor}}</span>
            <span>Total Amount: {{number_format($products->amount_applied,2,'.',',')}}</span>
            <span>Monthly Payment: {{number_format($products->monthly_deduction,2,'.',',')}}</span>
        </div>
    </div>
</div>

<div class="user-profiles">
    <div class="profile">
        <div class="myloandetail">
            <p class="review__rating">STATUS DETAILS</p>
            <span>Status: {{$products->loan_status}}</span>
            {{-- <span>Start Date:
                {{$products->start_date->toFormattedDateString()}}</span>
            <span>End Date:
                {{$products->end_date->toFormattedDateString()}}</span> --}}
        </div>
    </div>
</div>


@endsection