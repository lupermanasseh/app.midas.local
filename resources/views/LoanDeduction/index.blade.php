@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') 
    --}}

    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">MIDAS LOAN DEDUCTION</h6>
        </div>
    </div>

    <div class="row">
        <div class="col s12 ">
            <span><a class="btn" href="{{route('loans.export')}}"><i class="fas fa-file-excel"></i>
                    MIDAS XLSX</a>
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($loanSub)>=1)
            @include('LoanDeduction.display',$loanSub) @else
            <p>No active records yet</p>
            @endif
        </div>
    </div>
</div>
@endsection