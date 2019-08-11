@extends('Layouts.admin-app') 
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">Edit Target Saving</p>
            <span><a href="/"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="New Loan Subscription">playlist_add</i></a></span>
            <span><a href="/saving/search"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Search Savings">search</i></a></span>
            <span><a href="/products"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Upload Savings">cloud_upload</i></a></span>
            <span><a href="/"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All User Savings">view_list</i></a></span>
            <span><a href="/products"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All Savings">visibility</i></a></span>
            <span><a href="{{route('ts.create')}}"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="New TS Upload">cloud_upload</i></a></span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/ts-saving/update/{{$tSaving->id}}">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12 m12 l12">
                    <input id="amount" name="amount" value="{{$tSaving->amount}}" type="text" class="validate">
                    <label for="amount">Amount</label>
                </div>
            </div>

            <button type="submit" class="btn">Edit Target Saving Record</button>
        </form>
    </div>
</div>
@endsection