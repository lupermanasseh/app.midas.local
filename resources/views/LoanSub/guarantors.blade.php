@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">LOAN GUARANTORS</span>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/pendingLoans"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Pending Loans">view_list</i></a></span>
        </div>
    </div> -->

    <div class="row user-profiles">
        @foreach($uniqueGuarantors as $guarantor)
        <div class="col s12 m3 l3 profile">
          <p class="profile__heading text-grey darken-3">REG: {{$guarantor}}</p>
            <p class="profile__heading text-grey darken-3">{{$review->user->userInstance($guarantor)->first_name}} {{$review->user->userInstance($guarantor)->last_name}}</p>
            <!-- <span><i class="small material-icons pink-text lighten-4">looks</i></span> -->
            <span>
              {{number_format($review->totalLiability($guarantor)*0.5,2,'.',',')}}
            </span>
            <!-- <span>
              @if($review->imageCount($guarantor)===0)
              <img src="/images/logo.png" class="guarantor_photo"/>
                  @else
                  <img src="{{$review->user->userInstance($guarantor)->photo}}" alt="" class="guarantor_photo">
                  @endif
            </span> -->
            <span class="profile__user-name">
              Total Loans Guaranteed
            </span>
            <span class="profile__user-name">
              <a  class="guarantor_count" href="/guarantor/Details/{{$guarantor}}">{{$review->loanGuarantorCount($guarantor)}}</a>
            </span>
        </div>
        @endforeach


    </div>
</div>
@endsection
