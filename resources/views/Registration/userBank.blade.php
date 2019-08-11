@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s5">
            <h5 class="teal-text">User Bank Details</h5>
        </div>

        <form class="col s12" method="POST" action="/bankStore">
            {{ csrf_field() }}
            <div class="row">

                <div class="input-field col s6">
                    <input id="user_id" name="user_id" value="{{$id}}" type="hidden" class="validate" required>
                </div>

            </div>

            <div class="row">
                <div class="input-field col s4">
                    <input id="bank_name" name="bank_name" type="text" class="validate" required>
                    <label for="bank_name">Bank Name</label>
                </div>

                <div class="input-field col s4">
                    <input id="bank_branch" name="bank_branch" type="text" class="validate" required>
                    <label for="bank_branch">Bank Branch</label>
                </div>
                <div class="input-field col s4">
                    <input id="sort_code" name="sort_code" type="text" class="validate" required>
                    <label for="sort_code">Sort Code</label>
                </div>
            </div>

            <div class="row">

                <div class="input-field col s6">
                    <input id="acct_name" name="acct_name" type="text" class="validate">
                    <label for="acct_name">Account Name</label>
                </div>

                <div class="input-field col s6">
                    <input id="acct_number" name="acct_number" type="text" class="validate" required>
                    <label for="acct_number">Account Number</label>
                </div>

            </div>



            <button type="submit" class="btn">Save Bank Details</button>
        </form>
    </div>
</div>
@endsection