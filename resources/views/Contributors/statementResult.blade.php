@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">SAVING SEARCH RESULT</p>
        </div>
    </div>

    <div class="row">
        <p><a href="/statement/printfile/{{$fromDate}}/{{$toDate}}/{{$user_id}}" class="btn green darken-4"
                target="_blank"><i class="fas fa-file-alt"></i> FILE</a> | <a
                href="/statement/printpdf/{{$fromDate}}/{{$toDate}}/{{$user_id}}" class=" btn pink darken-4"
                target="_blank"><i class="fas fa-file-pdf"></i> PDF</a> <strong>[ =N=
                {{number_format($saving->netBalance($user_id),2,'.',',')}} ]</strong>
        </p>
    </div>
    <div class="row">
        <div class="col s12">
            @if (count($result)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>NAME</th>
                        <th>DESCRIPTION</th>
                        <th>DEBIT</th>
                        <th>CREDIT</th>
                        <th>BALANCE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$saving->openingDate($fromDate)}}</td>
                        <td></td>
                        <td>Openning Balance</td>
                        <td></td>
                        <td></td>
                        <td>{{number_format($saving->openingBalance($fromDate,$userObj->id),2,'.',',')}}</td>
                    </tr>
                    @foreach ($result as $myItem)
                    <tr>
                        <td>{{$myItem->entry_date->toFormattedDateString()}}</td>
                        <td><a href="/user/page/{{$myItem->user->id}}">{{$myItem->user->first_name}}
                                {{$myItem->user->last_name}}</a></td>
                        <td>
                            {{$myItem->notes}}
                        </td>
                        <td>@if($myItem->amount_withdrawn)
                          {{number_format($myItem->amount_withdrawn,2,'.',',')}}
                          @else
                          -
                          @endif</td>
                        <td>
                        @if($myItem->amount_saved)
                        {{number_format($myItem->amount_saved,2,'.',',')}}
                        @else
                        -
                        @endif
                        </td>
                        <td>{{number_format($saving->balanceAsAt($myItem->amount_saved,$myItem->amount_withdrawn,$myItem->id,$userObj->id),2,'.',',')}}
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
