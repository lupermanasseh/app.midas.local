@extends('Layouts.admin-app')
@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}


    <div class="row">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s3"><a class="active" href="#test1">SAVINGS</a></li>
          <li class="tab col s3"><a  href="#test2">LOANS ({{$activeLoans->count()}})</a></li>

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
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>Savings (Contribution)</td>
                            <td>
                                <a
                                    href="/saving/listings/{{$user->id}}">{{number_format($saving->netBalance($user->id),2,'.',',')}}</a>
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
                    <h6>ACTIVE LOANS | <span> <a href="/user/page/{{$user->id}}" class="btn green darken-3">PRODUCT(s)</a></span></h6>
                </div>
                @else
                @endif
            </div>
            <div class="col s12 m6 l6 left">
              <a class="waves-effect waves-light btn modal-trigger red darken-3"  href="#modal1">Top Up</a> | <a class="waves-effect waves-light btn modal-trigger"  href="#modal2">Restructure</a>
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
                                <td>{{number_format($myProduct->amount_approved,2,'.',',')}}</td>
                                <td>{{number_format($myProduct->monthly_deduction,2,'.',',')}}</td>
                                <td><a
                                    href="/loanDeduction/history/{{$myProduct->id}}">{{number_format($myProduct->amount_approved-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')}}</a>
                                </td>
                                <td><a href="/loan/schedule/{{$myProduct->id}}"  target="_blank">View</a></td>
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
        <h6>INACTIVE LOANS | <span> <a href="/user/loans/{{$user->id}}" class="btn orange darken-3">ALL LOANS </a></span>| <span> <a href="/user/page/{{$user->id}}" class="btn green darken-3">PRODUCT(s)</a></span></h6>
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
                        <td>{{number_format($myProduct->amount_approved,2,'.',',')}}</td>
                        <td>{{number_format($myProduct->monthly_deduction,2,'.',',')}}</td>
                        <td><a
                            href="/loanDeduction/history/{{$myProduct->id}}">{{number_format($myProduct->amount_approved-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')}}</a>
                        </td>
                        <td><a href="/loan/schedule/{{$myProduct->id}}"  target="_blank">View</a></td>
                        <!-- <td><a data-subid="{{$myProduct->id}}" class="waves-effect waves-light btn modal-trigger red darken-3 transferid" href="#modal1">Debit</a> | <a data-subid="{{$myProduct->id}}" class="waves-effect waves-light btn modal-trigger transferid"  href="#modal2">Credit</a></td> -->
                    </tr>
                    @endforeach
                    @else
                    @endif
                    @if(count($inactiveLoans)>=1)
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
    @else
    <div class="col s12">
        <h6>NO INACTIVE LOAN RECORD(s) YET</h6>
    </div>
    @endif
</div>

      </div>
    </div>
</div>

<!-- modal for debit -->
<!-- Modal Structure -->
 <div id="modal1" class="modal">
   <div class="modal-content">
     <h6>TOP UP</h6>
     <div class="row">
         <form class="col s12" method="POST" action="/debit/loan">
             {{ csrf_field() }}
             <div class="row">
                 <div class="input-field col s12 m3 l3">
                     <input placeholder="Reg Number" id="reg_no" name="reg_no" type="text" class="validate">
                     <label for="reg_no">Applicant's Reg Number</label>
                 </div>

                 <div class="input-field col s12 m3 l3">
                     <input placeholder="Reg Number" id="guarantor_id1" name="guarantor_id1" type="text"
                         class="validate">
                     <label for="guarantor_id1">First Guarantor</label>
                 </div>
                 <div class="input-field col s12 m3 l3">
                     <input placeholder="Reg Number" id="guarantor_id2" name="guarantor_id2" type="text"
                         class="validate">
                     <label for="guarantor_id2">Second Guarantor</label>
                 </div>
                 <div class="input-field col s12 m3 l3">
                     <input placeholder="Reg Number" id="guarantor_id2" name="guarantor_id2" type="text"
                         class="validate">
                     <label for="guarantor_id2">Second Guarantor</label>
                 </div>
             </div>

             <div class="row">
                 <div class="input-field col s12 m5 l5">
                     <select id="product_cat" name="product_cat">
                         @foreach ($catlist as $id=>$name)
                         <option value="{{$id}}">{{$name}}</option>
                         @endforeach
                     </select>
                     <label>Product Category</label>
                 </div>
                 <div class="input-field col s12 m2 l2">
                     <input id="units" name="units" type="number" class="validate">
                     <label for="units">Units</label>
                 </div>
                 <div class="input-field col s12 m5 l5">
                     <select id="product_item" name="product_item">
                     </select>
                     <label>Product</label>
                 </div>
                 <div class="input-field col s12 m3 l3">
                     <select id="product_cat" name="product_cat">
                         @foreach ($catlist as $id=>$name)
                         <option value="{{$id}}">{{$name}}</option>
                         @endforeach
                     </select>
                     <label>Existing Loan</label>
                 </div>
             </div>

             <button type="submit" class="btn">TOP UP</button>
         </form>
     </div>
   </div>
   <div class="modal-footer">
     <a class="modal-close waves-effect waves-green btn-flat">Close</a>
   </div>
 </div>

 <!-- modal structure for credit -->
 <!-- modal for debit -->
 <!-- Modal Structure -->
  <div id="modal2" class="modal">
    <div class="modal-content">
      <h6>RESTRUCTURE</h6>
      <div class="row">
          <form class="col s12" method="POST" action="/loanRepay/store">
              {{ csrf_field() }}

              <div class="row">
                  <div class="input-field col s12 m2 l2">
                      <input id="sub_id" name="sub_id"  value="" type="hidden">
                      <input id="amount" name="amount" type="text" class="validate">
                      <label for="amount">Enter Amount</label>
                  </div>
                  <div class="input-field col s12 m2 l2">
                      <input id="teller_number" name="teller_number" type="text" class="validate">
                      <label for="teller_number">Teller Number</label>
                  </div>
                  <div class="input-field col s12 m4 l4">
                      <input id="bank_name" name="bank_name" type="text" class="validate">
                      <label for="bank_name">Bank Name</label>
                  </div>
                  <div class="input-field col s12 m4 l4">
                      <input id="bank_add" name="bank_add" type="text" class="validate">
                      <label for="bank_add">Bank Add</label>
                  </div>
              </div>
              <div class="row">

                  <div class="input-field col s12 m4 l4">
                      <input id="depositor_name" name="depositor_name" type="text" class="validate">
                      <label for="depositor_name">Depositor Name</label>
                  </div>
                  <div class="input-field col s12 m4 l4">
                      <input id="entry_date" name="entry_date" type="date" class="validate">
                      <label for="entry_date">Date</label>
                  </div>
                  <div class="input-field col s12 m4 l4">
                      <input id="notes" name="notes" type="text" class="validate">
                      <label for="notes">Description</label>
                  </div>
              </div>

              <button type="submit" class="btn">Credit Loan</button>
          </form>
      </div>
    </div>
    <div class="modal-footer">
      <a class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
@endsection
