@extends('Layouts.admin-app') 
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">PRODUCT SUBSCRIPTION DEDUCTION</h6>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="New Loan Subscription">playlist_add</i></a></span>
            <span><a href="/saving/search"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Search Savings">search</i></a></span>

            <span><a href="{{route('prod-deductions.upload')}}"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Upload Product Deductions">cloud_upload</i></a></span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a class="btn" href="{{route('prod-deductions.export')}}"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Download Product Deductions">cloud_download</i> Download</a></span>
        </div>
    </div>



    <div class="row">
        <div class="col s12">
            @if (count($allProductSub)>=1)
    @include('ProductDeduction.viewTable',$allProductSub) @else
            <p>No active records yet</p>
            @endif
        </div>
    </div>
</div>
@endsection