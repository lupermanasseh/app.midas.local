@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">LOAN DEDUCTION</h6>
        </div>
    </div>

    @if (count($loanSub)>=1)
    <div class="row">
        <div class="col s12">
            <span>
                <a class="btn-small purple lighten-1" href="/midasFilterExcel/{{$start_date}}/{{$end_date}}"><i
                        class="fas fa-file-excel"></i>
                    MIDAS EXCEL</a>
            </span>
            <span>
                <a class="btn-small purple lighten-1" href="/filterExcel/{{$start_date}}/{{$end_date}}"><i
                        class="fas fa-file-excel"></i>
                    IPPIS EXCEL</a>
            </span>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col s12">
            @if (count($loanSub)>=1)
            @include('LoanDeduction.display') @else
            <p>No active records yet</p>
            @endif
        </div>
    </div>
</div>
@endsection