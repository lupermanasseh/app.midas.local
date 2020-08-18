@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12">
            <h6 class="teal-text">FIND LOAN BALANCES</h6>
        </div>

        <form class="col s12" method="POST" action="/loanbalances/find">
            {{ csrf_field() }}
            <div class="row">

                 <!-- <div class="input-field col s12 m4 l4">
                    <input id="reg_number" name="reg_number" type="text" placeholder="e.g 78" class="validate" required>
                    <label for="reg_number">Registration Number</label>
                </div>  -->
                <div class="input-field col s12 m6 l6">
                    <input id="from" name="from" type="date" class="validate" required>
                    <label for="from">Start Date</label>
                </div>

                <div class="input-field col s12 m6 l6">
                    <input id="to" name="to" type="date" class="validate" required>
                    <label for="to">End Date</label>
                </div>

            </div>

            <button type="submit" class="btn">Find</button>
        </form>
    </div>
</div>
@endsection
