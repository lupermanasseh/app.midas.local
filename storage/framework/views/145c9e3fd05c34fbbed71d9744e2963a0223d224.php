<table class="highlight">
    <thead>
        <tr>
            <th>SERVICE ID</th>
            <th>NAME</th>
            <th>USER ID</th>
            <th>AMOUNT</th>
            <th>DATE</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $ts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            
            <td><?php echo e($item->id); ?></td>
            <td><?php echo e($item->user->first_name); ?> <?php echo e($item->user->lastname_name); ?></td>
            <td><?php echo e($item->user_id); ?></td>
            <td><?php echo e(number_format($item->monthly_saving,2,'.',',')); ?></td>
            <td><?php echo e(now()->toDateString()); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>