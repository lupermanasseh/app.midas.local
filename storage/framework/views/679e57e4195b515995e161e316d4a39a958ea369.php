 
<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">Active Monthly Deductions</p>
            <span><a href="/"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="New Loan Subscription">playlist_add</i></a></span>
            <span><a href="/saving/search"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Search Savings">search</i></a></span>
            <span><a href="/products"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Upload Savings">cloud_upload</i></a></span>
            <span><a href="/"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All User Savings">view_list</i></a></span>
            <span><a href="/products"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All Savings">visibility</i></a></span>
            <span><a href="<?php echo e(route('usersaving.create')); ?>"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="New Savings Upload">cloud_upload</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($activeUsers)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Contributor Name</th>
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
            <?php echo e($activeUsers->links()); ?> <?php else: ?>
            <p>No Records Yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>