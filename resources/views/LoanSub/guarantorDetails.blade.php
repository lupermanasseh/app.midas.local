@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">GUARANTOR DETAIL</span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/guarantor/dashboard"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Back">arrow_back</i></a></span>
        </div>
    </div>

    <div class="row user-profiles">
        <div class="col s12 m12 l12 profile">
            <p class="profile__heading text-grey darken-3">GUARANTOR</p>
            <!-- <span><i class="small material-icons pink-text lighten-4">looks</i></span> -->
            <span>
              @if($newUser->imageCount($newUser->id)===0)
              <img src="/images/logo.png" class="guarantor_photo"/>
                  @else
                  <img src="{{$newUser->photo}}" alt="" class="guarantor_photo">
                  @endif
            </span>
            <span class="profile__user-name"><a href="/user/page/{{$newUser->id}}">{{$newUser->first_name}}
                    {{$newUser->last_name}}</a></span>
            <span class="profile__user-name">{{$newUser->payment_number}}</span>
            <span class="profile__user-name">TOTAL CONTR
                {{number_format($newUser->totalSavings($newUser->id),2,'.',',')}}</span>
            <span class="profile__user-name">MNTH SAVE
                {{number_format($newUser->monthlySaving($newUser->id),2,'.',',')}}</span>
        </div>

        <!-- <div class="col s12 m6 l6 profile">
            <p class="profile__heading text-grey darken-3">INDEBTEDNESS</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name">Deductions <a href="/loanDeduction/history/{{$newUser->id}}">
              </a></span>
            <span class="profile__user-name">Repayment =N=
                </span>
            <span class="profile__user-name">Balance
                </span>
        </div> -->

    </div>


    <div class="row user-profiles">
        <div class="col s12 m9 l9 profile-detail">

                <p class="profile__heading text-grey darken-3">Loans Guaranteed</p>



                <table class="highlight">
                    <thead>
                        <tr>
                            <th>REG</th>
                            <th>MEMBER</th>
                            <TH>PRODUCT</TH>
                            <TH>LOAN BAL</TH>
                            <TH>LIABILITY</TH>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($firstGuarantor as $firstg)
                        <tr>
                            <td>{{substr($firstg->user->membership_type,0,1)}}/{{$firstg->user_id}}</td>
                            <td>{{$firstg->user->first_name}} {{$firstg->user->last_name}}</td>
                            <td>{{$firstg->product->name}}</td>
                            <td>{{number_format($firstg->user->singleLoanBalance($firstg->id),2,'.',',')}}</td>
                            <td>{{number_format($firstg->user->singleLoanBalance($firstg->id)/2,2,'.',',')}}</td>
                            <td>{{$firstg->loan_status}}
                            </td>
                        </tr>
                        @endforeach
                        @foreach($secondGuarantor as $secondg)
                          <tr>
                              <td>{{substr($secondg->user->membership_type,0,1)}}/{{$secondg->user_id}}</td>
                              <td>{{$secondg->user->first_name}} {{$secondg->user->last_name}}</td>
                              <td>{{$secondg->product->name}}</td>
                              <td>{{number_format($secondg->user->singleLoanBalance($secondg->id),2,'.',',')}}</td>
                              <td>{{number_format($secondg->user->singleLoanBalance($secondg->id)/2,2,'.',',')}}</td>
                              <td>{{$secondg->loan_status}}
                              </td>
                          </tr>
                          @endforeach
                          @if(count($firstGuarantor)>=1 OR count($secondGuarantor)>=1 )
                          <tr>
                              <th colspan="3">Summary</th>

                              <th>{{number_format($newSubObj->totalLiability($newUser->id),2,'.',',')}}</th>
                              <th>{{number_format($newSubObj->totalLiability($newUser->id)*0.5,2,'.',',')}}</th>
                          </tr>
                          @else
                          @endif
                    </tbody>
                </table>

        </div>
    </div>
</div>
@endsection
