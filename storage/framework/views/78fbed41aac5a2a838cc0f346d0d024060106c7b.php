<?php $__env->startSection('admin'); ?>
<h3>MY SAVINGS</h3>
<?php if(count($saving)>=1): ?>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Transaction Details</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $saving; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <?php echo e($active->entry_date->toFormattedDateString()); ?>

            </td>
            <td>
                <?php echo e($active->notes); ?>

            </td>
            <td>
                <?php echo e(number_format($active->amount_withdrawn,2,'.',',')); ?>

            </td>
            <td>
                <?php echo e(number_format($active->amount_saved,2,'.',',')); ?>

            </td>
            <td><?php echo e(number_format($active->balanceAsAt($active->amount_saved,$active->amount_withdrawn,$active->id,auth()->id()))); ?>

            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php else: ?>
<p>No records yet</p>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>