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

    <div class="row">
        <div class="col s12">
            @if (count($savingsCollection)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>REG NO</th>
                        <th>NAME</th>
                        <th>IPPIS NO</th>
                        <th>MEMBER TYPE</th>
                        <th>BALANCE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($savingsCollection as $listing)
                    <tr>
                        <td>{{$listing->user_id}}</td>
                        <td>{{$listing->user->first_name}} {{$listing->user->last_name}}</td>
                        <td>{{$listing->user->payment_number}}</td>
                        <td>{{$listing->user->membership_type}}</td>
                        <td>{{number_format($listing->userAggregateAt($savingsCollection,$listing->id),2,'.',',')}}</td>
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