@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">ACTIVE MONTHLY DEDUCTIONS</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a class="btn" href="{{route('usersaving.export')}}"><i class="fas fa-arrow-circle-down"></i> Download
                </a></span>
        </div>
    </div>



    <div class="row">
        <div class="col s12">
            @if (count($savings)>=1)
            @include('MonthlySaving.savingsTable',$savings) {{$savings->links()}} @else
            <p>No active saving records yet</p>
            @endif
        </div>
    </div>
</div>
@endsection