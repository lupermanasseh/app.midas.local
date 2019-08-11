<?php $__env->startSection('admin'); ?>
<h3>SAVING SUMMARY</h3>
<p><a href="/Dashboard/user/savings">All Savings</a></p>
<table cl>
    <thead>
        <tr>
            <th>YEAR</th>
            <th>SAVING COUNT</th>
            <th>DETAIL</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $savingSummary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year=>$savingList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <?php echo e($year); ?>

            </td>
            <td><?php echo e($savingList->count()); ?></td>
            <td><a href="/Dashboard/savings/<?php echo e($year); ?>">History</a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>