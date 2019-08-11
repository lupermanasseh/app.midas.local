<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">TS SERACH RESULT</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($recentTs)>=1): ?>
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
                    <?php $__currentLoopData = $recentTs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->entry_date->toFormattedDateString()); ?></td>
                        <td><a href="/user/page/<?php echo e($item->user->id); ?>"><?php echo e($item->user->first_name); ?>

                                <?php echo e($item->user->last_name); ?></a></td>
                        <td><?php echo e(number_format($item->amount,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($item->withdrawal,2,'.',',')); ?></td>
                        <td>
                            <a href="/targetsaving/edit/<?php echo e($item->id); ?>"><i class="small material-icons">edit</i> </a> <a
                                href="/targetsaving/remove/<?php echo e($item->id); ?>" id="delete"> <i
                                    class="small material-icons red-text">delete</i></a>
                        </td>

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($recentTs->links()); ?> <?php else: ?>
            <p>No Records Available</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>