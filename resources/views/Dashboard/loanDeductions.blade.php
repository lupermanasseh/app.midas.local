@extends('Layouts.user')
@section('admin')
<h3>Loan Deductions</h3>
@if(count($deductions))
<table>
    <thead>
        <tr>
            <th>DATE</th>
            <th>PRODUCT</th>
            <th>AMOUNT</th>
            <th>DESC</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($deductions as $list)
        <tr>
            <td>{{$list->entry_month->toFormattedDateString()}}</td>
            <td>
                {{$list->product->name}}
            </td>
            <td>{{number_format($list->amount_deducted,2,'.',',')}}</td>
            <td>
                {{$list->notes}}
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
{{$deductions->links()}}@else
<p>No records yet</p>
@endif
@endsection