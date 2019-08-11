@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">PRODUCT SUBSCRIPTION(s)</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/subscriptions"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Subscriptions">view_list</i></a></span>
            <span><a href="/new-subscription"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="New Product Subscription">add_shopping_cart</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($subs)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Owner</th>
                        <th>Total</th>
                        <th>Net Pay</th>
                        <th>Date Added</th>
                        <th>Action/Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subs as $sub)
                    <tr>
                        <td>{{$sub->product->name}}</td>
                        <td><a href="/user/products/{{$sub->user_id}}">{{$sub->user->first_name}}</a></td>
                        <td>{{number_format($sub->total_amount,2,'.',',')}}</td>
                        <td>{{number_format($sub->net_pay,2,'.',',')}}</td>
                        <td>{{$sub->created_at->diffForHumans()}}</td>
                        <td>
                            @if ($sub->status == 'Active')
                            {{$sub->status}}
                            @else
                            <a href="/prodSub/review/{{$sub->id}}" class="blue-text darken-2">Review</a> <a
                                href="/userProdSub/delete/{{$sub->id}}" class="red-text lighten-3">Discard</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$subs->links()}} @else
            <p>No product Subscriptions added yet</p>
            @endif
        </div>
    </div>
</div>
@endsection