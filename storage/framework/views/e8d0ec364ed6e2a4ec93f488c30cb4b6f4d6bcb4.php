<table class="highlight">
    <thead>
        <tr>
            <th>USER ID</th>
            <th>NAME</th>
            <th>DATE</th>
            <th>AMOUNT</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $savings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($active->user_id); ?></td>
            <td><?php echo e($active->user->first_name); ?> <?php echo e($active->user->last_name); ?></td>
            <td><?php echo e(now()->toDateString()); ?></td>
            <td><?php echo e(number_format($active->current_amount,2,'.',',')); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>