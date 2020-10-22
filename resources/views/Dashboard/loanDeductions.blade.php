@extends('Layouts.user')
@section('admin')
<h3>Loan Deductions</h3>
@if(count($deductions))
<table>
    <thead>
        <tr>
            <th>DATE</th>
            <th>DESC</th>
            <th>DEBIT</th>
            <th>CREDIT</th>
            <th>BAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($deductions as $list)
        <tr>
            <td>{{$list->entry_month->toFormattedDateString()}}</td>
            <td>{{$list->notes}}</td>
            <td>
              @if($list->amount_debited)
              {{number_format($list->amount_debited,2,'.',',')}}
              @else
              @endif
            </td>
            <td>
              @if($list->amount_deducted)
              {{number_format($list->amount_deducted,2,'.',',')}}
              @else
              @endif
              </td>
              <td>
              {{number_format($loan->amount_approved-$myItem->balances,2,'.',',')}}
              </td>

        </tr>
        @endforeach
    </tbody>
</table>
{{$deductions->links()}}@else
<p>No records yet</p>
@endif
@endsection
