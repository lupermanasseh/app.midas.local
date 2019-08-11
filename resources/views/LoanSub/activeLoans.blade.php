@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">ACTIVE LOANS</p>

        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/loanSub/create"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="New Loan Subscription">playlist_add</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($activeLoans)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>PRODUCT</th>
                        <th>AMOUNT</th>
                        <th>PAID</th>
                        <th>BAL</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activeLoans as $active)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><a href="/user/page/{{$active->user_id}}">{{$active->user->first_name}}
                                {{$active->user->last_name}}</a></td>
                        <td>{{$active->product->name}}</td>
                        <td><a
                                href="activeLoan/detail/{{$active->id}}">{{number_format($active->amount_approved,2,'.',',')}}</a>
                        </td>
                        <td>{{number_format($active->totalLoanDeductions($active->id),2,'.',',')}}</td>
                        <td>{{number_format($active->amount_approved-$active->totalLoanDeductions($active->id),2,'.',',')}}
                        </td>
                        <td><a href="/userLoan/stop/{{$active->id}}" class="btn red">stop</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$activeLoans->links()}} @else
            <p>No active loans yet</p>
            @endif
        </div>
    </div>
</div>
@endsection