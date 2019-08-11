@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12">
            <h6 class="teal-text">SAVING WITHDRAWAL FORM</h6>
        </div>

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