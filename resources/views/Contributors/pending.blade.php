@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">PENDING SAVINGS</p>

        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($pendings)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Depositor</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendings as $listing)
                    <tr>
                        <td>{{$listing->entry_date->toFormattedDateString()}}</td>
                        <td><a href="/user/page/{{$listing->user->id}}">{{$listing->user->first_name}}
                                {{$listing->user->last_name}}</a></td>
                        <td>{{number_format($listing->amount_saved,2,'.',',')}}</td>
                        <td>{{$listing->depositor_name}}</td>
                        <td>{{$listing->notes}}</td>
                        <td><a href="/approve/saving/{{$listing->id}}"
                                class="btn green darken-3 approve-saving">Approve</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$userSavings->links()}} --}}
            @else
            <p>No Records Available</p>
            @endif
        </div>
    </div>
</div>
@endsection