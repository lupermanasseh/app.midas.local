@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">RECENT SAVING RECORDS</p>

        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($userSavings)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userSavings as $listing)
                    <tr>
                        <td>{{$listing->entry_date->toFormattedDateString()}}</td>
                        <td><a href="/user/page/{{$listing->user->id}}">{{$listing->user->first_name}}
                                {{$listing->user->last_name}}</a></td>
                        <td>{{number_format($listing->amount_saved,2,'.',',')}}</td>
                        <td>{{number_format($listing->amount_withdrawn,2,'.',',')}}</td>

                        <td>{{$listing->notes}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$userSavings->links()}} @else
            <p>No Records Available</p>
            @endif
        </div>
    </div>
</div>
@endsection