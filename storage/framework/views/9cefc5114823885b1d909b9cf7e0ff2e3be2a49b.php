<?php $__env->startSection('admin'); ?>
<h3>Loan Deductions</h3>
<?php if(count($deductions)): ?>
<table>
    <thead>
        <tr>
            <th>DATE</th>
            <th>PRODUCT</th>
            <th>AMOUNT</th>
            <th>DESC</th>

        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $deductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($list->entry_month->toFormattedDateString()); ?></td>
            <td>
                <?php echo e($list->product->name); ?>

            </td>
            <td><?php echo e(number_format($list->amount_deducted,2,'.',',')); ?></td>
            <td>
                <?php echo e($list->notes); ?>

            </td>

        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php echo e($deductions->links()); ?><?php else: ?>
<p>No records yet</p>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>