@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
      <div class="col s12">
          <h6 class="teal-text">SAVING WITHDRAWAL FORM</h6>
      </div>
    </div>

    <div class="row user-profiles">

        <div class="col s12 m12 l12 profile">
            <p class="profile__heading text-grey darken-3">PROFILE</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name">{{$user->payment_number}}</span>
            <span class="profile__user-name">{{$user->first_name}} {{$user->last_name}}</span>
            <span class="profile__user-name">TOTAL CONTR
                <a
                    href="/saving/listings/{{$user->id}}">{{number_format($user->totalSavings($user->id),2,'.',',')}}</a></span>
            <span class="profile__user-name">MNTH SAVE
                {{number_format($user->monthlySaving($user->id),2,'.',',')}}</span>
        </div>
    </div>
    <div class="row">

        <form class="col s12" method="POST" action="/saving/withdraw/store">
            {{ csrf_field() }}
            <div class="row">

                <div class="input-field col s12 m4 l4">
                    <input id="user_id" name="user_id" type="hidden" value={{$userid}} class="validate" required>
                    <input id="amount" name="amount" type="text" class="validate" required>
                    <label for="amount">Amount</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="date" name="date" type="text" class="validate datepicker" required>
                    <label for="date">Date</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="notes" name="notes" type="text" class="validate" required>
                    <label for="notes">Description</label>
                </div>
            </div>

            <button type="submit" class="btn">withdraw now</button>
        </form>
    </div>
</div>
@endsection
