<?php $__env->startSection('admin'); ?>
<h3>pending Application(s)</h3>
<?php if(count($loans)>=1): ?>
<table>
    <thead>
        <tr>

            <th>PRODUCT</th>
            <th>AMOUNT</th>
            <th>STATUS</th>
            <th>DETAIL</th>
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
            <td><a href="/Dashboard/userproducts/view/<?php echo e($active->id); ?>">Detail</a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php else: ?>
<p>No records yet</p>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>