@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">RECENT MASTER LOAN DEDUCTION(s)</h6>
        </div>
    </div>
@if (count($loanMaster)>=1)
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/loandeductions/bulkmaster"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Post Bulk">done_all</i></a></span>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col s12">
            @if (count($loanMaster)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>NAME</th>
                        <th>USER ID</th>
                        <th>TOTAL AMOUNT</th>
                        <th>CREATED</th>
                        <!-- <th>ACTION</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loanMaster as $myItem)
                    <tr>
                        <td>{{$myItem->entry_date->toFormattedDateString()}}</td>
                        <td>{{$myItem->name}}</td>
                        <td>{{$myItem->ippis_no}}</td>
                        <td>{{number_format($myItem->cumulative_amount,2,'.',',')}}</td>
                        <td>{{$myItem->created_at->diffForHumans()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No Records Available</p>
            @endif
        </div>
    </div>
</div>
@endsection
