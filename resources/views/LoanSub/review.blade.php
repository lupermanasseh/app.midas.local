@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">REVIEW LOAN</span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/pendingLoans"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Pending Loans">view_list</i></a></span>
        </div>
    </div>

    <div class="row user-profiles">
        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">SAVING DETAILS</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name">{{$review->user->payment_number}}</span>
            <span class="profile__user-name">{{$review->user->first_name}} {{$review->user->last_name}}</span>
            <span class="profile__user-name">TOTAL CONTR
                <a
                    href="/saving/listings/{{$review->user_id}}">{{number_format($review->user->totalSavings($review->user_id),2,'.',',')}}</a></span>
            <span class="profile__user-name">MNTH SAVE
                {{number_format($review->user->monthlySaving($review->user_id),2,'.',',')}}</span>
        </div>

        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">PRODUCT</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name">{{$review->product->name}}</span>
            <span class="profile__user-name">Tenor {{$review->product->tenor}} [ {{$review->custom_tenor}} ]</span>
            <span class="profile__user-name">REQ .3%
                {{number_format($review->user->requiredPercent($review->amount_applied),2,'.',',')}}</span>
            <span class="profile__user-name">AVAIL %
                {{number_format($review->user->availablePercent($review->user_id),2,'.',',')}}</span>
        </div>
        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">PRODUCT SUMMARY</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name">Guarantor 1:
              @if($review->guarantor_id1)
              {{$review->user->userInstance($review->guarantor_id1)->first_name}} (<a
              href="/#">{{$review->loanGuarantorCount($review->guarantor_id1)}}</a>)
              @else
              NA
              @endif

            </span>
            <span class="profile__user-name">Guarantor 2:
              @if($review->guarantor_id2)
              {{$review->user->userInstance($review->guarantor_id2)->first_name}} (<a
              href="/#">{{$review->loanGuarantorCount($review->guarantor_id2)}}</a>)
              @else
              NA
              @endif

            </span>
            <span class="profile__user-name">Repayment N {{number_format($review->monthly_deduction,2,'.',',')}}</span>
            <span class="profile__user-name"><a href="/userLoan/discard/{{$review->id}}">Not sure, remove</a></span>
        </div>

        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">STATUS</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name">{{$review->loan_status}}</span>
            <span class="profile__user-name">Active Loans <a
                    href="/user/page/{{$review->user_id}}">{{$review->user->activeLoans($review->user_id)}}</a></span>
            <span class="profile__user-name">Net Pay N {{number_format($review->net_pay,2,'.',',')}}</span>
        </div>


    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/userLoan/reviewStore/{{$review->id}}">
            {{ csrf_field() }}

            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <input id="amount_applied" name="amount_applied" type="text"
                        value="{{number_format($review->amount_applied,2,'.',',')}}" class="validate" disabled>
                    <label for="amount_applied">Amount Applied</label>
                </div>

                <div class="input-field col s12 m6 l6">
                    <input id="amount_approved" name="amount_approved" value="{{$review->amount_applied}}" type="number"
                        class="validate" required>
                    <label for="amount_approved">Amount Approved</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <input id="review_date" name="review_date" type="text" class="validate datepicker" required>
                    <label for="review_date">Review Date</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <select id="notes" name="notes">
                        <option value="Recommended">Recommended</option>
                        <option value="Queue">Queue</option>
                        <option value="Decline">Decline</option>
                        <option value="Undecided">Undecided</option>
                    </select>
                    <label>Review Notes</label>
                </div>
            </div>

            <button type="submit" class="btn">Review Loan</button>
        </form>
    </div>
</div>
@endsection
