<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">APPROVED LOANS</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($approvedLoans)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Amount Req</th>
                        <th>Amount Rev</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $approvedLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><a href="/user/page/<?php echo e($pending->user_id); ?>"><?php echo e($pending->user->first_name); ?>

                                <?php echo e($pending->user->last_name); ?></a></td>
                        <td><?php echo e($pending->product->name); ?></td>
                        <td><?php echo e(number_format($pending->amount_applied,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($pending->amount_approved,2,'.',',')); ?></td>
                        <td><?php echo e($pending->loan_status); ?></td>
                        <td><?php echo e($pending->review_comment); ?></td>
                        
                        <td><a href="/pay/loan/<?php echo e($pending->id); ?>" class="btn blue darken-3">Pay Loan</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($approvedLoans->links()); ?> <?php else: ?>
            <p>No approved loan applications yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>