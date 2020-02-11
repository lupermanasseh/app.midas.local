<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s6">
            <h5 class="teal-text">All Bank Details | </h5>
            <div class="divider"></div>
        </div>

    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($users)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Acct Name</th>
                        <th>Bank</th>
                        <th>Acct Number</th>
                        
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user->last_name); ?> <?php echo e($user->first_name); ?> <?php echo e($user->other_name); ?></td>
                        <td></td>
                        <td><?php echo e($user->bank->bank_name); ?></td>
                        <td><?php echo e($user->bank->acct_number); ?></td>
                        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($users->links()); ?> <?php else: ?>
            <p>No Records Yet</p>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>