@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">USER DETAILS</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/user/all"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Users">group</i></a></span>
            <span><a href="/New"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Create User">person_add</i></a></span>
        </div>
    </div>

    <div class="row user-profiles">
        <div class="col s12 m3 l3 profile">
            {{-- <img src="{{asset('images/andy.jpg')}}" alt="" class="circle"> --}}
            <p class="profile__heading text-grey darken-3">Personal Details</p>

            <img src="{{$profile->photo}}" alt="" class="profile__photo">
            <span><a href="/photo/{{$profile->id}}" class="pink-text darken-2">Edit Photo</a></span>


            {{-- <img src="{{url('images/girl-1.png')}}" alt="" class="profile__photo">
            <span><a href="/photo/{{$profile->id}}" class="pink-text darken-2">Choose Photo</a></span> --}}


            <span class="profile__user-name">{{$profile->title}}</span>
            <span class="profile__user-name">{{$profile->first_name}} {{$profile->last_name}}</span>
            <div class="profile__user-box">
                <span class="black-text sub-profile">Birth Date</span>
                <span class="profile__user-date grey-text lighten-2">{{$profile->dob->toFormattedDateString()}}</span>
                <span class="black-text sub-profile">Joined Since</span>
                <span
                    class="profile__join-date grey-text lighten-2">{{$profile->created_at->toFormattedDateString()}}</span>
                <span class="black-text sub-profile">Sex</span>
                <span class="profile__user-status grey-text lighten-2">{{$profile->sex}}</span>
            </div>


            <span><a href="/editProfile/{{$profile->id}}" class="pink-text darken-2">Edit</a></span>
            @if ($profile->status == 'Active')
            <span><a href="/deactivateUser/{{$profile->id}}" class="pink-text darken-2">Deactivate</a></span>
            @else
            <span><a href="/activateUser/{{$profile->id}}" class="pink-text darken-2">Activate</a></span>
            @endif
            <p><a href="/user/page/{{$profile->id}}" class="btn pink darken-4">Products</a></p>

        </div>
        <div class="col s12 m9 l9 profile-detail">
            @if ($profile)
            <div>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Staff #</th>
                            <th>Payment #</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$profile->staff_no}}</td>
                            <td>{{$profile->payment_number}}</td>
                            <td>{{$profile->phone}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Job Cadre</th>
                            <th>Employ Type</th>
                            <th>Email</th>
                            <th>Marital Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$profile->job_cadre}}</td>
                            <td>{{$profile->employ_type}}</td>
                            <td>{{$profile->email}}</td>
                            <td>{{$profile->marital_status}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Dept</th>
                            <th>Home</th>
                            <th>Residence</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$profile->dept}}</td>
                            <td>{{$profile->home_add}}</td>
                            <td>{{$profile->res_add}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @else
            <p>No Record Added Yet</p>
            @endif

        </div>

    </div>

    <div class="row user-profiles">
        @if ($profile->nok)
        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">Next of Kin</p>
            <p><i class="small material-icons pink-text darken-4">wc</i></p>
            <span class="profile__user-name">{{$profile->nok->title}}</span>
            <span class="profile__user-name">{{$profile->nok->first_name}} {{$profile->nok->last_name}}</span>
            <div class="profile__user-box">
                <span class="black-text sub-profile">Sex</span>
                <span class="profile__user-status grey-text lighten-2">{{$profile->nok->gender}}</span>
            </div>
            <span><a href="/editNok/{{$profile->nok->id}}" class="pink-text darken-2">Edit</a></span>
        </div>
        <div class="col s12 m9 l9 profile-detail">
            @if ($profile)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Relationship</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$profile->nok->relationship}}</td>
                        <td>{{$profile->nok->email}}</td>
                        <td>{{$profile->nok->phone}}</td>
                    </tr>
                </tbody>
            </table>
            @else
            <p>No Record Added Yet</p>
            @endif
        </div>
        @else
        <div class="add-more-box">
            <h5>NEXT OF KIN</h5>
            <a href="/Nok/{{$profile->id}}" class="add-more"><i class="small material-icons">add</i></a>
        </div>
        @endif
    </div>

    <div class="row user-profiles">
        @if ($profile->bank)
        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">Bank</p>
            <p><i class="small material-icons pink-text lighten-4">looks</i></p>
            <span class="profile__user-name">{{$profile->bank->bank_name}}</span>
            <span class="profile__user-name">{{$profile->bank->acct_number}}</span>
            <span><a href="/editBank/{{$profile->bank->id}}" class="pink-text darken-2">Edit</a></span>
        </div>
        <div class="col s12 m9 l9  profile-detail">
            @if ($profile)
            <table class="highlight">
                <thead>
                    <tr>
                        {{-- <th>Branch</th> --}}
                        <th>Bank Code</th>
                        <th>Acct Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {{-- <td>{{$profile->bank->bank_branch}}</td> --}}
                        <td>{{$profile->bank->sort_code}}</td>
                        <td>{{$profile->first_name}} {{$profile->last_name}}</</td> </tr> </tbody> </table> @else <p>No
                            Record Added Yet</p>
                            @endif
        </div>
        @else
        <div class="add-more-box">
            <h5>BANK DETAILS</h5>
            <a href="/bank/{{$profile->id}}" class="add-more"><i class="small material-icons">add</i></a>
        </div>
        @endif
    </div>

    {{-- Check for savings --}}

    <div class="row user-profiles">
        @if ($SavingReview->count()>=1)
        {{-- <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">Monthly Saving Reviews</p>
        </div> --}}
        <div class="col s12  profile-detail">
            <p class="profile__heading text-grey darken-3">Monthly Saving Reviews</p>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DATE ADDED</th>
                        <th>AMOUNT</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($SavingReview as $reviewItem)
                    <tr>
                        <td>{{$reviewItem->created_at->toDateString()}}</td>
                        <td>{{number_format($reviewItem->current_amount,2,'.',',')}}</td>
                        <td>{{$reviewItem->status}}</td>
                        <td>
                            @if ($reviewItem->status=='Inactive')
                            <a href="#" class="btn red darken-3">{{$reviewItem->status}}</a>
                            @else
                            <a href="/saving/inactive/{{$reviewItem->id}}" class="btn grey darken-3">Deactivate</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p><a href="/saving/review/{{$profile->id}}" class="btn green darken-4">Review</a></p>
            {{-- butn here --}}
        </div>
        @else
        <div class="add-more-box">
            <h5>MONTHLY SAVING AMOUNT</h5>
            <a href="/saving/review/{{$profile->id}}" class="add-more"><i class="small material-icons">add</i></a>
        </div>
        @endif
    </div>

</div>
@endsection