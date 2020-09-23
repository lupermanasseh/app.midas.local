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

        <?php if(count($consolidatedLoans)>=1): ?>
        <?php $__currentLoopData = $consolidatedLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            
            <td><?php echo e($myItem->date_entry->toFormattedDateString()); ?></td>
            <td><?php echo e($myItem->description); ?></td>
            <td style="text-align:right; margin-right:1em;">
              <?php if($myItem->debit): ?>
              <?php echo e(number_format($myItem->debit,2,'.',',')); ?>

              <?php else: ?>

              <?php endif; ?></td>
            <td style="text-align:right; margin-right:1em;">
            <?php if($myItem->credit): ?>
            <?php echo e(number_format($myItem->credit,2,'.',',')); ?>

            <?php else: ?>

            <?php endif; ?></td>
            <td style="text-align:right; margin-right:1em;"><?php echo e(number_format($myItem->balance,2,'.',',')); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        <tr>
            <th colspan="2">Summary</th>
            <th style="text-align:right; margin-right:1em;"><?php echo e(number_format($user->consolidatedLoanDebitTotal($user->id),2,'.',',')); ?></th>
            <th style="text-align:right; margin-right:1em;"><?php echo e(number_format($user->consolidatedLoanCreditTotal($user->id),2,'.',',')); ?></th>
            <th style="text-align:right; margin-right:1em;"><?php echo e(number_format($user->consolidatedLoanBalance($user->id),2,'.',',')); ?></th>
        </tr>


        <?php else: ?>
        <tr>
            <th colspan="5">No record(s) yet</th>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.consolidatedloandeductions', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>