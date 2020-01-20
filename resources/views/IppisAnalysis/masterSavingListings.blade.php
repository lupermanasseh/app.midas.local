@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">RECENT MASTER SAVINS DEDUCTION(s)</h6>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($savingMaster)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>NAME</th>
                        <th>IPPIS</th>
                        <th>SAVING</th>
                        <th>TS</th>
                        <th>TOTAL</th>
                        <th>CREATED</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($savingMaster as $myItem)
                    <tr>
                        <td>{{$myItem->entry_date->toFormattedDateString()}}</td>
                        <td>{{$myItem->name}}</td>
                        <td>{{$myItem->ippis_no}}</td>
                        <td>{{number_format($myItem->saving_cumulative,2,'.',',')}}</td>
                        <td>{{number_format($myItem->ts_cumulative,2,'.',',')}}</td>
                        <td>{{number_format($myItem->total,2,'.',',')}}</td>
                        <td>{{$myItem->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="/saving/distribute/{{$myItem->id}}" class="btn green darken-3 post-looan">Post
                                Saving</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$savingMaster->links()}}
            @else
            <p>No Records Available</p>
            @endif
        </div>
    </div>
</div>
@endsection