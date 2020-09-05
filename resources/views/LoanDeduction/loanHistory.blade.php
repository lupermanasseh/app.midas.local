@extends('Layouts.admin-app')


@section('main-content')
<div class="container">
    {{--
    @include('inc.messages') --}}
    <div class="row">
        <div class="col s12 m6 l6subject-header">
            <p class="teal-text">LOAN HISTORY/DETAILS</p>
        </div>
        <div class="col s12 m6 l6 subject-header right">
            <a  class="btn" href="/user/landingPage/{{$loan->user_id}}"><i class="tiny material-icons">arrow_back</i> Back</a>
        </div>
    </div>

    <div class="row">
        <section class="header-content">
            <div class="col s6 membership-details precision-left">
                <table>
                    <tr>
                        <th>NAME:</th>
                        <td>{{$loan->user->last_name}} {{$loan->user->first_name}}</td>
                    </tr>
                    <tr>
                        <th>REG.NO:</th>
                        <td>{{$loan->user->membership_type}}/{{$loan->user->id}}</td>
                    </tr>
                    <tr>
                        <th>LOAN TYPE:</th>
                        <td>{{$loan->product->name}}</td>
                    </tr>
                    <tr>
                        <th>INT. RATE (%):</th>
                        <td>{{$loan->product->interest*100}}%</td>
                    </tr>
                    <tr>
                        <th>INTEREST:</th>
                        <td>{{number_format($loan->product->interest*$loan->amount_approved,2,'.',',')}}</td>
                    </tr>
                    <tr>
                        <th>DISBURSEMENT DATE:</th>
                        <td>
                          @if($loan->disbursement_date)
                          {{$loan->disbursement_date->toFormattedDateString()}}
                          @else
                          NOT AVAILABLE
                          @endif</td>
                    </tr>
                </table>
            </div>

            <div class="col s6 membership-details precision-right">
                <table>
                    <tr>
                        <th>TOTAL LOAN AMOUNT:</th>
                        <td>{{number_format($loan->amount_approved,2,'.',',')}}
                          @if($loan->topup_amount)
                          <span class="green-text darken-2">+ {{number_format($loan->topup_amount,2,'.',',')}} = ({{number_format($loan->amount_approved+$loan->topup_amount,2,'.',',')}})</span>
                          @else


                          @endif</td>
                    </tr>
                    <tr>
                        <th>TENOR:</th>
                        <td>{{$loan->custom_tenor}} MNTHS</td>
                    </tr>
                    <tr>
                        <th>MONTHLY REPAYMNT:</th>
                        <td>{{number_format($loan->monthly_deduction,2,'.',',')}}</td>
                    </tr>
                    <tr>
                        <th>START DATE:</th>
                        <td>{{$loan->loan_start_date->toFormattedDateString()}}</td>
                    </tr>
                    <tr>
                        <th>END DATE:</th>
                        <td>{{$loan->loan_end_date->toFormattedDateString()}}</td>
                    </tr>
                    <tr>
                        <th>ACTION:</th>
                        <td><a href="/paidloan/edit/{{$loan->id}}"><i class="tiny material-icons">edit</i> </a>
                        <a href="/destroy/deductions/{{$loan->id}}" id="delete"> <i
                                class="tiny material-icons red-text">delete_forever</i></a></td>
                    </tr>
                </table>
            </div>
        </section>
    </div>


    <div class="row">
      <div class="col s12 m4 l4">
        <p>
            <a href="/loan/deductions/print/{{$loan->id}}" class=" btn pink darken-4" target="_blank"><i
                    class="fas fa-file"></i>
                Plain File</a> |
            <a href="/loan/deductions/printpdf/{{$loan->id}}" class=" btn pink darken-4" target="_blank"><i
                    class="fas fa-file-pdf"></i>
                PDF</a>
        </p>
      </div>
      <div class="col s12 m4 l4">
        <a class="waves-effect waves-light btn modal-trigger red darken-3"  href="#modal1">Debit</a> | <a class="waves-effect waves-light btn modal-trigger"  href="#modal2">Credit</a>
      </div>

      <div class="col s12 m4 l4">
        <a class="waves-effect waves-light btn modal-trigger  orange darken-3"  href="#modal3">Top Up</a> | <a class="waves-effect waves-light btn modal-trigger"  href="#modal">Restructure</a>
      </div>

    </div>


    <div class="row">
        <div class="col s12 m12 l12 subject-header right">
          <a class="btn" href="/user/landingPage/{{$loan->user_id}}"><i class="tiny material-icons">arrow_back</i>Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col s12">

            <table class="highlight">
                <thead>
                    <tr>

                        <th>DATE</th>
                        <th>DESCRIPTION</th>
                        <th>DEBIT</th>
                        <th>CREDIT</th>
                        <th>BALANCE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                          @if($loan->disbursement_date)
                          {{$loan->disbursement_date->toFormattedDateString()}}
                          @else
                          NOT AVAILABLE
                          @endif</td>
                        <td>Normal Loan Disbursement</td>
                        <td>{{number_format($loan->amount_approved,2,'.',',')}}</td>
                        <td>-</td>
                        <td>{{number_format($loan->amount_approved,2,'.',',')}}
                        </td>
                    </tr>

                    @if (count($loanHistory)>=1)

                    @foreach ($loanHistory as $myItem)
                    <tr>

                        <td>{{$myItem->entry_month->toFormattedDateString()}}</td>
                        <td>{{$myItem->notes}}</td>
                        {{-- <td><a href="/user/page/{{$myItem->user_id}}">{{$myItem->user->first_name}}</a></td> --}}
                        <td>
                          @if($myItem->amount_debited)
                          {{number_format($myItem->amount_debited,2,'.',',')}}
                          @else
                          -
                          @endif
                        </td>
                        <td>
                          @if($myItem->amount_deducted)
                          {{number_format($myItem->amount_deducted,2,'.',',')}}
                          @else
                          -
                          @endif
                          </td>
                          <td>
                          {{number_format($loan->amount_approved-$myItem->balances,2,'.',',')}}
                          </td>
                          <td>
                            <a href="/loanDeduction/edit/{{$myItem->id}}"><i class="tiny material-icons">edit</i> </a>
                            <a href="/loanDeduction/remove/{{$myItem->id}}" id="delete"> <i
                                    class="tiny material-icons red-text">delete_forever</i></a>
                          </td>
                    </tr>
                    @endforeach
                    @else
                      <tr>
                          <th colspan="5">No deduction(s) for this facility yet</th>
                      </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- modal for debit -->
<!-- Modal Structure -->
 <div id="modal1" class="modal">
   <div class="modal-content">
     <h6>DEBIT LOAN TRANSACTION</h6>
     <div class="row">
         <form class="col s12" method="POST" action="/debit/loan">
             {{ csrf_field() }}
             <div class="row">
                 <div class="input-field col s12 m4 l4">
                     <input id="sub_id" name="sub_id" value="{{$loan->id}}" type="hidden">
                     <input id="amount" name="amount" type="text" class="validate">
                     <label for="amount">Enter Amount</label>
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

             <div class="row">

             </div>

             <button type="submit" class="btn">Debit Loan</button>
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
      <h6>CREDIT LOAN TRANSACTION</h6>
      <div class="row">
          <form class="col s12" method="POST" action="/loanRepay/store">
              {{ csrf_field() }}

              <div class="row">
                  <div class="input-field col s12 m2 l2">
                      <input id="sub_id" name="sub_id" value="{{$loan->id}}" type="hidden">
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
  </div>

  <!-- top up modal -->

  <!-- Modal Structure -->
   <div id="modal3" class="modal">
     <div class="modal-content">
       <h6>TOP UP</h6>
       <div class="row">
           <form class="col s12" method="POST" action="/topup/loan">
               {{ csrf_field() }}
               <div class="row">
                 <div class="input-field col s12 m4 l4">
                     <select id="parent_loan" name="parent_loan">
                         @foreach ($activeLoans as $myProduct)
                         <option value="{{$myProduct->id}}">{{$myProduct->product->name}}/({{$myProduct->amount_approved}})</option>
                         @endforeach
                     </select>
                     <label>Select Parent Loan</label>
                 </div>
                 <div class="input-field col s12 m4 l4">
                     <input placeholder="Top Up Amount" id="amount" name="amount" type="text" class="validate">
                     <label for="amount">Top Up Amount</label>
                 </div>
                 <div class="input-field col s12 m4 l4">
                     <input id="transaction_date" name="transaction_date" type="date" class="validate">
                     <label for="transaction_date">Transaction Date</label>
                 </div>
               </div>

               <div class="row">
                 <div class="input-field col s12 m3 l3">
                     <input placeholder="Loan tenor" id="tenor" name="tenor" type="text" class="validate">
                     <label for="tenor">Tenor</label>
                 </div>

                 <div class="input-field col s12 m3 l3">
                     <input placeholder="Monthly deduction" id="deduction" name="deduction" type="text"
                         class="validate">
                     <label for="tenor">Deduction</label>
                 </div>

                 <div class="input-field col s12 m3 l3">
                     <input id="start_date" name="start_date" type="date" class="validate">
                     <label for="start_date">Start Date</label>
                 </div>

                 <div class="input-field col s12 m3 l3">
                     <input id="end_date" name="end_date" type="date" class="validate">
                     <label for="end_date">End Date</label>
                 </div>
               </div>

               <div class="row">

                   <!-- <div class="input-field col s12 m4 l4">
                       <input id="entry_date" name="entry_date" type="date" class="validate">
                       <label for="entry_date">Start Date</label>
                   </div>

                   <div class="input-field col s12 m4 l4">
                       <input id="entry_date" name="entry_date" type="date" class="validate">
                       <label for="entry_date">End Date</label>
                   </div> -->

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
    <div id="modal4" class="modal">
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
    </div>
@endsection
