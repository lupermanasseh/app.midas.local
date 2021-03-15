@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">UNPOSTED MASTER LOAN DEDUCTION(s)</h6>
        </div>
    </div>

    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/post/loans"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Post Loans">arrow_back</i></a></span>
        </div>
    </div>


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
                        <td>
                            @if($myItem->unPostedDeduction($myItem->id)->count()==0)
                            <a href="/postDeductions/{{$myItem->id}}" class="btn red darken-3 post-looan">Post Anyway</a>
                            @else

                            @endif

                        </td>
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
