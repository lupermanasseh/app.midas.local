@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">EDIT CONSOLIDATED LOAN DEDUCTION</h6>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a class="btn" href="/user/landingPage/{{$deduction->user_id}}"><i class="tiny material-icons tooltipped" data-position="bottom"
                        data-tooltip="Go Back">arrow_back</i></a></span>

        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/consolidatedLoanDeduction/update/{{$deduction->id}}">
            {{ csrf_field() }}

<div class="row">

<div class="input-field col s12 m6 l6">
    @if($deduction->credit)
    <input id="credit" name="credit" value="{{number_format($deduction->credit,2,'.','')}}"
    type="number" step="0.01" class="validate">
    <label for="credit">Credit</label>
    @else
    <input disabled id="credit" name="credit" value=""
    type="number" step="0.01" class="validate">
    <label for="credit">Credit</label>
    @endif
</div>


<div class="input-field col s12 m6 l6">
    @if($deduction->debit)
    <input id="debit" name="debit" value="{{number_format($deduction->debit,2,'.','')}}"
    type="number" class="validate">
    <label for="debit">Debit</label>
    @else
    <input disabled id="debit" name="debit" value=""
    type="number" class="validate">
    <label for="debit">Debit</label>
    @endif
</div>

</div>
<div class="row">
    <div class="input-field col s12 m6 l6">
        <input id="description" name="description" value="{{$deduction->description}}" type="text">
        <label for="description">Description</label>
    </div>

    <div class="input-field col s12 m6 l6">
        <input id="entry_date" name="entry_date" value="{{$deduction->date_entry->toDateString()}}" type="date"
            class="validate">
        <label for="entry_date">Date</label>
    </div>

</div>
<button type="submit" class="btn">Save</button>
</form>
</div>
</div>
@endsection
