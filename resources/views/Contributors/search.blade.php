@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12">
            <h6 class="teal-text">SEARCH SAVINGS</h6>
        </div>

        <form class="col s12" method="POST" action="/saving/search/process">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <input id="from" name="from" type="text" class="validate datepicker" required>
                    <label for="from">From</label>
                </div>

                <div class="input-field col s12 m6 l6">
                    <input id="to" name="to" type="text" class="validate datepicker" required>
                    <label for="to">To</label>
                </div>

            </div>

            <button type="submit" class="btn">search</button>
        </form>
    </div>
</div>
@endsection