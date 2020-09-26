@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">LOAN OVER DEDUCTION(s)</h6>
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
                        <th>AMOUNT</th>
                        <th>CREATED</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loanMaster as $myItem)
                    <tr>
                        <td>{{$myItem->entry_date->toFormattedDateString()}}</td>
                        <td>{{$myItem->user->first_name}}</td>
                        <td>{{number_format($myItem->overdeduction_amount,2,'.',',')}}</td>
                        <td>{{$myItem->created_at->diffForHumans()}}</td>
                        <td>
                          <a href="/loanoverdeduction/post/{{$myItem->user_id}}/{{$myItem->id}}" class="btn green darken-3 post-looan">
                                Post</a>
                        <!-- <a href="#" class="btn pink darken-3 post-looan">
                                Refund</a> -->
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
