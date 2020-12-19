<?php $__env->startSection('admin'); ?>
<div>

    <?php if(count($activeLoans)>=1): ?>
    <p>LOANS</p>
    <table class="">
        <thead>
            <tr>
                <!-- <th>#</th>
                <th>Name</th> -->
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
                <!-- <td><?php echo e(substr($user->membership_type,0,1)); ?>/<?php echo e($user->id); ?></td>
                <td>
                    <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                </td> -->
                <td><?php echo e($myProduct->product->name); ?></td>
                <td><?php echo e($myProduct->loan_start_date->toDateString()); ?></td>
                <td><?php echo e($myProduct->loan_end_date->toDateString()); ?></td>
                <td><?php echo e($myProduct->custom_tenor); ?></td>
                <td><?php echo e(number_format($myProduct->amount_approved+$myProduct->topup_amount,2,'.',',')); ?></td>
                <td><?php echo e(number_format($myProduct->monthly_deduction,2,'.',',')); ?></td>
                <td><a
                        href="/user/loans/<?php echo e($myProduct->id); ?>"><?php echo e(number_format($myProduct->amount_approved+$myProduct->topup_amount-$myProduct->totalLoanDeductions($myProduct->id),2,'.',',')); ?></a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <p>No Active Loans available yet</p>
            <?php endif; ?>

            <?php if(count($activeLoans)>=1): ?>
            <tr>
                <th colspan="4">Summary</th>
                <th><?php echo e(number_format($user->totalApprovedAmount(auth()->id()),2,'.',',')); ?></th>
                <th><?php echo e(number_format($user->loanSubscriptionTotal(auth()->id()),2,'.',',')); ?></th>
                <th><?php echo e(number_format($user->allLoanBalances(auth()->id()),2,'.',',')); ?></th>
            </tr>
            <?php else: ?>
            <?php endif; ?>

        </tbody>
    </table>

    <?php if(count($inactiveLoans)>=1): ?>
    <p>INACTIVE LOANS</p>
    <table class="">
        <thead>
            <tr>
                <!-- <th>#</th>
                <th>Name</th> -->
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



            <?php $__currentLoopData = $inactiveLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inactive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <!-- <td><?php echo e(substr($user->membership_type,0,1)); ?>/<?php echo e($user->id); ?></td>
                <td>
                    <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                </td> -->
                <td><?php echo e($inactive->product->name); ?></td>
                <td><?php echo e($inactive->loan_start_date->toDateString()); ?></td>
                <td><?php echo e($inactive->loan_end_date->toDateString()); ?></td>
                <td><?php echo e($inactive->custom_tenor); ?></td>
                <td><?php echo e(number_format($inactive->amount_approved+$inactive->topup_amount,2,'.',',')); ?></td>
                <td><?php echo e(number_format($inactive->monthly_deduction,2,'.',',')); ?></td>
                <td><a
                        href="/user/loans/<?php echo e($inactive->id); ?>"><?php echo e(number_format($inactive->amount_approved+$inactive->topup_amount-$inactive->totalLoanDeductions($inactive->id),2,'.',',')); ?></a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <p>No Inactive Loans available yet</p>
            <?php endif; ?>

        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>