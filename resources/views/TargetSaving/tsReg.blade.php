@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12">
            <h6 class="teal-text">CREATE/REVIEW TS-SAVING</h6>
        </div>

        <form class="col s12" method="POST" action="/new/ts/store">
            {{ csrf_field() }}
            <div class="row">

                <div class="input-field col s12 m4 l4">
                    <input id="user_id" name="user_id" type="hidden" value={{$userid}} class="validate" required>
                    <input id="amount" name="amount" type="text" class="validate" required>
                    <label for="amount">Amount</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="start_date" name="start_date" type="text" class="validate datepicker" required>
                    <label for="start_date">Start Date</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="end_date" name="end_date" type="text" class="validate datepicker" required>
                    <label for="end_date">End Date</label>
                </div>
            </div>

            <button type="submit" class="btn">Register TS</button>
        </form>
    </div>
</div>
@endsection