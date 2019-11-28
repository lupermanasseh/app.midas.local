@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s6">
            <h5 class="teal-text">All Next of Kin | </h5>
            <div class="divider"></div>
        </div>

    </div>

    <div class="row">
        <div class="col s12">
            @if (count($users)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Next Of Kin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->first_name}} {{$user->last_name}}</td>

                        <td>{{$user->nok->first_name}} {{$user->nok->last_name}}</td>
                        {{-- <td><a class="waves-effect waves-light btn-small  blue darken-1"
                                href="/userNokEdit/{{$user->nok->id}}"><i class="material-icons tiny">mode_edit</i></a>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$users->links()}} @else
            <p>No Record Yet</p>
            @endif
        </div>
    </div>

</div>
@endsection