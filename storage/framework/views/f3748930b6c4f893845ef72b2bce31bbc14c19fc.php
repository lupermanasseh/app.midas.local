<?php $__env->startSection('main-content'); ?>
<div class="container">
    


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
                <?php if(count($overPaidLoans)>=1): ?>
                <div class="col s12">
                    <h6>OVER PAID  LOANS</h6>
                </div>
                <?php else: ?>
                <?php endif; ?>
            </div>


            <div class="row">
                <div class="col s12">
                    <table class="">
                        <?php if(count($overPaidLoans)>=1): ?>
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

                            <?php $__currentLoopData = $overPaidLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($myProduct->product->name); ?></td>
                                <td><?php echo e($myProduct->loan_start_date->toFormattedDateString()); ?></td>
                                <td><?php echo e($myProduct->loan_end_date->toFormattedDateString()); ?></td>
                                <td><?php echo e($myProduct->custom_tenor); ?></td>
                                <td>
                                  <?php echo e(number_format($myProduct->amount_approved+$myProduct->topup_amount,2,'.',',')); ?>

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
                                          <a href="/deactivate/loan/<?php echo e($myProduct->id); ?>" id="delete"> <i
                                                  class="tiny material-icons blue-text tooltipped" data-position="bottom" data-tooltip="Deactivate Loan">close</i></a>
                                </td>
                                <!-- <td><a data-subid="<?php echo e($myProduct->id); ?>" class="waves-effect waves-light btn modal-trigger red darken-3 transferid" href="#modal1">Debit</a> | <a data-subid="<?php echo e($myProduct->id); ?>" class="waves-effect waves-light btn modal-trigger transferid"  href="#modal2">Credit</a></td> -->
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <?php endif; ?>
                            <?php if(count($overPaidLoans)>=1): ?>
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


    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>