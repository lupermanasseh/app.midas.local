@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">RECENT PRODUCT DEDUCTION</h6>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="New Loan Subscription">playlist_add</i></a></span>
            <span><a href="/saving/search"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Search Savings">search</i></a></span>

            <span><a href="{{route('prod-deductions.upload')}}"><i class="small material-icons tooltipped"
                        data-position="bottom" data-tooltip="New Savings Upload">cloud_upload</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($recent)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Entry Date</th>
                        <th>Created At</th>
                        <th>Edit</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recent as $item)
                    <tr>
                        <td><a href="/user/page/{{$item->user->id}}">{{$item->user->first_name}}
                                {{$item->user->last_name}}</a></td>
                        <td>{{$item->product->name}}</td>
                        <td><a
                                href="/productDeduction/detail/{{$item->id}}">{{number_format($item->monthly_deduction,2,'.',',')}}</a>
                        </td>
                        <td>{{$item->entry_date->toDateString()}}</td>
                        <td>{{$item->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="/productDeduction/edit/{{$item->id}}"><i class="small material-icons">edit</i> </a>
                        </td>
                        <td>
                            <a href="/productDeduction/remove/{{$item->id}}" id="delete"> <i
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