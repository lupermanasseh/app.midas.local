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

                <div class="input-field col s12 m12 l12">
                    <input id="to" name="to" type="text" class="validate datepicker" required>
                    <label for="to">End Date</label>
                </div>

            </div>

            <button type="submit" class="btn">Find</button>
        </form>
    </div>
</div>
@endsection
