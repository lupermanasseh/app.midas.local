@extends('Layouts.admin-app') 
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h5 class="teal-text">PRODUCT DEDUCTION DETAILS</h5>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/productDeduction/listings"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Go Back">arrow_back</i></a></span>

        </div>
    </div>

    <div class="row">
        <div class="col s12 m6 l6">

            <div class="card">
                <div class="card-image">
                    {{-- <img src="images/sample-1.jpg"> --}} {{-- <span class="card-title">PRODUCT DEDUCTION DETAILS</span>                    --}}
                </div>
                <div class="card-content">
                    <ul class="collection with-header">
                        <li class="collection-header">
                            <h5>PRODUCT DEDUCTION DETAILS</h5>
                        </li>
                        <li class="collection-item">
                            <h6>{{$deductDetails->user->first_name}} {{$deductDetails->user->last_name}}</h6>
                        </li>
                        <li class="collection-item"><span class="badge" data-badge-caption="{{$deductDetails->deduction_mode}}"></span>Mode</li>
                        <li class="collection-item"><span class="badge" data-badge-caption="{{number_format($deductDetails->monthly_deduction,2,'.',',')}}"></span>Deduction</li>
                        <li class="collection-item"><span class="badge" data-badge-caption="{{$deductDetails->bank_name}}"></span>Bank</li>
                        <li class="collection-item"><span class="badge" data-badge-caption="{{$deductDetails->depositor_name}}"></span>Depositor Name</li>
                        <li class="collection-item"><span class="badge" data-badge-caption="{{$deductDetails->teller_no}}"></span>Teller Number</li>
                    </ul>
                </div>
                <div class="card-action">
                    <a href="/productDeduction/listings" class="btn">Recent Deductions</a>
                </div>
            </div>

        </div>

        <div class="col s12 m6 l6">

            <div class="card">
                <div class="card-image">
                    {{-- <img src="images/sample-1.jpg"> --}} {{-- <span class="card-title"></span> --}}
                </div>
                <div class="card-content">
                    <ul class="collection with-header">
                        <li class="collection-header">
                            <h5>PRODUCT SUBSCRIPTION DETAILS</h5>
                        </li>
                        <li class="collection-item">
                            <h6>{{$productSubDetails->user->first_name}} {{$productSubDetails->user->last_name}}</h6>
                        </li>
                        <li class="collection-item"><span class="badge pink lighten-2 white-text" data-badge-caption="{{$productSubDetails->product->name}}"></span>Product
                            Name
                        </li>
                        <li class="collection-item"><span class="badge red lighten-3 white-text" data-badge-caption="{{$productSubDetails->units}}"></span>Unit(s)</li>
                        <li class="collection-item"><span class="badge purple white-text" data-badge-caption="{{number_format($productSubDetails->total_amount, 2,'.',',')}}"></span>Total
                            Amount (N)
                        </li>
                        <li class="collection-item"><span class="badge purple accent-1 white-text" data-badge-caption="{{number_format($productSubDetails->monthly_repayment,2,'.',',')}}"></span>Monthly
                            Repayment (N)
                        </li>
                        <li class="collection-item"><span class="badge blue lighten-3 white-text" data-badge-caption="{{$productSubDetails->status}}"></span>Status</li>
                        <li class="collection-item"><span class="badge indigo accent-1 white-text" data-badge-caption="{{$productSubDetails->start_date->toDateString()}}"></span>Start</li>
                        <li class="collection-item"><span class="badge teal lighten-1 white-text" data-badge-caption="{{$productSubDetails->end_date->toDateString()}}"></span>End</li>
                    </ul>
                </div>
                <div class="card-action">
                    <a href="/subscriptions" class="btn">Product Subsriptions</a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection