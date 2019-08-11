<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">PENDING LOANS</p>

        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">

            <span><a href="/loanSub/create"><i class="small material-icons blue-text lighten-4 tooltipped"
                        data-position="bottom" data-tooltip="New Loan Subscription">playlist_add</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($pendingLoans)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Amount NGN</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $pendingLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><a href="/user/page/<?php echo e($pending->user_id); ?>"><?php echo e($pending->user->first_name); ?>

                                <?php echo e($pending->user->last_name); ?></a></td>
                        <td><?php echo e($pending->product->name); ?></td>
                        <td><?php echo e(number_format($pending->amount_applied,2,'.',',')); ?></td>
                        <td><?php echo e($pending->created_at->toFormattedDateString()); ?></td>
                        <td><a href="/userLoan/review/<?php echo e($pending->id); ?>" class="btn pink lighten-3">Review</a> <a
                                href="/loanSub/edit/<?php echo e($pending->id); ?>" class="btn blue">Edit</a> <a
                                href="/userLoan/discard/<?php echo e($pending->id); ?>" class="btn red darken-4"
                                id="delete">Discard</a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($pendingLoans->links()); ?> <?php else: ?>
            <p>No pending loan applications yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>