<?php $__env->startSection('print-area'); ?>
<table>
    <thead>
        <tr>
            
            <th>DATE</th>
            <th>DESCRIPTION</th>
            <th>DEBIT</th>
            <th>CREDIT</th>
            <th>BAL</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            
            <td><?php if($loan->disbursement_date): ?>
            <?php echo e($loan->disbursement_date->toFormattedDateString()); ?>

            <?php else: ?>
            NOT AVAILABLE
            <?php endif; ?></td>
            <td>Normal Loan Disbursement</td>
            <td style="text-align:right; margin-right:1em;"><?php echo e(number_format($loan->amount_approved,2,'.',',')); ?></td>
            <td>-</td>
            <td style="text-align:right; margin-right:1em;"><?php echo e(number_format($loan->amount_approved,2,'.',',')); ?>

            </td>
        </tr>
        <?php if(count($loanHistory)>=1): ?>
        <?php $__currentLoopData = $loanHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            
            <td><?php echo e($myItem->entry_month->toFormattedDateString()); ?></td>
            <td><?php echo e($myItem->notes); ?></td>
            
            <td style="text-align:right; margin-right:1em;">
              <?php if($myItem->amount_debited): ?>
              <?php echo e(number_format($myItem->amount_debited,2,'.',',')); ?>

              <?php else: ?>
              -
              <?php endif; ?></td>
            <td style="text-align:right; margin-right:1em;">
            <?php if($myItem->amount_deducted): ?>
            <?php echo e(number_format($myItem->amount_deducted,2,'.',',')); ?>

            <?php else: ?>
            -
            <?php endif; ?></td>
            <td style="text-align:right; margin-right:1em;"><?php echo e(number_format($loan->amount_approved-$myItem->balances,2,'.',',')); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <tr>
            <th colspan="5">No deduction(s) for this facility yet</th>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.loandeductions', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>