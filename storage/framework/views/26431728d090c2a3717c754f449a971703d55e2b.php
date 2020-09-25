<?php $__env->startSection('main-content'); ?>
<div class="container">
    


    <div class="row">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s3"><a class="active pink-text darken-3" href="#test1">SAVINGS</a></li>
          <li class="tab col s3"><a  class="pink-text darken-3" href="#test2">LOANS (<?php echo e($activeLoans->count()); ?>)</a></li>
          <li class="tab col s3"><a  class="pink-text darken-3" href="#test3">RESTRUCRUED LOANS (<?php echo e($structured->count()); ?>)</a></li>
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
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>Savings (Contribution)</td>
                            <td>
                                <a
                                    href="/saving/listings/<?php echo e($user->id); ?>"><?php echo e(number_format($saving->netBalance($user->id),2,'.',',')); ?></a>
                            </td>
                            <td>
                                <a href="/saving/withdraw/<?php echo e($user->id); ?>" class="btn pink darken-4" target="_blank"> 25% withdrawal</a> | <a href="" class="btn red lighten-2"> Full withdrawal</a>
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
      </div>


      <div id="test2" class="col s12">
        <!--  -->
            <div class="row">
                <?php if(count($activeLoans)>=1): ?>
                <div class="col s12">
                    <h6>ACTIVE LOANS</h6>
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
                                <td>
                                  <?php echo e(number_format($myProduct->amount_approved,2,'.',',')); ?>

                                    <?php if($myProduct->topup_amount): ?>
                                    <span class="green-text darken-3">[+<?php echo e(number_format($myProduct->topup_amount,2,'.',',')); ?>]</span>
                                    <?php else: ?>

                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(number_format($myProduct->monthly_deduction,2,'.',',')); ?></td>
                                <td><a
                                    href="/loanDeduction/history/<?php echo e($myProduct->id); ?>" class="tooltipped" data-position="left" data-tooltip="Loan Deduction History"><?php echo e(number_format($myProduct->amount_approved-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')); ?></a>
                                </td>
                                <td><a href="/loan/schedule/<?php echo e($myProduct->id); ?>"  target="_blank" class="tooltipped" data-position="bottom" data-tooltip="View Loan Schedule">View</a></td>
                                <td>
                                  <a href="/paidloan/edit/<?php echo e($myProduct->id); ?>"><i class="tiny material-icons tooltipped" data-position="top" data-tooltip="Edit Loan">edit</i> </a>
                                  <a href="/destroy/deductions/<?php echo e($myProduct->id); ?>" id="delete"> <i
                                          class="tiny material-icons red-text tooltipped" data-position="bottom" data-tooltip="Delete Loan">delete_forever</i></a>
                                </td>
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

<!-- INACTIVE LOANS -->
<div class="row">
    <?php if(count($inactiveLoans)>=1): ?>
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

                    <?php $__currentLoopData = $inactiveLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($myProduct->product->name); ?></td>
                        <td><?php echo e($myProduct->loan_start_date->toDateString()); ?></td>
                        <td><?php echo e($myProduct->loan_end_date->toDateString()); ?></td>
                        <td><?php echo e($myProduct->custom_tenor); ?></td>
                        <td><?php echo e(number_format($myProduct->amount_approved,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($myProduct->monthly_deduction,2,'.',',')); ?></td>
                        <td><a
                            href="/loanDeduction/history/<?php echo e($myProduct->id); ?>" class="tooltipped" data-position="left" data-tooltip="Loan Deduction History"><?php echo e(number_format($myProduct->amount_approved-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')); ?></a>
                        </td>
                        <td><a href="/loan/schedule/<?php echo e($myProduct->id); ?>"  target="_blank" class="tooltipped" data-position="bottom" data-tooltip="View Loan Schedule">View</a></td>

                        <!-- <td><a data-subid="<?php echo e($myProduct->id); ?>" class="waves-effect waves-light btn modal-trigger red darken-3 transferid" href="#modal1">Debit</a> | <a data-subid="<?php echo e($myProduct->id); ?>" class="waves-effect waves-light btn modal-trigger transferid"  href="#modal2">Credit</a></td> -->
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if(count($inactiveLoans)>=1): ?>
                    <!-- <tr>
                        <th colspan="4">Summary</th>
                        <th><?php echo e(number_format($user->totalApprovedAmount($user->id),2,'.',',')); ?></th>
                        <th><?php echo e(number_format($user->loanSubscriptionTotal($user->id),2,'.',',')); ?></th>
                        <th><?php echo e(number_format($user->allLoanBalances($user->id),2,'.',',')); ?></th>
                    </tr> -->
                    <?php else: ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
    <div class="col s12">
        <h6>NO INACTIVE LOAN RECORD(s) YET</h6>
    </div>
    <?php endif; ?>
</div>

      </div>

      <div id="test3" class="col s12">
        <!--  -->
            <div class="row">
                <?php if(count($structured)>=1): ?>
                <div class="col s12">
                    <h6>STRUCTURED LOANS</h6>
                </div>
                <?php else: ?>
                <?php endif; ?>
            </div>


            <div class="row">
                <div class="col s12">
                    <table class="">
                        <?php if(count($structured)>=1): ?>
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

                            <?php $__currentLoopData = $structured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($myProduct->product->name); ?></td>
                                <td><?php echo e($myProduct->loan_start_date->toDateString()); ?></td>
                                <td><?php echo e($myProduct->loan_end_date->toDateString()); ?></td>
                                <td><?php echo e($myProduct->custom_tenor); ?></td>
                                <td><?php echo e(number_format($myProduct->amount_approved,2,'.',',')); ?>

                                  <?php if($myProduct->topup_amount): ?>
                                  <span class="green-text darken-3">[+<?php echo e(number_format($myProduct->topup_amount,2,'.',',')); ?>]</span>
                                  <?php else: ?>

                                  <?php endif; ?></td>
                                <td><?php echo e(number_format($myProduct->monthly_deduction,2,'.',',')); ?></td>
                                <td><a
                                    href="/loanDeduction/history/<?php echo e($myProduct->id); ?>" class="tooltipped" data-position="left" data-tooltip="Loan Deduction History"><?php echo e(number_format($myProduct->amount_approved-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')); ?></a>
                                </td>
                                <td><a href="/loan/schedule/<?php echo e($myProduct->id); ?>"  target="_blank" class="tooltipped" data-position="bottom" data-tooltip="View Loan Schedule">View</a></td>
                                <td>
                                  <!-- <a href="/paidloan/edit/<?php echo e($myProduct->id); ?>"><i class="tiny material-icons">edit</i> </a> -->
                                  <a href="/destroy/deductions/<?php echo e($myProduct->id); ?>" id="delete"> <i
                                          class="small material-icons red-text tooltipped" data-position="bottom" data-tooltip="Delete Loan" >delete_forever</i></a>
                                </td>
                                <!-- <td><a data-subid="<?php echo e($myProduct->id); ?>" class="waves-effect waves-light btn modal-trigger red darken-3 transferid" href="#modal1">Debit</a> | <a data-subid="<?php echo e($myProduct->id); ?>" class="waves-effect waves-light btn modal-trigger transferid"  href="#modal2">Credit</a></td> -->
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <?php endif; ?>
                            <?php if(count($structured)>=1): ?>
                            <tr>
                                <th colspan="4">Summary</th>
                                <th><?php echo e(number_format($user->archiveTotalApprovedAmount($user->id),2,'.',',')); ?></th>
                                <th><?php echo e(number_format($user->archiveLoanSubscriptionTotal($user->id),2,'.',',')); ?></th>
                                <th><?php echo e(number_format($user->archiveAllLoanBalances($user->id),2,'.',',')); ?></th>
                            </tr>
                            <?php else: ?>
                            <?php endif; ?>
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
            <p>

                <a href="/consolidatedloan/print/<?php echo e($user->id); ?>" class=" btn pink darken-4" target="_blank"><i
                        class="fas fa-file-pdf"></i>
                    Plain File</a> |
                <a href="/consolidatedloan/printpdf/<?php echo e($user->id); ?>" class=" btn pink darken-4" target="_blank"><i
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
                <?php if(count($consolidatedLoans)>=1): ?>
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
                      <?php $__currentLoopData = $consolidatedLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loan->date_entry->toFormattedDateString()); ?></td>
                            <td><?php echo e($loan->description); ?></td>
                            <td>
                              <?php if($loan->debit): ?>
                              <?php echo e(number_format($loan->debit,2,'.',',')); ?>

                              <?php else: ?>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if($loan->credit): ?>
                              <?php echo e(number_format($loan->credit,2,'.',',')); ?>

                              <?php else: ?>
                              <?php endif; ?>
                            </td>
                            <td>
                                  <?php echo e(number_format($loan->balance,2,'.',',')); ?>

                            </td>
                            <td>
                              <a href="/consolidatedLoanDeduction/edit/<?php echo e($loan->id); ?>"><i class="tiny material-icons">edit</i> </a>
                              <a href="/consolidatedLoanDeduction/remove/<?php echo e($loan->id); ?>" id="delete"> <i
                                      class="tiny material-icons red-text">delete_forever</i></a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="2">Summary</th>
                            <th ><?php echo e(number_format($user->consolidatedLoanDebitTotal($user->id),2,'.',',')); ?></th>
                            <th ><?php echo e(number_format($user->consolidatedLoanCreditTotal($user->id),2,'.',',')); ?></th>
                            <th ><?php echo e(number_format($user->consolidatedLoanBalance($user->id),2,'.',',')); ?></th>
                        </tr>
                    </tbody>
                </table>
                <?php else: ?>
                <p>No record(s) yet</p>
                <?php endif; ?>
            </div>
        </div>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>