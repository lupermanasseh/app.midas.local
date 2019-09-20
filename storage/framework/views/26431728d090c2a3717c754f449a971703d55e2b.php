<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row subject-header">
        <div class="col s6">
            <span class="text-teal">SEARCH RESULT</span>
        </div>
        <div class="col s6">
            <span><a href="/user/all"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Users">group</i></a></span>
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
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td><?php echo e(substr($user->membership_type,0,1)); ?>/<?php echo e($user->id); ?></td>
                        <td>
                            <a href="/userDetails/<?php echo e($user->id); ?>"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></a></td>
                        <td>Savings (Contribution)</td>
                        <td><?php echo e($user->status); ?></td>
                        <td>
                            <a
                                href="/saving/listings/<?php echo e($user->id); ?>"><?php echo e(number_format($saving->mySavings($user->id),2,'.',',')); ?></a>
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
            <h6>ACTIVE LOANS | <span> <a href="/user/page/<?php echo e($user->id); ?>" class="btn green darken-3">GOT TO
                        PRODUCT(s)</a></span></h6>

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
                        <th>#</th>
                        <th>Name</th>
                        <th>Loan Type</th>
                        <th>S/Date</th>
                        <th>E/Date</th>
                        <th>Tenor</th>
                        <th>Amt</th>
                        <th>Repymt</th>
                        <th>Bal</th>
                        <th>Schedule</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $__currentLoopData = $activeLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(substr($user->membership_type,0,1)); ?>/<?php echo e($user->id); ?></td>
                        <td>
                            <a href="/userDetails/<?php echo e($user->id); ?>"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></a>
                        </td>
                        <td><?php echo e($myProduct->product->name); ?></td>
                        <td><?php echo e($myProduct->loan_start_date->toDateString()); ?></td>
                        <td><?php echo e($myProduct->loan_end_date->toDateString()); ?></td>
                        <td><?php echo e($myProduct->custom_tenor); ?></td>
                        <td><?php echo e(number_format($myProduct->amount_approved,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($myProduct->monthly_deduction,2,'.',',')); ?></td>
                        <td><a
                                href="/loanDeduction/history/<?php echo e($myProduct->id); ?>"><?php echo e(number_format($myProduct->amount_approved-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')); ?></a>
                        </td>
                        <td><a href="/loan/schedule/<?php echo e($myProduct->id); ?>" target="_blank">Get</a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <?php endif; ?>

                    <?php if(count($activeLoans)>=1): ?>
                    <tr>
                        <th colspan="6">Summary</th>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>