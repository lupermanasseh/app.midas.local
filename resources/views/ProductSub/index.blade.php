@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">PRODUCT SUBSCRIPTION</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/new-subscription"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="New Product Subscription">add_shopping_cart</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($prod)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Total Subscriptions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prod as $p)
                    <tr>
                        <td><a href="/p-sub/{{$p->id}}">{{$p->name}}</a></td>
                        <td>{{$p->psubscriptions_count}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$prod->links()}} @else
            <p>No product Subscriptions added yet</p>
            @endif
        </div>
    </div>
</div>
@endsection