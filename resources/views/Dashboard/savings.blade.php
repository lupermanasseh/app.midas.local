@extends('Layouts.user')
@section('admin')
<h3>MY SAVINGS</h3>
@if (count($saving)>=1)
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Transaction Details</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($saving as $active)
        <tr>
            <td>
                {{$active->entry_date->toFormattedDateString()}}
            </td>
            <td>
                {{$active->notes}}
            </td>
            <td>
                @if($active->amount_withdrawn)
                {{number_format($active->amount_withdrawn,2,'.',',')}}
                @else
                @endif
            </td>
            <td>
                @if($active->amount_saved)
                {{number_format($active->amount_saved,2,'.',',')}}
                @else
                @endif
            </td>
            <td>{{number_format($active->balanceAsAt($active->amount_saved,$active->amount_withdrawn,$active->id,auth()->id()))}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No records yet</p>
@endif
@endsection
