@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">FILTER LOAN DEDUCTION</h6>
        </div>
    </div>

    <div class="row">

        <form class="col s12" method="POST" action="/loan/filterResult">
            {{ csrf_field() }}
            <div class="row">

            </div>
            <div class="row">

                {{-- <div class="input-field col s12 m4 l4">
                    <select id="payment_type" name="payment_type">
                        <option value="IPPIS">IPPIS</option>
                        <option value="GIFMIS">GIFMIS</option>
                    </select>
                    <label>Payment Type</label>
                </div> --}}

                <div class="input-field col s12 m6 l6">
                    <input id="start_date" name="start_date" type="text" class="validate datepicker" required>
                    <label for="start_date">Start Date</label>
                </div>

                <div class="input-field col s12 m6 l6">
                    <input id="end_date" name="end_date" type="text" class="validate datepicker" required>
                    <label for="end_date">End Date</label>
                </div>

            </div>
            <button type="submit" class="btn red darken-1">Filter</button>

        </form>
    </div>

</div>
@endsection