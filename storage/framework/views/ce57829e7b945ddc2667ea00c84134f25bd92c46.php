<table class="highlight">
    <thead>
        <tr>
            
            <th>IPPIS NO</th>
            <th>NAME</th>
            <th>SAVING</th>
            <th>TS</th>
            <th>AMOUNT</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $savings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            
            <td><?php echo e($active->user->payment_number); ?></td>
            <td><?php echo e($active->user->first_name); ?> <?php echo e($active->user->last_name); ?></td>
            <td><?php echo e(number_format($active->current_amount,2,'.',',')); ?></td>
            <td><?php echo e(number_format($active->tsActiveAmount($active->user_id,$ts),2,'.',',')); ?></td>
            <td><?php echo e(number_format($active->ippisSavingSum($active->current_amount,$active->tsActiveAmount($active->user_id,$ts)),2,'.',',')); ?>

            </td>

        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>