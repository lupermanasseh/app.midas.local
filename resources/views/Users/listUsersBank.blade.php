@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s6">
            <h5 class="teal-text">All Bank Details | </h5>
            <div class="divider"></div>
        </div>

    </div>

    <div class="row">
        <div class="col s12">
            @if (count($users)>=1)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Surname</th>
                        <th>Last Name</th>
                        <th>Bank</th>
                        <th>Acct Number</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->bank->bank_name}}</td>
                        <td>{{$user->bank->acct_number}}</td>
                        {{-- <td><a class="waves-effect waves-light btn-small  blue darken-1"
                                href="/userBankEdit/{{$user->bank->id}}"><i
                            class="material-icons tiny">mode_edit</i></a></td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$users->links()}} @else
            <p>No Records Yet</p>
            @endif
        </div>
    </div>

</div>
@endsection