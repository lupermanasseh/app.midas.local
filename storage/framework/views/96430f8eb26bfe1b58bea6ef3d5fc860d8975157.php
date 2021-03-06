<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s6">
            <h5 class="teal-text">All Next of Kin | </h5>
            <div class="divider"></div>
        </div>

    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($users)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Member</th>
                        <th>Next Of Kin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user->id); ?></td>
                        <td><?php echo e($user->last_name); ?> <?php echo e($user->first_name); ?></td>

                        <td><?php echo e($user->nok->first_name); ?> <?php echo e($user->nok->last_name); ?></td>
                        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
            <?php else: ?>
            <p>No Record Yet</p>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>