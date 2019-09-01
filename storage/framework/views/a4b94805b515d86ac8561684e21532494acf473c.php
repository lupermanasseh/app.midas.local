<?php $__env->startSection('admin'); ?>
<h3>TARGET SAVING</h3>
<p><a href="/Dashboard/user/allTargetsavings">All Target Savings</a></p>
<table cl>
    <thead>
        <tr>
            <th>Name</th>
            <th>Start Date</th>
            <th>Status</th>
            <th>History</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $targetSaving; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <?php echo e($active->user->first_name); ?> <?php echo e($active->user->last_name); ?>

            </td>
            <td><?php echo e($active->start_date); ?></td>
            <td>
                <?php echo e($active->status); ?>

            </td>
            <td><a href="/Dashboard/targetsavings/<?php echo e($active->id); ?>">History</a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>