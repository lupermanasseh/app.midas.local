<?php $__env->startSection('admin'); ?>
<h3>Filtered Savings</h3>
<?php if(count($records)>=1): ?>
<span><a href="/Dashboard/print/<?php echo e($fromDate); ?>/<?php echo e($toDate); ?>" target="_blank"> <svg class="side-nav__icon">
            <use xlink:href="<?php echo e(asset('images/sprite.svg#icon-database')); ?>"></use>
        </svg>Print</a></span> | <span><a href="/Dashboard/downloadpdf/<?php echo e($fromDate); ?>/<?php echo e($toDate); ?>"
        target="_blank">Download PDF</a></span>
<table>
    <thead>
        <tr>
            <th>DATE</th>
            <th>DESCRIPTION</th>
            <th>DEBIT</th>
            <th>CREDIT</th>
            <th>BALANCE</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo e($saving->openingDate($fromDate)); ?></td>
            <td>Opening Balance</td>
            <td></td>
            <td></td>
            <td><?php echo e(number_format($saving->openingBalance($fromDate,$userObj->id),2,'.',',')); ?></td>
        </tr>
        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($list->entry_date->toFormattedDateString()); ?></td>
            <td><?php echo e($list->notes); ?></td>
            <td><?php echo e(number_format($list->amount_withdrawn,2,'.',',')); ?></td>
            <td><?php echo e(number_format($list->amount_saved,2,'.',',')); ?></td>

            <td><?php echo e(number_format($saving->balanceAsAt($list->amount_saved,$list->amount_withdrawn,$list->id,$userObj->id))); ?>

            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
</table>
<?php else: ?>
<p>No records found yet</p>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>