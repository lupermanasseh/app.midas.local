@extends('Layouts.admin-app') 
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">Active Monthly Deductions</p>
            <span><a href="/"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="New Loan Subscription">playlist_add</i></a></span>
            <span><a href="/saving/search"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Search Savings">search</i></a></span>
            <span><a href="/products"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Upload Savings">cloud_upload</i></a></span>
            <span><a href="/"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All User Savings">view_list</i></a></span>
            <span><a href="/products"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All Savings">visibility</i></a></span>
            <span><a href="{{route('usersaving.create')}}"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="New Savings Upload">cloud_upload</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($activeUsers)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Contributor Name</th>
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
            {{$activeUsers->links()}} @else
            <p>No Records Yet</p>
            @endif
        </div>
    </div>
</div>
@endsection