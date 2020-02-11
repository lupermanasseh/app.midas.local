@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">SAVING UPLOAD SUMMARY</h6>
        </div>
    </div>

    <div class="row">
        <div class="col s12 subject-header">
            <button data-target="modal1" class="btn modal-trigger">Find Master Saving</button>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if (count($masterRecords)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>SAVING TOTAL</th>
                        <th>POST</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($masterRecords as $myItem)
                    <tr>
                        <td>
                            <a href="/savingMaster/listing/{{$myItem->entry_date}}">
                                {{$myItem->entry_date->toFormattedDateString()}}
                            </a>
                        </td>
                        <td>{{number_format($myItem->saving,2,'.',',')}}</td>
                        <td>
                            <a href="/saving/distribute/{{$myItem->entry_date}}">POST</a>
                        </td>
                        <td>
                            <a href="/delete/savings/{{$myItem->entry_date}}">DELETE</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$masterRecords->links()}} --}}
            @else
            <p>No Records Available</p>
            @endif
        </div>
    </div>
</div>


{{-- Modal Structure --}}
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>
@endsection