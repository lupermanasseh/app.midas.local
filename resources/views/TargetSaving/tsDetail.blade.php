@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}

    <div class="row">
        <div class="col s12">
            @if (count($tsSavings)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Credit</th>
                        <th>Debit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tsSavings as $listing)
                    <tr>
                        <td>{{$listing->entry_date->toFormattedDateString()}}</td>
                        <td><a href="/user/page/{{$listing->user->id}}">{{$listing->user->first_name}}
                                {{$listing->user->last_name}}</a></td>
                        <td>{{number_format($listing->amount,2,'.',',')}}</td>
                        <td>{{number_format($listing->withdrawal,2,'.',',')}}</td>
                        {{-- <td>{{$listing->created_at->diffForHumans()}}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$tsSavings->links()}} @else
            <p>No Records Available</p>
            @endif
        </div>
    </div>
</div>
@endsection