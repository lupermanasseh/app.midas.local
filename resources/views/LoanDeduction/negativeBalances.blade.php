@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">NEGATIVE BALANCES</h6>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($loans)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DISBURSEMENT DATE</th>
                        <th>NAME</th>
                        <th>PRODUCT</th>
                        <th>AMOUNT</th>
                        <TH>BALANCE</TH>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                    @if($loan->findCompleteBalance($loan->id) >=0)
                    @continue
                    @endif
                    <tr>
                        <td>{{$loan->disbursement_date->toFormattedDateString()}}</td>
                        <td><a href="/user/page/{{$loan->user->id}}">{{$loan->user->first_name}}
                                {{$loan->user->last_name}}</a></td>
                        <td>{{$loan->product->name}}</td>
                        <td>{{number_format($loan->amount_approved,2,'.',',')}}</td>
                        <td><a href="/loanDeduction/history/{{$loan->id}}">{{number_format($loan->findCompleteBalance($loan->id),2,'.',',')}}</a></td>
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
