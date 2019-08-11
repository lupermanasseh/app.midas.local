<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">RECENT SAVING RECORDS</p>

        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($userSavings)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $userSavings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($listing->entry_date->toFormattedDateString()); ?></td>
                        <td><a href="/user/page/<?php echo e($listing->user->id); ?>"><?php echo e($listing->user->first_name); ?>

                                <?php echo e($listing->user->last_name); ?></a></td>
                        <td><?php echo e(number_format($listing->amount_saved,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($listing->amount_withdrawn,2,'.',',')); ?></td>

                        <td><?php echo e($listing->notes); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($userSavings->links()); ?> <?php else: ?>
            <p>No Records Available</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>