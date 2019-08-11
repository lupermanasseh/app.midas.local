<?php $__env->startSection('print-area'); ?>
<table>
    <thead>
        <tr>
            <th>DATE</th>
            <th>DESCRIPTION</th>
            <th>DEBIT (=N=)</th>
            <th>CREDIT (=N=)</th>
            <th>BALANCE (=N=)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo e($Saving->openingDate($from)); ?></td>
            <td>Openning Balance</td>
            <td></td>
            <td></td>
            <td><?php echo e(number_format($Saving->openingBalance($from,$userObj->id),2,'.',',')); ?></td>
        </tr>
        <?php $__currentLoopData = $statementCollection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($statement->entry_date->toFormattedDateString()); ?></td>
            <td>
                <?php echo e($statement->notes); ?>

            </td>
            <td><?php echo e(number_format($statement->amount_withdrawn),2,'.',','); ?></td>
            <td><?php echo e(number_format($statement->amount_saved,2,'.',',')); ?>

            </td>
            <td><?php echo e(number_format($Saving->balanceAsAt($statement->amount_saved,$statement->amount_withdrawn,$statement->id,$userObj->id),2,'.',',')); ?>

            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.print',['Saving'=>$Saving,'to'=>$to,'from'=>$from,'userObj'=>$userObj], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>