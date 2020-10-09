@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}


    <div class="row">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s3"><a class="active pink-text darken-3" href="#test1">SAVINGS</a></li>
          <li class="tab col s3"><a  class="pink-text darken-3" href="#test2">LOANS ({{$activeLoans->count()}})</a></li>
          <li class="tab col s3"><a  class="pink-text darken-3" href="#test3">RESTRUCRUED LOANS ({{$structured->count()}})</a></li>
          <li class="tab col s3"><a  class="pink-text darken-3" href="#test4">CONSOLIDATED LOANS LEDGER</a></li>

        </ul>
      </div>

      <div id="test1" class="col s12">
        <!-- markup begins -->
        <!--  -->
        <div class="row subject-header">
            <div class="col s6">
                <span class="text-teal">USER SUMMARY PAGE</span>
            </div>
            <div class="col s6">
                <span><a href="/user/all"><i class="small material-icons tooltipped" data-position="bottom"
                            data-tooltip="All Users">group</i></a></span>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                {{-- @if (count($users)>=1) --}}
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>REG NO</th>
                            <th>NAME</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{substr($user->membership_type,0,1)}}/{{$user->id}}</td>
                            <td>
                                <a href="/userDetails/{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a></td>
                            <td>{{$user->status}}</td>
                            <td>
                              @if ($user->status == 'Active')
                              <a href="/userDeactivateForm/{{$user->id}}" class="pink-text darken-2">Deactivate</a>
                              @else
                              <a href="/activateUserForm/{{$user->id}}" class="pink-text darken-2">Activate</a>
                              @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col s6">
                <a href="/saving/new/{{$user->id}}" class="btn blue darken-3">Add Saving</a>
            </div>
            <div class="col s6">
                <a href="/targetsaving/new/{{$user->id}}" class="btn purple darken-3">Add
                    TS</a>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <h6>SAVINGS</h6>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                {{-- @if (count($users)>=1) --}}
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>DESCRIPTION</th>
                            <th>BALANCE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>Savings</td>
                            <td>
                                <a
                                    href="/saving/listings/{{$user->id}}">{{number_format($saving->netBalance($user->id),2,'.',',')}}</a>
                            </td>
                            <td>
                                <a href="/saving/withdraw/{{$user->id}}" class="btn pink darken-4"> withdraw</a>
                            </td>
                        </tr>
                        @if(count($targetsr)>=1)
                        @foreach ($targetsr as $tsr)
                        <tr>
                            <td>{{substr($user->membership_type,0,1)}}/{{$user->id}}</td>
                            <td>
                                <a href="/userDetails/{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a>
                            </td>
                            <td>Target Saving (Bam)</td>
                            <td>{{$user->status}}</td>
                            <td><a
                                    href="/tsSub/detail/{{$tsr->id}}">{{number_format($targetSaving->targetSavingBalance($tsr->id),2,'.',',')}}</a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
      </div>


      <div id="test2" class="col s12">
        <!--  -->
            <div class="row">
                @if(count($activeLoans)>=1)
                <div class="col s12">
                    <h6>ACTIVE LOANS</h6>
                </div>
                @else
                @endif
            </div>


            <div class="row">
                <div class="col s12">
                    <table class="">
                        @if(count($activeLoans)>=1)
                        <thead>
                            <tr>
                                <th>Loan Type</th>
                                <th>S/Date</th>
                                <th>E/Date</th>
                                <th>Tenor</th>
                                <th>Amt</th>
                                <th>Repymt</th>
                                <th>Bal</th>
                                <th>Schedule</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($activeLoans as $myProduct)
                            <tr>
                                <td>{{$myProduct->product->name}}</td>
                                <td>{{$myProduct->loan_start_date->toDateString()}}</td>
                                <td>{{$myProduct->loan_end_date->toDateString()}}</td>
                                <td>{{$myProduct->custom_tenor}}</td>
                                <td>
                                  {{number_format($myProduct->amount_approved+$myProduct->topup_amount,2,'.',',')}}
                                </td>
                                <td>{{number_format($myProduct->monthly_deduction,2,'.',',')}}</td>
                                <td><a
                                    href="/loanDeduction/history/{{$myProduct->id}}" class="tooltipped" data-position="left" data-tooltip="Loan Deduction History">{{number_format($myProduct->amount_approved-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')}}</a>
                                </td>
                                <td><a href="/loan/schedule/{{$myProduct->id}}"  target="_blank" class="tooltipped" data-position="bottom" data-tooltip="View Loan Schedule">View</a></td>
                                <td>
                                  <a href="/paidloan/edit/{{$myProduct->id}}"><i class="tiny material-icons tooltipped" data-position="top" data-tooltip="Edit Loan">edit</i> </a>
                                  <a href="/destroy/deductions/{{$myProduct->id}}" id="delete"> <i
                                          class="tiny material-icons red-text tooltipped" data-position="bottom" data-tooltip="Delete Loan">delete_forever</i></a>
                                </td>
                                <!-- <td><a data-subid="{{$myProduct->id}}" class="waves-effect waves-light btn modal-trigger red darken-3 transferid" href="#modal1">Debit</a> | <a data-subid="{{$myProduct->id}}" class="waves-effect waves-light btn modal-trigger transferid"  href="#modal2">Credit</a></td> -->
                            </tr>
                            @endforeach
                            @else
                            @endif
                            @if(count($activeLoans)>=1)
                            <tr>
                                <th colspan="4">Summary</th>
                                <th>{{number_format($user->totalApprovedAmount($user->id),2,'.',',')}}</th>
                                <th>{{number_format($user->loanSubscriptionTotal($user->id),2,'.',',')}}</th>
                                <th>{{number_format($user->allLoanBalances($user->id),2,'.',',')}}</th>
                            </tr>
                            @else
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

<!-- INACTIVE LOANS -->
<div class="row">
    @if(count($inactiveLoans)>=1)
    <div class="col s12">
        <h6>INACTIVE LOANS</h6>
    </div>
    <div class="row">
        <div class="col s12">
            <table class="">

                <thead>
                    <tr>
                        <th>Loan Type</th>
                        <th>S/Date</th>
                        <th>E/Date</th>
                        <th>Tenor</th>
                        <th>Amt</th>
                        <th>Repymt</th>
                        <th>Bal</th>
                        <th>Schedule</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>

                    @foreach ($inactiveLoans as $myProduct)
                    <tr>
                        <td>{{$myProduct->product->name}}</td>
                        <td>{{$myProduct->loan_start_date->toDateString()}}</td>
                        <td>{{$myProduct->loan_end_date->toDateString()}}</td>
                        <td>{{$myProduct->custom_tenor}}</td>
                        <td>{{number_format($myProduct->amount_approved,2,'.',',')}}</td>
                        <td>{{number_format($myProduct->monthly_deduction,2,'.',',')}}</td>
                        <td><a
                            href="/loanDeduction/history/{{$myProduct->id}}" class="tooltipped" data-position="left" data-tooltip="Loan Deduction History">{{number_format($myProduct->amount_approved-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')}}</a>
                        </td>
                        <td><a href="/loan/schedule/{{$myProduct->id}}"  target="_blank" class="tooltipped" data-position="bottom" data-tooltip="View Loan Schedule">View</a></td>

                        <!-- <td><a data-subid="{{$myProduct->id}}" class="waves-effect waves-light btn modal-trigger red darken-3 transferid" href="#modal1">Debit</a> | <a data-subid="{{$myProduct->id}}" class="waves-effect waves-light btn modal-trigger transferid"  href="#modal2">Credit</a></td> -->
                    </tr>
                    @endforeach

                    @if(count($inactiveLoans)>=1)
                    <!-- <tr>
                        <th colspan="4">Summary</th>
                        <th>{{number_format($user->totalApprovedAmount($user->id),2,'.',',')}}</th>
                        <th>{{number_format($user->loanSubscriptionTotal($user->id),2,'.',',')}}</th>
                        <th>{{number_format($user->allLoanBalances($user->id),2,'.',',')}}</th>
                    </tr> -->
                    @else
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="col s12">
        <h6>NO INACTIVE LOAN RECORD(s) YET</h6>
    </div>
    @endif
</div>

      </div>

      <div id="test3" class="col s12">
        <!--  -->
            <div class="row">
                @if(count($structured)>=1)
                <div class="col s12">
                    <h6>STRUCTURED LOANS</h6>
                </div>
                @else
                @endif
            </div>


            <div class="row">
                <div class="col s12">
                    <table class="">
                        @if(count($structured)>=1)
                        <thead>
                            <tr>
                                <th>Loan Type</th>
                                <th>S/Date</th>
                                <th>E/Date</th>
                                <th>Tenor</th>
                                <th>Amt</th>
                                <th>Repymt</th>
                                <th>Bal</th>
                                <th>Schedule</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($structured as $myProduct)
                            <tr>
                                <td>{{$myProduct->product->name}}</td>
                                <td>{{$myProduct->loan_start_date->toDateString()}}</td>
                                <td>{{$myProduct->loan_end_date->toDateString()}}</td>
                                <td>{{$myProduct->custom_tenor}}</td>
                                <td>{{number_format($myProduct->amount_approved,2,'.',',')}}
                                  @if($myProduct->topup_amount)
                                  <span class="green-text darken-3">[+{{number_format($myProduct->topup_amount,2,'.',',')}}]</span>
                                  @else

                                  @endif</td>
                                <td>{{number_format($myProduct->monthly_deduction,2,'.',',')}}</td>
                                <td><a
                                    href="/loanDeduction/history/{{$myProduct->id}}" class="tooltipped" data-position="left" data-tooltip="Loan Deduction History">{{number_format($myProduct->amount_approved-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')}}</a>
                                </td>
                                <td><a href="/loan/schedule/{{$myProduct->id}}"  target="_blank" class="tooltipped" data-position="bottom" data-tooltip="View Loan Schedule">View</a></td>
                                <td>
                                  <!-- <a href="/paidloan/edit/{{$myProduct->id}}"><i class="tiny material-icons">edit</i> </a> -->
                                  <a href="/destroy/deductions/{{$myProduct->id}}" id="delete"> <i
                                          class="small material-icons red-text tooltipped" data-position="bottom" data-tooltip="Delete Loan" >delete_forever</i></a>
                                </td>
                                <!-- <td><a data-subid="{{$myProduct->id}}" class="waves-effect waves-light btn modal-trigger red darken-3 transferid" href="#modal1">Debit</a> | <a data-subid="{{$myProduct->id}}" class="waves-effect waves-light btn modal-trigger transferid"  href="#modal2">Credit</a></td> -->
                            </tr>
                            @endforeach
                            @else
                            @endif
                            @if(count($structured)>=1)
                            <tr>
                                <th colspan="4">Summary</th>
                                <th>{{number_format($user->archiveTotalApprovedAmount($user->id),2,'.',',')}}</th>
                                <th>{{number_format($user->archiveLoanSubscriptionTotal($user->id),2,'.',',')}}</th>
                                <th>{{number_format($user->archiveAllLoanBalances($user->id),2,'.',',')}}</th>
                            </tr>
                            @else
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>


      </div>

      <div id="test4" class="col s12">
        <!-- markup begins -->
        <!--  -->
        <div class="row subject-header">
            <div class="col s12">
                <span class="text-teal">CONSOLIDATED LOAN LEDGER</span>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                {{-- @if (count($users)>=1) --}}
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>REG NO</th>
                            <th>NAME</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{substr($user->membership_type,0,1)}}/{{$user->id}}</td>
                            <td>
                                <a href="/userDetails/{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a></td>
                            <td>{{$user->status}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <p>

                <a href="/consolidatedloan/print/{{$user->id}}" class=" btn pink darken-4" target="_blank"><i
                        class="fas fa-file-pdf"></i>
                    Plain File</a> |
                <a href="/consolidatedloan/printpdf/{{$user->id}}" class=" btn pink darken-4" target="_blank"><i
                        class="fas fa-file-pdf"></i>
                    PDF</a>
            </p>
        </div>

        <div class="row">
            <div class="col s12">
                <h6>CONSOLIDATED LOAN LEDGER</h6>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                @if(count($consolidatedLoans)>=1)
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>DATE</th>
                            <th>DESCRIPTION</th>
                            <th>DEBIT</th>
                            <th>CREDIT</th>
                            <th>BALANCE</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($consolidatedLoans as $loan)
                        <tr>
                            <td>{{$loan->date_entry->toFormattedDateString()}}</td>
                            <td>{{$loan->description}}</td>
                            <td>
                              @if($loan->debit)
                              {{number_format($loan->debit,2,'.',',')}}
                              @else
                              @endif
                            </td>
                            <td>
                              @if($loan->credit)
                              {{number_format($loan->credit,2,'.',',')}}
                              @else
                              @endif
                            </td>
                            <td>
                                  {{number_format($loan->balance,2,'.',',')}}
                            </td>
                            <td>
                              <a href="/consolidatedLoanDeduction/edit/{{$loan->id}}"><i class="tiny material-icons">edit</i> </a>
                              <a href="/consolidatedLoanDeduction/remove/{{$loan->id}}" id="delete"> <i
                                      class="tiny material-icons red-text">delete_forever</i></a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="2">Summary</th>
                            <th >{{number_format($user->consolidatedLoanDebitTotal($user->id),2,'.',',')}}</th>
                            <th >{{number_format($user->consolidatedLoanCreditTotal($user->id),2,'.',',')}}</th>
                            <th >{{number_format($user->consolidatedLoanBalance($user->id),2,'.',',')}}</th>
                        </tr>
                    </tbody>
                </table>
                @else
                <p>No record(s) yet</p>
                @endif
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
