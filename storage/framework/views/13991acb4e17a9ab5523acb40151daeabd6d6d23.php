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
            
            <td><?php echo e($loan->loan_start_date->toFormattedDateString()); ?></td>
            <td>Normal Loan Disbursement</td>
            <td><?php echo e(number_format($loan->amount_approved,2,'.',',')); ?></td>
            <td>-</td>
            <td><?php echo e(number_format($loan->amount_approved,2,'.',',')); ?>

            </td>
        </tr>
        <?php $__currentLoopData = $loanHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            
            <td><?php echo e($myItem->entry_month->toFormattedDateString()); ?></td>
            <td><?php echo e($myItem->notes); ?></td>
            
            <td>-</td>
            <td><?php echo e(number_format($myItem->amount_deducted,2,'.',',')); ?></td>
            <td><?php echo e(number_format($loan->amount_approved-$myItem->balances,2,'.',',')); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.loandeductions', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>