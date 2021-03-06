@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">VERIFY BALANCES</h6>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($loans)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DISBURSEMENT DATE</th>
                        <th>REG NO</th>
                        <th>NAME</th>
                        <th>PRODUCT</th>
                        <th>AMOUNT</th>
                        <TH>BALANCE</TH>
                        <TH>ACTION</TH>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                    @if($loan->findCompleteBalance($loan->id) == 0.00 )
                    @continue
                    @endif
                    <tr>
                        <td>{{$loan->disbursement_date->toFormattedDateString()}}</td>
                        <td>{{$loan->user->id}}</td>
                        <td>{{$loan->user->first_name}}
                                {{$loan->user->last_name}}</td>
                        <td>{{$loan->product->name}}</td>
                        <td>{{number_format($loan->amount_approved,2,'.',',')}}</td>
                        <td><a href="/loanDeduction/history/{{$loan->id}}">{{number_format($loan->findCompleteBalance($loan->id),2,'.',',')}}</a></td>
                        <td>
                            <a href="/activate/verifyBalances/{{$loan->id}}" id="delete"> <i
                            class="tiny material-icons green-text tooltipped" data-position="bottom" data-tooltip="Activate Loan">check</i></a>
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
