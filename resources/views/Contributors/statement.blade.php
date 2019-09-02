@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12">
            <h6 class="teal-text">FIND STATEMENT OF SAVINGS</h6>
        </div>

        <form class="col s12" method="POST" action="/saving/statement/process">
            {{ csrf_field() }}
            <div class="row">

                <div class="input-field col s12 m4 l4">
                    <input id="reg_number" name="reg_number" type="text" placeholder="e.g 78" class="validate" required>
                    <label for="reg_number">Registration Number</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="from" name="from" type="date" class="validate" required>
                    <label for="from">From</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="to" name="to" type="date" class="validate" required>
                    <label for="to">To</label>
                </div>

            </div>

            <button type="submit" class="btn">Find</button>
        </form>
    </div>
</div>
@endsection