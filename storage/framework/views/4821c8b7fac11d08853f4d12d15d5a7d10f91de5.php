<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12">
            <span class="teal-text">ALL USERS</span>
        </div>

    </div>

    <div class="row">

        <div class="col s12">
            <span><a href="/New" class="btn blue">New Staff</a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($allStaff)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $allStaff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($staff->first_name); ?> <?php echo e($staff->last_name); ?></td>
                        <?php $__currentLoopData = $staff->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td><?php echo e($role->name); ?></td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <td><?php echo e($staff->email); ?></td>
                        <td><?php echo e($staff->status); ?></td>
                        <td><a href="" class="btn">Deactivate</a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No Users Created Yet</p>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>