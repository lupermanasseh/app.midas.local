@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">FILTERED MEMBERS</h6>
        </div>
    </div>

    @if (count($members)>=1)
    <div class="row">
        <div class="col s12">
            <span>
                <a class="btn-small purple lighten-1" href="/members/{{$status}}/{{$end_date}}/{{$cadre}}"><i
                        class="fas fa-file-excel"></i>
                    DOWNLOAD</a>
            </span>
            <p>{{count($members)}} Available</p>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col s12">
            @if (count($members)>=1)
            @include('Registration.display') {{$members->links()}}@else
            <p>No active records yet</p>
            @endif
        </div>
    </div>
</div>
@endsection