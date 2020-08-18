<?php $__env->startSection('print-area'); ?>
<table>
    <thead>
        <tr>
            <th style="text-align:right; margin-right:1em;">DATE</th>
            <th style="text-align:left; margin-left:1em;">DESCRIPTION</th>
            <th style="text-align:right; margin-right:1em;">DEBIT</th>
            <th style="text-align:right; margin-right:1em;">CREDIT</th>
            <th style="text-align:right; margin-right:1em;">BAL</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align:right; margin-right:1em;"><?php echo e($Saving->openingDate($from)); ?></td>
            <td style="text-align:left; margin-left:1em;">Openning Balance</td>
            <td></td>
            <td></td>
            <td style="text-align:right; margin-right:1em;">
                <?php echo e(number_format($Saving->openingBalance($from,$userObj->id),2,'.',',')); ?></td>
        </tr>
        <?php $__currentLoopData = $statementCollection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="text-align:right; margin-right:1em;"><?php echo e($statement->entry_date->toFormattedDateString()); ?></td>
            <td style="text-align:left; margin-right:1em;">
                <?php echo e($statement->notes); ?>

            </td>
            <td style="text-align:right; margin-right:1em;"><?php echo e(number_format($statement->amount_withdrawn),2,'.',','); ?>

            </td>
            <td style="text-align:right; margin-right:1em;"><?php echo e(number_format($statement->amount_saved,2,'.',',')); ?>

            </td>
            
            <td style="text-align:right; margin-right:1em;">
                <?php echo e(number_format($statement->balances,2,'.',',')); ?>

            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.print',['Saving'=>$Saving,'to'=>$to,'from'=>$from,'userObj'=>$userObj], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>