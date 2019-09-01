<?php $__env->startSection('admin'); ?>
<h3>ALL TARGET SAVINGS</h3>
<?php if(count($saving)>=1): ?>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>AMOUNT</th>
            <th>MODE</th>
            <th>DATE</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $saving; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <?php echo e($active->user->first_name); ?> <?php echo e($active->user->last_name); ?>

            </td>
            <td>
                <?php echo e(number_format($active->amount,2,'.',',')); ?>

            </td>
            <td>
                <?php echo e($active->target_saving_mode); ?>

            </td>
            <td><?php echo e($active->entry_date->toFormattedDateString()); ?></td>

        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php echo e($saving->links()); ?> <?php else: ?>
<p>No records yet</p>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>