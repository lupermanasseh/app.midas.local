<table class="highlight">
    <thead>
        <tr>
            
            <th>IPPIS NO</th>
            <th>NAME</th>
            <th>SAVING</th>
            <th>TS</th>
            <th>DATE</th>
            <th>AMOUNT</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $savings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            
            <td><?php echo e($active->user->payment_number); ?></td>
            <td><?php echo e($active->user->last_name); ?> <?php echo e($active->user->first_name); ?></td>
            <td><?php echo e($active->current_amount); ?></td>
            <td><?php echo e($active->tsActiveAmount($active->user_id)); ?></td>
            <td><?php echo e(now()->toDateString()); ?></td>
            <td><?php echo e($active->current_amount + $active->tsActiveAmount($active->user_id)); ?>

            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>