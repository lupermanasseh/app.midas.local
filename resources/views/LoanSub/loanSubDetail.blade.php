@extends('Layouts.admin-app')


@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">PENDING LOAN DETAILS</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/loanProduct/create"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="New Loan Product">playlist_add</i></a></span>
            <span><a href="/loan-subscriptions"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Loan Subscriptions">view_list</i></a></span>
            <span><a href="/loanSub/create"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="New Loan Subscription">add_shopping_cart</i></a></span>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            @if (count($loanDetails)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Owner</th>
                        <th>Amount Applied</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loanDetails as $item)
                    <tr>
                        <td>{{$item->loan->description}}</td>
                        <td><a href="/user/page/{{$item->user_id}}">{{$item->user->first_name}}</a></td>
                        <td>{{$item->amount_applied}}</td>
                        <td>{{$item->created_at->diffForHumans()}}</td>
                        <td><a class="btn" href="/loanSub/edit/{{$item->id}}">Edit</a></td>
                        <td><a class="btn red" href="/userLoan/discard/{{$item->id}}">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$loanDetails->links()}} @else
            <p>No pending loan applications yet</p>
            @endif
        </div>
    </div>
</div>
@endsection