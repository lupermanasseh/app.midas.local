<?php $__env->startSection('admin'); ?>
<h3>Active Loans</h3>
<?php if(count($loans)>=1): ?>
<table>
    <thead>
        <tr>

            <th>Product</th>
            <th>Amount Applied</th>
            <th>Status</th>
            <th>Detail</th>
            <th>History</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>

            <td><?php echo e($active->product->name); ?></td>
            <td><?php echo e(number_format($active->amount_applied,2,'.',',')); ?></td>
            <td>
                <?php echo e($active->loan_status); ?>

            </td>
            <td><a href="/Dashboard/userloans/view/<?php echo e($active->id); ?>">Detail</a></td>
            <td><a href="/Dashboard/user/loans/<?php echo e($active->id); ?>">History</a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php else: ?>
<p>No records yet</p>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>