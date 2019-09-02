<?php $__env->startSection('admin'); ?>



<div>
    <p class="paragraph">SAVINGS</p>
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
                    <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></td>
                <td>Savings (Contribution)</td>
                <td><?php echo e($user->status); ?></td>
                <td>
                    <a href="/Dashboard/user/savings"><?php echo e(number_format($saving->netBalance($user->id),2,'.',',')); ?></a>
                </td>
            </tr>
            <?php if(count($targetsr)>=1): ?>
            <?php $__currentLoopData = $targetsr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tsr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(substr($user->membership_type,0,1)); ?>/<?php echo e($user->id); ?></td>
                <td>
                    <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                </td>
                <td>Target Saving (Bam)</td>
                <td><?php echo e($user->status); ?></td>
                <td><a
                        href="/Dashboard/targetsavings/<?php echo e($tsr->id); ?>"><?php echo e(number_format($targetSaving->targetSavingBalance($tsr->id),2,'.',',')); ?></a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div>
    <p>LOANS</p>
    <?php if(count($activeLoans)>=1): ?>
    <table class="">
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
            </tr>
        </thead>
        <tbody>



            <?php $__currentLoopData = $activeLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(substr($user->membership_type,0,1)); ?>/<?php echo e($user->id); ?></td>
                <td>
                    <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                </td>
                <td><?php echo e($myProduct->product->name); ?></td>
                <td><?php echo e($myProduct->loan_start_date->toDateString()); ?></td>
                <td><?php echo e($myProduct->loan_end_date->toDateString()); ?></td>
                <td><?php echo e($myProduct->custom_tenor); ?></td>
                <td><?php echo e(number_format($myProduct->amount_approved,2,'.',',')); ?></td>
                <td><?php echo e(number_format($myProduct->monthly_deduction,2,'.',',')); ?></td>
                <td><a
                        href="/#/<?php echo e($myProduct->id); ?>"><?php echo e(number_format($myProduct->amount_approved-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')); ?></a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <p>No Active Loans available yet</p>
            <?php endif; ?>

            <?php if(count($activeLoans)>=1): ?>
            <tr>
                <th colspan="6">Summary</th>
                <th><?php echo e(number_format($user->totalApprovedAmount(auth()->id()),2,'.',',')); ?></th>
                <th><?php echo e(number_format($user->loanSubscriptionTotal(auth()->id()),2,'.',',')); ?></th>
                <th><?php echo e(number_format($user->allLoanBalances(auth()->id()),2,'.',',')); ?></th>
            </tr>
            <?php else: ?>
            <?php endif; ?>

        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>