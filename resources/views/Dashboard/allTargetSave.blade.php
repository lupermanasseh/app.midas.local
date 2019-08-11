@extends('Layouts.user')
@section('admin')
<h3>ALL TARGET SAVINGS</h3>
@if (count($saving)>=1)
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>AMOUNT</th>
            <th>MODE</th>
            <th>DATE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($saving as $active)
        <tr>
            <td>
                {{$active->user->first_name}} {{$active->user->last_name}}
            </td>
            <td>
                {{number_format($active->amount,2,'.',',')}}
            </td>
            <td>
                {{$active->target_saving_mode}}
            </td>
            <td>{{$active->entry_date->toFormattedDateString()}}</td>

        </tr>
        @endforeach
    </tbody>
</table>
{{$saving->links()}} @else
<p>No records yet</p>
@endif
@endsection