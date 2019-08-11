@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">PRODUCT DETAILS</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/category/items/{{$product->productcategory->id}}"><i class="small material-icons tooltipped"
                        data-position="bottom" data-tooltip="Return">arrow_back</i></a></span>
            <span><a href="/products"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Products">view_list</i></a></span>
        </div>
    </div>

    <div class="row user-profiles">
        <div class="col s12 m3 l3 profile">
            {{-- <img src="{{asset('images/andy.jpg')}}" alt="" class="circle"> --}}
            <p class="profile__heading text-grey darken-3">Bird View</p>
            {{-- <img src="{{asset('images/andy.jpg')}}" alt="" class="profile__photo materialboxed"> --}}
            {{-- <span class="profile__user-name">  Product Avatar Above </span>            --}}

            <div class="profile__user-box">
                <span class="black-text sub-profile">Category</span>
                <span class="profile__user-status grey-text lighten-2">{{$product->productcategory->name}}</span>
                <span class="black-text sub-profile">Interest Rate</span>
                <span class="profile__user-status grey-text lighten-2">{{$product->interest}}</span>
                <span class="black-text sub-profile">Added On</span>
                <span class="profile__user-date grey-text lighten-2">
                    {{$product->created_at->toFormattedDateString()}}
                </span>
                <span><a href="/editProduct/{{$product->id}}" class="pink-text darken-2">Edit</a></span>
                <span class="black-text sub-profile">Subscriptions</span>
                <h4 class="profile__join-date grey-text lighten-2">{{$product->productSubCount($product->id)}}</h4> {{-- <span class="black-text sub-profile"></span>
                <span class="profile__user-status grey-text lighten-2"></span> --}}
            </div>
            <span><a href="/p-sub/{{$product->id}}" class="pink-text darken-2">More</a></span>
        </div>
        <div class="col s12 m9 l9 profile-detail">
            @if ($product)
            <div>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Unit Cost</th>
                            <th>Tenor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{number_format($product->unit_cost,2,'.','.')}}</td>
                            <td>{{$product->tenor}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @else
            <p>No Record Added Yet</p>
            @endif
        </div>
    </div>
</div>
@endsection