@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">SAVING RECORDS</p>

        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($recentUploads)>=1)
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
                    @foreach ($recentUploads as $myItem)
                    <tr>
                        <td>{{$myItem->entry_date->toFormattedDateString()}}</td>
                        <td><a href="/user/page/{{$myItem->user->id}}">{{$myItem->user->first_name}}
                                {{$myItem->user->last_name}}</a></td>
                        <td>{{number_format($myItem->amount_saved,2,'.',',')}}</td>
                        <td>{{number_format($myItem->amount_withdrawn,2,'.',',')}}</td>
                        <td>
                            <a href="/saving/edit/{{$myItem->id}}"><i class="small material-icons">edit</i> </a> <a
                                href="/saving/remove/{{$myItem->id}}" id="delete"> <i
                                    class="small material-icons red-text">delete</i></a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$recentUploads->links()}} @else
            <p>No Records Available</p>
            @endif
        </div>
    </div>
</div>
@endsection