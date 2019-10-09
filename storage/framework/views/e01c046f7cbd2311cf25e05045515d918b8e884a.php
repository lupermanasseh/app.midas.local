<table class="highlight">
    <thead>
        <tr>
            <th>REG NO</th>
            <th>NAME</th>
            <th>IPPIS NO</th>
            <th>MEMBER TYPE</th>
            <th>CLOSING DATE</th>
            <th>BALANCE</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $uniqueContributors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($listing->user_id); ?></td>
            <td><?php echo e($listing->user->first_name); ?> <?php echo e($listing->user->last_name); ?></td>
            <td><?php echo e($listing->user->payment_number); ?></td>
            <td><?php echo e($listing->user->membership_type); ?></td>
            <td><?php echo e($to); ?></td>
            <td><?php echo e(number_format($listing->userAggregateAt($savingsCollection,$listing->user_id),2,'.',',')); ?>

            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th colspan="5">Summary</th>
            <th><?php echo e(number_format($saving->savingAggregateAt($to),2,'.',',')); ?></th>
        </tr>
    </tbody>
</table>