@extends('Layouts.user')
@section('admin')
<h3>Active Loans</h3>
@if(count($loans)>=1)
<table>
    <thead>
        <tr>

            <th>Product</th>
            <th>Amount</th>
            <th>Balance</th>
            <th>Status</th>
            <th>Detail</th>
            <th>History</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($loans as $active)
        <tr>

            <td>{{$active->product->name}}</td>
            <td>{{number_format($active->amount_approved,2,'.',',')}}</td>
            <td>  {{number_format($active->amount_approved-$active->totalLoanDeductions($active->id),2,'.',',')}}</td>
            <td>
                {{$active->loan_status}}
            </td>
            <td><a href="/Dashboard/userloans/view/{{$active->id}}">Detail</a></td>
            <td><a href="/Dashboard/user/loans/{{$active->id}}">History</a></td>
        </tr>
        @endforeach
    </tbody>
</table>@else
<p>No records yet</p>
@endif
@endsection
