@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">RECENT LOAN DEDUCTION(s)</h6>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($recent)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>NAME</th>
                        <th>PRODUCT</th>
                        <th>AMOUNT</th>
                        <TH>CREATED</TH>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recent as $item)
                    <tr>
                        <td>{{$item->entry_month->toFormattedDateString()}}</td>
                        <td><a href="/user/page/{{$item->user->id}}">{{$item->user->first_name}}
                                {{$item->user->last_name}}</a></td>
                        <td>{{$item->product->name}}</td>
                        <td>{{number_format($item->amount_deducted,2,'.',',')}}</td>
                        <td>{{$item->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="/loanDeduction/edit/{{$item->id}}"><i class="small material-icons">edit</i> </a> <a
                                href="/loanDeduction/remove/{{$item->id}}" id="delete"> <i
                                    class="small material-icons red-text">delete</i></a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$recent->links()}} @else
            <p>No Records Available</p>
            @endif
        </div>
    </div>
</div>
@endsection