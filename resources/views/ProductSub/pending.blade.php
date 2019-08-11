@extends('Layouts.admin-app')

@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">PENDING SUBSCRIPTIONS</p>

        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/new-subscription"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="New Product Subscription">playlist_add</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($pendingSubs)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Created On</th>
                        <th>Status</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingSubs as $pending)
                    <tr>

                        <td><a href="/user/page/{{$pending->user_id}}">{{$pending->user->first_name}}
                                {{$pending->user->lastname_name}}</a></td>
                        <td>{{$pending->product->name}}</td>
                        <td>{{$pending->created_at->toFormattedDateString()}}</td>
                        <td>{{$pending->status}}</td>
                        <td><a href="/prodSub/review/{{$pending->id}}">Review</a> <a
                                href="/userProdSub/delete/{{$pending->id}}" class="red-text darken-4">Discard</a> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$pendingSubs->links()}} @else
            <p>No Pending Product Subscriptions</p>
            <span><a href="/prodSub/active" class="btn grey">View Active Product Subscription(s)</a></span>
            @endif
        </div>
    </div>
</div>
@endsection