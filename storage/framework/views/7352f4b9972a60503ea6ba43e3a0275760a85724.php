<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">MEMBER SAVING LIABILITY</p>
        </div>
    </div>
    <?php if(count($uniqueContributors)>=1): ?>
    <div class="row">
        <div class="col s12 m3 l3">
            <a href="/savingliability/excel/<?php echo e($to); ?>" class="btn">DOWNLOAD EXCEL</a>
        </div>
        <div class="col s12 m3 l3">
            <a href="/savingliability/pdf/<?php echo e($to); ?>" target="_blank" class="btn">DOWNLOAND PDF</a>
        </div>
    </div>
    <?php else: ?>
    <?php endif; ?>
    <div class="row">
        <div class="col s12">
            <?php if(count($uniqueContributors)>=1): ?>
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
                    <?php if(count($uniqueContributors)>=1): ?>
                    <tr>
                        <th colspan="5">Summary</th>
                        <th><?php echo e(number_format($saving->savingAggregateAt($to),2,'.',',')); ?></th>
                    </tr>
                    <?php else: ?>
                    <?php endif; ?>
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