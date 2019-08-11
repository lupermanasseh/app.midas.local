@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">AUDITED LOANS</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($auditedLoans)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Amount Req</th>
                        <th>Amount Rev</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auditedLoans as $pending)
                    <tr>

                        <td><a href="/user/page/{{$pending->user_id}}">{{$pending->user->first_name}}
                                {{$pending->user->last_name}}</a></td>
                        <td>{{$pending->product->name}}</td>
                        <td>{{number_format($pending->amount_applied,2,'.',',')}}</td>
                        <td>{{number_format($pending->amount_approved,2,'.',',')}}</td>
                        <td>{{$pending->loan_status}}</td>
                        <td>{{$pending->review_comment}}</td>
                        {{-- <td>{{$pending->created_at->toFormattedDateString()}}</td> --}}
                        <td><a href="/approve/loans/{{$pending->id}}"
                                class="btn green darken-3 approve-loan">Approve</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$auditedLoans->links()}} @else
            <p>No audited loan applications yet</p>
            @endif
        </div>
    </div>
</div>
@endsection