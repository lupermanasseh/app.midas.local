@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">SAVING SEARCH RESULT</p>

        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($result)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $item)
                    <tr>
                        <td>{{$item->entry_date->toFormattedDateString()}}</td>
                        <td><a href="/user/page/{{$item->user->id}}">{{$item->user->first_name}}
                                {{$item->user->last_name}}</a></td>
                        <td>{{number_format($item->amount_saved,2,'.',',')}}</td>
                        <td>{{number_format($item->amount_withdrawn,2,'.',',')}}</td>
                        <td>
                            <a href="/saving/edit/{{$item->id}}"><i class="small material-icons">edit</i> </a> <a
                                href="/saving/remove/{{$item->id}}" id="delete"> <i
                                    class="small material-icons red-text">delete</i></a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$result->links()}} @else
            <p>No Records Available</p>
            @endif
        </div>
    </div>
</div>
@endsection