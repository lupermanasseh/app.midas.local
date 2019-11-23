<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">Active Members</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($activeUsers)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Saving Items</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $activeUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><a href="/saving/listings/<?php echo e($user->id); ?>"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></a></td>
                        <td><?php echo e($user->status); ?></td>
                        <td><?php echo e($user->usersavings_count); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
            <?php else: ?>
            <p>No Records Yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>