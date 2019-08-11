@extends('Layouts.admin-app') 
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h5 class="teal-text">SUBSCRIPTION DETAILS</h5>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/subscriptions"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Create Product">playlist_add</i> All Product Subscriptions</a></span>

        </div>
    </div>

    <div class="row">
        <div class="col s12">

        </div>
    </div>
</div>
@endsection