<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">ACTIVE LOANS</p>

        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/loanSub/create"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="New Loan Subscription">playlist_add</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($activeLoans)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>PRODUCT</th>
                        <th>AMOUNT</th>
                        <th>PAID</th>
                        <th>BAL</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $activeLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><a href="/user/page/<?php echo e($active->user_id); ?>"><?php echo e($active->user->first_name); ?>

                                <?php echo e($active->user->last_name); ?></a></td>
                        <td><?php echo e($active->product->name); ?></td>
                        <td><a
                                href="activeLoan/detail/<?php echo e($active->id); ?>"><?php echo e(number_format($active->amount_approved,2,'.',',')); ?></a>
                        </td>
                        <td><?php echo e(number_format($active->totalLoanDeductions($active->id),2,'.',',')); ?></td>
                        <td><?php echo e(number_format($active->amount_approved-$active->totalLoanDeductions($active->id),2,'.',',')); ?>

                        </td>
                        <td><a href="/userLoan/stop/<?php echo e($active->id); ?>" class="btn red">stop</a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($activeLoans->links()); ?> <?php else: ?>
            <p>No active loans yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>