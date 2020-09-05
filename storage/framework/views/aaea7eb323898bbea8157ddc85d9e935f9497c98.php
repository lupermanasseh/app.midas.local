<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 m6 l6subject-header">
            <p class="teal-text">LOAN HISTORY/DETAILS</p>
        </div>
        <div class="col s12 m6 l6 subject-header right">
            <a  class="btn" href="/user/landingPage/<?php echo e($loan->user_id); ?>"><i class="tiny material-icons">arrow_back</i> Back</a>
        </div>
    </div>

    <div class="row">
        <section class="header-content">
            <div class="col s6 membership-details precision-left">
                <table>
                    <tr>
                        <th>NAME:</th>
                        <td><?php echo e($loan->user->last_name); ?> <?php echo e($loan->user->first_name); ?></td>
                    </tr>
                    <tr>
                        <th>REG.NO:</th>
                        <td><?php echo e($loan->user->membership_type); ?>/<?php echo e($loan->user->id); ?></td>
                    </tr>
                    <tr>
                        <th>LOAN TYPE:</th>
                        <td><?php echo e($loan->product->name); ?></td>
                    </tr>
                    <tr>
                        <th>INT. RATE (%):</th>
                        <td><?php echo e($loan->product->interest*100); ?>%</td>
                    </tr>
                    <tr>
                        <th>INTEREST:</th>
                        <td><?php echo e(number_format($loan->product->interest*$loan->amount_approved,2,'.',',')); ?></td>
                    </tr>
                    <tr>
                        <th>DISBURSEMENT DATE:</th>
                        <td>
                          <?php if($loan->disbursement_date): ?>
                          <?php echo e($loan->disbursement_date->toFormattedDateString()); ?>

                          <?php else: ?>
                          NOT AVAILABLE
                          <?php endif; ?></td>
                    </tr>
                </table>
            </div>

            <div class="col s6 membership-details precision-right">
                <table>
                    <tr>
                        <th>TOTAL LOAN AMOUNT:</th>
                        <td><?php echo e(number_format($loan->amount_approved,2,'.',',')); ?>

                          <?php if($loan->topup_amount): ?>
                          <span class="green-text darken-2">+ <?php echo e(number_format($loan->topup_amount,2,'.',',')); ?> = (<?php echo e(number_format($loan->amount_approved+$loan->topup_amount,2,'.',',')); ?>)</span>
                          <?php else: ?>


                          <?php endif; ?></td>
                    </tr>
                    <tr>
                        <th>TENOR:</th>
                        <td><?php echo e($loan->custom_tenor); ?> MNTHS</td>
                    </tr>
                    <tr>
                        <th>MONTHLY REPAYMNT:</th>
                        <td><?php echo e(number_format($loan->monthly_deduction,2,'.',',')); ?></td>
                    </tr>
                    <tr>
                        <th>START DATE:</th>
                        <td><?php echo e($loan->loan_start_date->toFormattedDateString()); ?></td>
                    </tr>
                    <tr>
                        <th>END DATE:</th>
                        <td><?php echo e($loan->loan_end_date->toFormattedDateString()); ?></td>
                    </tr>
                    <tr>
                        <th>ACTION:</th>
                        <td><a href="/paidloan/edit/<?php echo e($loan->id); ?>"><i class="tiny material-icons">edit</i> </a>
                        <a href="/destroy/deductions/<?php echo e($loan->id); ?>" id="delete"> <i
                                class="tiny material-icons red-text">delete_forever</i></a></td>
                    </tr>
                </table>
            </div>
        </section>
    </div>


    <div class="row">
      <div class="col s12 m4 l4">
        <p>
            <a href="/loan/deductions/print/<?php echo e($loan->id); ?>" class=" btn pink darken-4" target="_blank"><i
                    class="fas fa-file"></i>
                Plain File</a> |
            <a href="/loan/deductions/printpdf/<?php echo e($loan->id); ?>" class=" btn pink darken-4" target="_blank"><i
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
          <a class="btn" href="/user/landingPage/<?php echo e($loan->user_id); ?>"><i class="tiny material-icons">arrow_back</i>Back</a>
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
                          <?php if($loan->disbursement_date): ?>
                          <?php echo e($loan->disbursement_date->toFormattedDateString()); ?>

                          <?php else: ?>
                          NOT AVAILABLE
                          <?php endif; ?></td>
                        <td>Normal Loan Disbursement</td>
                        <td><?php echo e(number_format($loan->amount_approved,2,'.',',')); ?></td>
                        <td>-</td>
                        <td><?php echo e(number_format($loan->amount_approved,2,'.',',')); ?>

                        </td>
                    </tr>

                    <?php if(count($loanHistory)>=1): ?>

                    <?php $__currentLoopData = $loanHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><?php echo e($myItem->entry_month->toFormattedDateString()); ?></td>
                        <td><?php echo e($myItem->notes); ?></td>
                        
                        <td>
                          <?php if($myItem->amount_debited): ?>
                          <?php echo e(number_format($myItem->amount_debited,2,'.',',')); ?>

                          <?php else: ?>
                          -
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if($myItem->amount_deducted): ?>
                          <?php echo e(number_format($myItem->amount_deducted,2,'.',',')); ?>

                          <?php else: ?>
                          -
                          <?php endif; ?>
                          </td>
                          <td>
                          <?php echo e(number_format($loan->amount_approved-$myItem->balances,2,'.',',')); ?>

                          </td>
                          <td>
                            <a href="/loanDeduction/edit/<?php echo e($myItem->id); ?>"><i class="tiny material-icons">edit</i> </a>
                            <a href="/loanDeduction/remove/<?php echo e($myItem->id); ?>" id="delete"> <i
                                    class="tiny material-icons red-text">delete_forever</i></a>
                          </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      <tr>
                          <th colspan="5">No deduction(s) for this facility yet</th>
                      </tr>
                    <?php endif; ?>
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
             <?php echo e(csrf_field()); ?>

             <div class="row">
                 <div class="input-field col s12 m4 l4">
                     <input id="sub_id" name="sub_id" value="<?php echo e($loan->id); ?>" type="hidden">
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
              <?php echo e(csrf_field()); ?>


              <div class="row">
                  <div class="input-field col s12 m2 l2">
                      <input id="sub_id" name="sub_id" value="<?php echo e($loan->id); ?>" type="hidden">
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
               <?php echo e(csrf_field()); ?>

               <div class="row">
                 <div class="input-field col s12 m4 l4">
                     <select id="parent_loan" name="parent_loan">
                         <?php $__currentLoopData = $activeLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($myProduct->id); ?>"><?php echo e($myProduct->product->name); ?>/(<?php echo e($myProduct->amount_approved); ?>)</option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php echo e(csrf_field()); ?>


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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>