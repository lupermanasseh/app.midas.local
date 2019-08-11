@extends('Layouts.user')
@section('admin')
<h3>All Product Subscriptions</h3>
@if(count($products)>=1)
<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Detail</th>
            <th>History</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $active)
        <tr>
            <td>
                {{$active->product->name}}
            </td>
            <td>{{number_format($active->total_amount,2,'.',',')}}</td>
            <td>
                {{$active->product->status}}
            </td>
            <td><a href="/Dashboard/userproducts/view/{{$active->id}}">Detail</a></td>
            <td><a href="/Dashboard/userproducts/history/{{$active->id}}">History</a></td>
        </tr>
        @endforeach
    </tbody>
</table>@else
<p>No records yet</p>
@endif
@endsection