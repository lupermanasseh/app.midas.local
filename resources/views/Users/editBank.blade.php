@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">EDIT NOK DETAILS</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/userDetails/{{$bank->user->id}}"><i class="small material-icons tooltipped"
                        data-position="bottom" data-tooltip="Back To User Deatils">arrow_back</i></a></span>
        </div>
    </div>
    <div class="row">

        <form class="col s12" method="POST" action="/updateBank/{{$bank->id}}">
            {{ csrf_field() }} {{--
            <div class="row">

                <div class="input-field col s6">
                    <input id="payment_number" name="payment_number" type="text" class="validate" required>
                    <label for="payment_number">Payment Number</label>
                </div>

            </div> --}}

            <div class="row">
                {{-- <div class="input-field col s12 m4 l4"> --}}
                    {{-- <input id="bank_name" name="bank_name" value="{{$bank->bank_name}}" type="text" class="validate"
                        required>
                    <label for="bank_name">Bank Name</label> --}}
                    <div class="input-field col s12 m4 l4">
                        <select id="bank_name" name="bank_name">
                            <option value="{{$bank->bank_name}}" selected>{{$bank->bank_name}}</option>
                            <option value="Access Bank">Access Bank</option>
                            <option value="Eco Bank">Eco Bank</option>
                            <option value="First Bank">First Bank</option>
                            <option value="Fidelity Bank">Fidelity Bank</option>
                            <option value="FCMB">FCMB</option>
                            <option value="GT Bank">GT Bank</option>
                            <option value="Keystone Bank">Keystone Bank</option>
                            <option value="Polaris Bank">Polaris Bank</option>
                            <option value="Sterling Bank">Sterling Bank</option>
                            <option value="Stanbic IBTC">Stanbic IBTC</option>
                            <option value="Unity Bank">Unity Bank</option>
                            <option value="Union Bank">Union Bank</option>
                            <option value="UBA">UBA</option>
                            <option value="Heritage Bank">Heritage Bank</option>
                            <option value="Zenith Bank">Zenith Bank</option>
                        </select>
                        <label>Choose Bank</label>
                    </div>
                {{-- </div> --}}

                {{-- <div class="input-field col s4">
                    <input id="bank_branch" name="bank_branch" value="{{$bank->bank_branch}}" type="text"
                class="validate" required>
                <label for="bank_branch">Bank Branch</label>
            </div> --}}

            <div class="input-field col s12 m4 l4">
                <input id="acct_number" name="acct_number" value="{{$bank->acct_number}}" type="text" class="validate"
                    required>
                <label for="acct_number">Account Number</label>
            </div>

            <div class="input-field col s12 m4 l4">
                <input id="sort_code" name="sort_code" value="{{$bank->sort_code}}" type="text" class="validate"
                    required>
                <label for="sort_code">Sort Code</label>
            </div>
    </div>

    <div class="row">
        {{-- <div class="input-field col s6">
                    <input id="acct_name" name="acct_name" value="{{$bank->acct_name}}" type="text" class="validate">
        <label for="acct_name">Account Name</label>
    </div> --}}
</div>
<button type="submit" class="btn">Update Bank Details</button>
</form>
</div>
</div>
@endsection
