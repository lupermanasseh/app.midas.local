<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">RECENT MASTER LOAN DEDUCTION(s)</h6>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($loanMaster)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>NAME</th>
                        <th>IPPIS</th>
                        <th>TOTAL AMOUNT</th>
                        <th>CREATED</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $loanMaster; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($myItem->entry_date->toFormattedDateString()); ?></td>
                        <td><?php echo e($myItem->name); ?></td>
                        <td><?php echo e($myItem->ippis_no); ?></td>
                        <td><?php echo e(number_format($myItem->cumulative_amount,2,'.',',')); ?></td>
                        <td><?php echo e($myItem->created_at->diffForHumans()); ?></td>
                        <td>
                            <a href="/loan/distribute/<?php echo e($myItem->id); ?>" class="btn green darken-3 post-looan">Post
                                Loan</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No Records Available</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>