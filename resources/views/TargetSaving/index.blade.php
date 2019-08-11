@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">Active TS Deductions</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a class="btn" href="{{route('ts.export')}}"><i class="fas fa-arrow-circle-down"></i>
                    Download</a></span>
        </div>
    </div>



    <div class="row">
        <div class="col s12">
            @if (count($ts)>=1)
            @include('TargetSaving.tsview',$ts) {{$ts->links()}} @else
            <p>No active target saving records yet</p>
            @endif
        </div>
    </div>
</div>
@endsection