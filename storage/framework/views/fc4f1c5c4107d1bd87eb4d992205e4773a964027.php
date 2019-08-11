<table class="highlight">
    <thead>
        <tr>

            <th>Name</th>
            <th>User ID</th>
            <th>Product</th>
            <th>Product ID</th>
            <th>Units</th>
            <th>Sub ID</th>
            <th>Monthly RePay</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $allProductSub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($active->user->first_name); ?> <?php echo e($active->user->last_name); ?></td>
            <td><?php echo e($active->user_id); ?></td>
            <td><?php echo e($active->product->name); ?></td>
            <td><?php echo e($active->product->id); ?></td>
            <td><?php echo e($active->units); ?></td>
            <td><?php echo e($active->id); ?></td>
            <td><?php echo e(number_format($active->monthly_repayment,2,'.',',')); ?></td>
            <td><a href="/product-subDetail/<?php echo e($active->id); ?>">More</a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>