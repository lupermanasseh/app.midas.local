@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">NEW PRODUCT</span>
            <span><a href="/products"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Products">view_list</i></a></span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/product/store">
            {{ csrf_field() }}
            <div class="row">
                {{-- @can('all') --}}
                <div class="input-field col s12 m4 l4">
                    <select id="product_category" name="product_category">
                        @foreach ($catlist as $id=> $name)
                        <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <label>Product Category</label>
                </div>
                {{-- @endcan --}}

                <div class="input-field col s12 m4 l4">
                    <input id="product_name" name="product_name" type="text" class="validate" required>
                    <label for="product_name">Product Name</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="description" name="description" type="text" class="validate" required>
                    <label for="description">Product Description</label>
                </div>
            </div>

            <div class="row">

                <div class="input-field col s12 m4 l4">
                    <input id="unit_cost" name="unit_cost" type="text" class="validate">
                    <label for="unit_cost">Unit Cost</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="tenor" name="tenor" type="text" class="validate" required>
                    <label for="tenor">Tenor</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="interest" name="interest" type="text" class="validate" required>
                    <label for="interest">Interest Rate</label>
                </div>
            </div>

            <button type="submit" class="btn">Add</button>
        </form>
    </div>
</div>
@endsection