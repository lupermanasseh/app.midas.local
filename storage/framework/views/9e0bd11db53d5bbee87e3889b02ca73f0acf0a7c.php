<table class="highlight">
    <thead>
        <tr>

            <th>S/NO</th>
            <th>NAME</th>
            <th>USER ID</th>
            <th>PRODUCT</th>
            <th>PRODUCT ID</th>
            <th>AMOUNT</th>
            <th>SUBSCRIPTION ID</th>
            <th>DATE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $loanSub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($active->user->first_name); ?> <?php echo e($active->user->last_name); ?></td>
            <td><?php echo e($active->user_id); ?></td>
            <td><?php echo e($active->product->name); ?></td>
            <td><?php echo e($active->product_id); ?></td>
            <td><?php echo e($active->monthly_deduction); ?></td>
            <td><?php echo e($active->id); ?></td>
            <td><?php echo e(now()->toDateString()); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>