@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">CATEGORY ITEMS</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/product/create"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Create Product">playlist_add</i></a></span>
            <span><a href="/new-subscription"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Product Subscription">add_shopping_cart</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($categoryItems)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categoryItems as $product)
                    <tr>
                        <td>{{$product->productcategory['name']}}</td>
                        <td><a href="/product/detail/{{$product->id}}">{{$product->name}}</a></td>
                        <td>{{$product->status}}</td>
                        @if($product->status=='Active')
                        <td><a href="/deactivate/{{$product->id}}" class="red btn">Deactivate</a></td>
                        @else
                        <td><a href="/activate/{{$product->id}}" class="green btn">Activate</a></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No product for this category yet</p>
            @endif
        </div>
    </div>
</div>
@endsection