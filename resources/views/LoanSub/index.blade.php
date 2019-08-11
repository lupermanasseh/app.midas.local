@extends('Layouts.admin-app') 
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">ALL LOAN REQUEST(s)</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/loanSub/create"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="New Loan Subscription">playlist_add</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($loanReq)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Loan Description</th>
                        <th>Total Request</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loanReq as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><a href="/loan-request/{{$item->id}}">{{$item->description}}</a></td>
                        <td>{{$item->loansubscriptions_count}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$loanReq->links()}} @else
            <p>No loan request added yet</p>
            @endif
        </div>
    </div>
</div>
@endsection