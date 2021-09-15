@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">EDIT NOK DETAILS</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/userDetails/{{$nok->user->id}}"><i class="small material-icons tooltipped"
                        data-position="bottom" data-tooltip="Back To User Deatils">arrow_back</i></a></span>
        </div>
    </div>
    <div class="row">

        <form class="col s12" method="POST" action="/updateNok/{{$nok->id}}">
            {{ csrf_field() }}

            <div class="row">
                <div class="input-field col s4">
                    <select id="title" name="title">
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Miss">Miss</option>
                        <option value="Dr">Dr</option>
                    </select>
                    <label>Title</label>
                </div>

                <div class="input-field col s4">
                    <select id="sex" name="sex">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label>Gender</label>
                </div>
                <div class="input-field col s4">
                    <select id="relationship" name="relationship">
                        <option value="Spouse">Spouse</option>
                        <option value="Child">Child</option>
                        <option value="Brother">Brother</option>
                        <option value="Sister">Sister</option>
                        <option value="Niece">Niece</option>
                        <option value="Cousine">Cousine</option>
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                    </select>
                    <label>Relationship</label>
                </div>
            </div>

            <div class="row">


                <div class="input-field col s4">
                    <input id="first_name" name="first_name" value="{{$nok->first_name}}" type="text" class="validate"
                        required>
                    <label for="first_name">Surname</label>
                </div>

                <div class="input-field col s4">
                    <input id="last_name" name="last_name" value="{{$nok->last_name}}" type="text" class="validate"
                        required>
                    <label for="last_name">First Name</label>
                </div>
                <div class="input-field col s4">
                    <input id="other_name" name="other_name" value="{{$nok->other_name}}" type="text">
                    <label for="other_name">Other name</label>
                </div>

            </div>

            <div class="row">

                <div class="input-field col s6">
                    <input id="email" name="email" value="{{$nok->email}}" type="text" class="validate">
                    <label for="email">Email</label>
                </div>

                <div class="input-field col s6">
                    <input id="phone" name="phone" value="{{$nok->phone}}" type="text" class="validate" required>
                    <label for="phone">Phone</label>
                </div>

            </div>

            <button type="submit" class="btn">Update NOK</button>
        </form>
    </div>
</div>
@endsection
