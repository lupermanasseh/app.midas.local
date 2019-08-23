<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">SAVING RECORDS</p>

        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($recentUploads)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $recentUploads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($myItem->entry_date->toFormattedDateString()); ?></td>
                        <td><a href="/user/page/<?php echo e($myItem->user->id); ?>"><?php echo e($myItem->user->first_name); ?>

                                <?php echo e($myItem->user->last_name); ?></a></td>
                        <td><?php echo e(number_format($myItem->amount_saved,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($myItem->amount_withdrawn,2,'.',',')); ?></td>
                        <td>
                            <a href="/saving/edit/<?php echo e($myItem->id); ?>"><i class="small material-icons">edit</i> </a> <a
                                href="/saving/remove/<?php echo e($myItem->id); ?>" id="delete"> <i
                                    class="small material-icons red-text">delete</i></a>
                        </td>

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($recentUploads->links()); ?> <?php else: ?>
            <p>No Records Available</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>