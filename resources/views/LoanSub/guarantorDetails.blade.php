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
      @if($firstGuarantor->count()>=1)
        <div class="col s12 m9 l9 profile-detail">

                <p class="profile__heading text-grey darken-3">First Loan Guaranteed</p>



                <table class="highlight">
                    <thead>
                        <tr>
                            <th>LOANEE</th>
                            <th>PRODUCT</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($firstGuarantor as $firstg)
                        <tr>
                            <td>{{$firstg->user->first_name}} {{$firstg->user->last_name}}</td>
                            <td>{{$firstg->product->name}}</td>
                            <td>{{$firstg->loan_status}}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

        </div>
        @else
        <span>You have not guaranteed any loan as a first guarantor</sapn>
        @endif

    </div>

    <div class="row user-profiles">
      @if($secondGuarantor->count()>=1)

        <div class="col s12 m9 l9 profile-detail">

                <p class="profile__heading text-grey darken-3">Second Loan Guaranteed</p>



                <table class="highlight">
                    <thead>
                        <tr>
                            <th>LOANEE</th>
                            <th>PRODUCT</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($secondGuarantor as $secondg)
                        <tr>
                            <td>{{$secondg->user->first_name}} {{$secondg->user->last_name}}</td>
                            <td>{{$secondg->product->name}}</td>
                            <td>{{$secondg->loan_status}}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

        </div>
        @else
        <span>You have not guaranteed any loan as a second guarantor</sapn>
        @endif

    </div>

</div>
@endsection
