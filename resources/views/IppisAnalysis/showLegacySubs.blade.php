@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">ACTIVATE LEGACY LOAN SUBSCRIPTIONS</h6>
        </div>
    </div>
@if (count($collection)>=1)
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/on/legacysubs"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Post Bulk">done_all</i></a></span>
        </div>
    </div>
@endif
    <div class="row">
        <div class="col s12">
            @if (count($collection)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DISBURSEMENT DATE</th>
                        <th>NAME</th>
                        <th>USER ID</th>
                        <th>APPROVED AMOUNT</th>
                        <th>CREATED</th>
                        <!-- <th>ACTION</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection as $myItem)
                    <tr>
                        <td>{{$myItem->disbursement_date->toFormattedDateString()}}</td>
                        <td>{{$myItem->user->last_name}}</td>
                        <td>{{$myItem->user_id}}</td>
                        <td>{{number_format($myItem->amount_approved,2,'.',',')}}</td>
                        <td>{{$myItem->created_at->diffForHumans()}}</td>
                        <!-- <td>
                            <a href="/loan/distribute/" class="btn green darken-3 post-looan">Post
                                Loan</a>
                        </td> -->
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
