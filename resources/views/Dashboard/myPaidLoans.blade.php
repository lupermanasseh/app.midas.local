@extends('Layouts.user')
@section('admin')
<h3>Paid Loans</h3>
@if(count($loans)>=1)
<table>
    <thead>
        <tr>

            <th>PRODUCT</th>
            <th>AMOUNT</th>
            <th>STATUS</th>
            <th>HISTORY</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($loans as $active)
        <tr>

            <td>{{$active->product->name}}</td>
            <td>{{number_format($active->amount_applied,2,'.',',')}}</td>
            <td>
                {{$active->loan_status}}
            </td>
            <td><a href="/Dashboard/user/loans/{{$active->id}}">History</a></td>
        </tr>
        @endforeach
    </tbody>
</table>@else
<p>No records yet</p>
@endif
@endsection