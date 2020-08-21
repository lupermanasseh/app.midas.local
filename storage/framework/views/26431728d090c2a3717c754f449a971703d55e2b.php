<?php $__env->startSection('main-content'); ?>
<div class="container">
    
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
                        <td><?php echo e(substr($user->membership_type,0,1)); ?>/<?php echo e($user->id); ?></td>
                        <td>
                            <a href="/userDetails/<?php echo e($user->id); ?>"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></a></td>
                        <td><?php echo e($user->status); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col s6">
            <a href="/saving/new/<?php echo e($user->id); ?>" class="btn blue darken-3">Add Saving</a>
        </div>
        <div class="col s6">
            <a href="/targetsaving/new/<?php echo e($user->id); ?>" class="btn purple darken-3">Add
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
                                href="/saving/listings/<?php echo e($user->id); ?>"><?php echo e(number_format($saving->netBalance($user->id),2,'.',',')); ?></a>
                        </td>
                    </tr>
                    <?php if(count($targetsr)>=1): ?>
                    <?php $__currentLoopData = $targetsr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tsr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(substr($user->membership_type,0,1)); ?>/<?php echo e($user->id); ?></td>
                        <td>
                            <a href="/userDetails/<?php echo e($user->id); ?>"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></a>
                        </td>
                        <td>Target Saving (Bam)</td>
                        <td><?php echo e($user->status); ?></td>
                        <td><a
                                href="/tsSub/detail/<?php echo e($tsr->id); ?>"><?php echo e(number_format($targetSaving->targetSavingBalance($tsr->id),2,'.',',')); ?></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <?php if(count($activeLoans)>=1): ?>
        <div class="col s12">
            <h6>ACTIVE LOANS | <span> <a href="" class="btn orange darken-3">ALL LOANS</a></span>| <span> <a href="/user/page/<?php echo e($user->id); ?>" class="btn green darken-3">PRODUCT(s)</a></span></h6>
        </div>
        <?php else: ?>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col s12">
            <table class="">
                <?php if(count($activeLoans)>=1): ?>
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

                    <?php $__currentLoopData = $activeLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($myProduct->product->name); ?></td>
                        <td><?php echo e($myProduct->loan_start_date->toDateString()); ?></td>
                        <td><?php echo e($myProduct->loan_end_date->toDateString()); ?></td>
                        <td><?php echo e($myProduct->custom_tenor); ?></td>
                        <td><?php echo e(number_format($myProduct->amount_approved,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($myProduct->monthly_deduction,2,'.',',')); ?></td>
                        <td><a
                            href="/loanDeduction/history/<?php echo e($myProduct->id); ?>"><?php echo e(number_format($myProduct->amount_approved-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')); ?></a>
                        </td>
                        <td><a href="/loan/schedule/<?php echo e($myProduct->id); ?>"  target="_blank">View</a></td>
                        <!-- <td><a data-subid="<?php echo e($myProduct->id); ?>" class="waves-effect waves-light btn modal-trigger red darken-3 transferid" href="#modal1">Debit</a> | <a data-subid="<?php echo e($myProduct->id); ?>" class="waves-effect waves-light btn modal-trigger transferid"  href="#modal2">Credit</a></td> -->
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <?php endif; ?>
                    <?php if(count($activeLoans)>=1): ?>
                    <tr>
                        <th colspan="4">Summary</th>
                        <th><?php echo e(number_format($user->totalApprovedAmount($user->id),2,'.',',')); ?></th>
                        <th><?php echo e(number_format($user->loanSubscriptionTotal($user->id),2,'.',',')); ?></th>
                        <th><?php echo e(number_format($user->allLoanBalances($user->id),2,'.',',')); ?></th>
                    </tr>
                    <?php else: ?>
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
               <!-- <div class="input-field col s12 m4 l4">

                   <input input placeholder="Enter Loan ID" id="sub_id" name="sub_id" type="text" value="" class="validate">
                   <label for="sub_id">Loan ID</label>
               </div> -->
                 <div class="input-field col s12 m4 l4">
                     <input id="sub_id" name="sub_id" value="" type="hidden">
                     <input id="amount" name="amount" type="text" class="validate">
                     <label for="amount">Enter Amount</label>
                 </div>
                 <div class="input-field col s12 m4 l4">
                     <input id="entry_date" name="entry_date" type="text" class="validate datepicker">
                     <label for="entry_date">Date</label>
                 </div>
                 <div class="input-field col s12 m4 l4">
                     <input id="notes" name="notes" type="text" class="validate">
                     <label for="notes">Description</label>
                 </div>
             </div>

             <div class="row">

                 <!-- <div class="input-field col s12 m4 l4">
                     <input id="depositor_name" name="depositor_name" type="text" class="validate">
                     <label for="depositor_name">Depositor Name</label>
                 </div> -->
                 <!-- <div class="input-field col s12 m4 l4">
                     <input id="entry_date" name="entry_date" type="text" class="validate datepicker">
                     <label for="entry_date">Date</label>
                 </div>
                 <div class="input-field col s12 m4 l4">
                     <input id="notes" name="notes" type="text" class="validate">
                     <label for="notes">Notes</label>
                 </div> -->
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>