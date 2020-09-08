@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12">
            <h6 class="teal-text">LOAN BY DISBURSEMENT DATE</h6>
        </div>

        <form class="col s12" method="POST" action="/loandisbursement/result">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12 m12 l12">
                    <input id="disbursement_date" name="disbursement_date" type="text" class="validate datepicker">
                    <label for="disbursement_date">Enter Date</label>
                </div>
            </div>

            <button type="submit" class="btn">Find</button>
        </form>
    </div>
</div>
@endsection
