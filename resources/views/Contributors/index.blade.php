@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">Active Members</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($activeUsers)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Saving Items</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activeUsers as $user)
                    <tr>
                        <td><a href="/saving/listings/{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a></td>
                        <td>{{$user->status}}</td>
                        <td>{{$user->usersavings_count}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$activeUsers->links()}} --}}
            @else
            <p>No Records Yet</p>
            @endif
        </div>
    </div>
</div>
@endsection