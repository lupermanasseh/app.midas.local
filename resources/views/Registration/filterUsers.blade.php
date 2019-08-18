@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">FILTER USERS</h6>
        </div>
    </div>

    <div class="row">

        <form class="col s12" method="POST" action="/filter/users/process">
            {{ csrf_field() }}
            <div class="row">

            </div>
            <div class="row">


                {{-- <div class="input-field col s12 m6 l6">
                    <input id="start_date" name="start_date" type="date" class="validate" required>
                    <label for="start_date">Start Date</label>
                </div> --}}

                <div class="input-field col s12 m4 l4">
                    <input id="end_date" name="end_date" type="date" class="validate" required>
                    <label for="end_date">As At</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <select id="status" name="status">
                        <option value="All">All</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <label>Status</label>
                </div>


                <div class="input-field col s12 m4 l4">
                    <select id="cadre" name="cadre">
                        <option value="All">All</option>
                        <option value="Senior">Senior</option>
                        <option value="Junior">Junior</option>
                        <option value="Retired">Retired</option>
                    </select>
                    <label>Cadre</label>
                </div>


            </div>
            <button type="submit" class="btn red darken-1">Filter</button>

        </form>
    </div>

</div>
@endsection