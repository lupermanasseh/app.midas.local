@extends('Layouts.admin-app') 
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">NEW LOAN PRODUCT</span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/loanProducts"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All Loan Products">view_list</i></a></span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/loanProduct/store">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12">
                    <input id="loan_name" name="loan_name" type="text" class="validate" required>
                    <label for="loan_name">Loan Name</label>
                </div>

                <div class="input-field col s12">
                    <select id="tenor" name="tenor">
                        <option value="6">6 Months</option>
                        <option value="12">1 Year</option>
                        <option value="24">2 Years</option>
                        <option value="36">3 Years</option>
                        <option value="48">4 Years</option>
                        <option value="60">5 Years</option>
                    </select>
                    <label>Tenor</label>
                </div>

                <div class="input-field col s12">
                    <select id="interest" name="interest">
                            <option value="0.05">5%</option>
                            <option value="0.1">10%</option>
                            <option value="0.075">7.5%</option>
                            <option value="0.15">15%</option>
                        </select>
                    <label>Interest</label>
                </div>
            </div>

            <button type="submit" class="btn">Save</button>
        </form>
    </div>
</div>
@endsection