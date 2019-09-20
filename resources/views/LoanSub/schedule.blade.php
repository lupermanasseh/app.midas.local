@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">LOAN PAYMENT SCHEDULE</p>
        </div>
    </div>

    <div class="row">
        <p>

            <a href="/loan/schedule/print/{{$loan->id}}" class=" btn pink darken-4" target="_blank"><i
                    class="fas fa-file-pdf"></i>
                Plain File</a> |
            <a href="/loan/schedule/printpdf/{{$loan->id}}" class=" btn pink darken-4" target="_blank"><i
                    class="fas fa-file-pdf"></i>
                PDF</a>
        </p>
    </div>
    <div class="row">
        <div class="col s12">
            <table class="highlight">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>DATE</th>
                        <th>NAME</th>
                        <th>PRODUCT</th>
                        <th>REPYMT</th>
                        <th>AMNT</th>
                        <th>BAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{1}}</td>
                        <td>{{$loan->loan_start_date->toFormattedDateString()}}</td>
                        <td>{{$loan->user->first_name}} {{$loan->user->last_name}}</td>
                        <td>{{$loan->product->name}}</td>
                        <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
                        <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
                        <td>{{number_format($loan->amount_approved - $loan->monthly_deduction,2,'.',',')}}
                        </td>
                    </tr>
                    @for($i=2; $i<=$loan->custom_tenor; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$loan->loan_start_date->addMonths($i-1)->toFormattedDateString()}}
                            </td>
                            <td>{{$loan->user->first_name}} {{$loan->user->last_name}}</td>
                            <td>{{$loan->product->name}}</td>
                            <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
                            <td>{{number_format($loan->monthly_deduction*$i,2,'.',',')}}</td>
                            <td>{{number_format($loan->amount_approved-$loan->monthly_deduction*$i,2,'.',',')}}
                            </td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection