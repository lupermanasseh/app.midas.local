<?php $__env->startSection('admin'); ?>
<h3>TARGET SAVING LISTINGS</h3>
<table cl>
    <thead>
        <tr>
            <th>NAME</th>
            <th>AMOUNT</th>
            <th>MODE</th>
            <th>DATE</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $targetSavingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <?php echo e($list->user->first_name); ?> <?php echo e($list->user->last_name); ?>

            </td>
            <td><?php echo e(number_format($list->amount,2,'.',',')); ?></td>
            <td>
                <?php echo e($list->target_saving_mode); ?>

            </td>
            <td><?php echo e($list->entry_date->toFormattedDateString()); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>