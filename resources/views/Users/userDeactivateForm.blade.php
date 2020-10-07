@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">DEACTIVATE USER</span>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/loan/overdeduction"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Loan Overdeduction List">view_list</i></a></span>
        </div>
    </div> -->

    <!-- <div class="row user-profiles">
        <div class="col s12 m12 l12 profile">
            <p class="profile__heading text-grey darken-3">PROFILE</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name"></span>
            <span class="profile__user-name"></span>
            <span class="profile__user-name">TOTAL CONTR
                <a
                    href="/saving/listings/"></a></span>
            <span class="profile__user-name">MNTH SAVE
                </span>
        </div>
    </div> -->


    <div class="row">
        <form class="col s12" method="POST" action="/deactivateUser">
            {{ csrf_field() }}

            <div class="row">

                <div class="input-field col s12 m6 l6">
                    <input id="user_id" name="user_id" type="hidden" value="{{$user_id}}" class="validate">
                    <input id="reason" name="reason" value="" type="text"
                        class="validate" required>
                    <label for="reason">Reason</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="_date" name="_date" value="" type="text" class="validate datepicker" required>
                    <label for="_date">Date</label>
                </div>
            </div>

            <button type="submit" class="btn">Deactivate</button>
        </form>
    </div>
</div>
@endsection
