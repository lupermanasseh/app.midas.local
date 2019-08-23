<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">SAVING SEARCH RESULT</p>
        </div>
    </div>

    <div class="row">
        <p><a href="/statement/printfile/<?php echo e($fromDate); ?>/<?php echo e($toDate); ?>/<?php echo e($user_id); ?>" class="btn green darken-4"
                target="_blank"><i class="fas fa-file-alt"></i> FILE</a> | <a
                href="/statement/printpdf/<?php echo e($fromDate); ?>/<?php echo e($toDate); ?>/<?php echo e($user_id); ?>" class=" btn pink darken-4"
                target="_blank"><i class="fas fa-file-pdf"></i> PDF</a> <strong>[ =N=
                <?php echo e(number_format($saving->netBalance($user_id),2,'.',',')); ?> ]</strong>
        </p>
    </div>
    <div class="row">
        <div class="col s12">
            <?php if(count($result)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>NAME</th>
                        <th>DESCRIPTION</th>
                        <th>DEBIT</th>
                        <th>CREDIT</th>
                        <th>BALANCE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo e($saving->openingDate($fromDate)); ?></td>
                        <td></td>
                        <td>Openning Balance</td>
                        <td></td>
                        <td></td>
                        <td><?php echo e(number_format($saving->openingBalance($fromDate,$userObj->id),2,'.',',')); ?></td>
                    </tr>
                    <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($myItem->entry_date->toFormattedDateString()); ?></td>
                        <td><a href="/user/page/<?php echo e($myItem->user->id); ?>"><?php echo e($myItem->user->first_name); ?>

                                <?php echo e($myItem->user->last_name); ?></a></td>
                        <td>
                            <?php echo e($myItem->notes); ?>

                        </td>
                        <td><?php echo e(number_format($myItem->amount_withdrawn,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($myItem->amount_saved,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($saving->balanceAsAt($myItem->amount_saved,$myItem->amount_withdrawn,$myItem->id,$userObj->id),2,'.',',')); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No Records Available</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>