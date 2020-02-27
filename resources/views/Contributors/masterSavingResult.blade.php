@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">MEMBER SAVING LIABILITY</p>
        </div>
    </div>
    @if (count($uniqueContributors)>=1)
    <div class="row">
        <div class="col s12 m3 l3">
            <a href="/savingliability/excel/{{$to}}" class="btn">DOWNLOAD EXCEL</a>
        </div>
        <div class="col s12 m3 l3">
            <a href="/savingliability/pdf/{{$to}}" target="_blank" class="btn">DOWNLOAND PDF</a>
        </div>
    </div>
    @else
    @endif
    <div class="row">
        <div class="col s12">
            @if (count($uniqueContributors)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>REG NO</th>
                        <th>NAME</th>
                        <th>IPPIS NO</th>
                        <th>MEMBER TYPE</th>
                        <th>CLOSING DATE</th>
                        <th>BALANCE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($uniqueContributors as $listing)
                    <tr>
                        <td>{{$listing->user_id}}</td>
                        <td>{{$listing->user->first_name}} {{$listing->user->last_name}}</td>
                        <td>{{$listing->user->payment_number}}</td>
                        <td>{{$listing->user->membership_type}}</td>
                        <td>{{$to}}</td>
                        <td>{{number_format($listing->userAggregateAt($savingsCollection,$listing->user_id),2,'.',',')}}
                        </td>
                    </tr>
                    @endforeach
                    @if (count($uniqueContributors)>=1)
                    <tr>
                        <th colspan="5">Total</th>
                        <th>{{number_format($saving->savingAggregateAt($to),2,'.',',')}}</th>
                    </tr>
                    @else
                    @endif
                </tbody>
            </table>
            @else
            <p>No Records Available</p>
            @endif
        </div>
    </div>
</div>
@endsection