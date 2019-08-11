@extends('Layouts.admin-app')


@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">LOAN HISTORY</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($loanHistory)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loanHistory as $item)
                    <tr>
                        <td>{{$item->entry_month->toFormattedDateString()}}</td>
                        <td><a href="/user/page/{{$item->user_id}}">{{$item->user->first_name}}</a></td>
                        <td>{{$item->product->name}}</td>
                        <td>{{number_format($item->amount_deducted,2,'.',',')}}</td>
                        <td>{{$item->notes}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$loanHistory->links()}} @else
            <p>No deduction(s) yet</p> --}}
            @endif
        </div>
    </div>
</div>
@endsection