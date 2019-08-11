 
<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row subject-header">
        <div class="col s6">
            <span class="text-teal">ALL USERS</span>
        </div>
        <div class="col s6">
            <span><a href="/New"><i class="small material-icons">person_add</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($users)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Surname</th>
                        <th>Last Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><a href="/userDetails/<?php echo e($user->id); ?>"><?php echo e($user->first_name); ?></a></td>
                        <td><?php echo e($user->last_name); ?></td>
                        <td><?php echo e($user->status); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($users->links()); ?> <?php else: ?>
            <p>No Users Created Yet</p>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>