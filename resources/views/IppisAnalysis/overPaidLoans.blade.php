@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}


    <div class="row">


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

      </div>





      <div id="test2" class="col s12">
        <!--  -->
            <div class="row">
                @if(count($overPaidLoans)>=1)
                <div class="col s12">
                    <h6>OVER PAID  LOANS</h6>
                </div>
                @else
                @endif
            </div>


            <div class="row">
                <div class="col s12">
                    <table class="">
                        @if(count($overPaidLoans)>=1)
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

                            @foreach ($overPaidLoans as $myProduct)
                            <tr>
                                <td>{{$myProduct->product->name}}</td>
                                <td>{{$myProduct->loan_start_date->toFormattedDateString()}}</td>
                                <td>{{$myProduct->loan_end_date->toFormattedDateString()}}</td>
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
                                          <a href="/deactivate/loan/{{$myProduct->id}}" id="delete"> <i
                                                  class="tiny material-icons blue-text tooltipped" data-position="bottom" data-tooltip="Deactivate Loan">close</i></a>
                                </td>
                                <!-- <td><a data-subid="{{$myProduct->id}}" class="waves-effect waves-light btn modal-trigger red darken-3 transferid" href="#modal1">Debit</a> | <a data-subid="{{$myProduct->id}}" class="waves-effect waves-light btn modal-trigger transferid"  href="#modal2">Credit</a></td> -->
                            </tr>
                            @endforeach
                            @else
                            @endif
                            @if(count($overPaidLoans)>=1)
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

      </div>


    </div>
</div>
@endsection
