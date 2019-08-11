@extends('Layouts.user')
@section('admin')
<h3>Product Deductions</h3>
@if(count($deductions))
<table>
    <thead>
        <tr>
            <th>PRODUCT</th>
            <th>AMOUNT</th>
            <th>MODE</th>
            <th>DATE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($deductions as $list)
        <tr>
            <td>
                {{$list->product->description}}
            </td>
            <td>{{number_format($list->monthly_deduction,2,'.',',')}}</td>
            <td>
                {{$list->deduction_mode}}
            </td>
            <td>{{$list->entry_date->toFormattedDateString()}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$deductions->links()}}@else
<p>No records yet</p>
@endif
@endsection