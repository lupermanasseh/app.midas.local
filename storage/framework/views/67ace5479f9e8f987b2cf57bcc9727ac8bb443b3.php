<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">ACTIVE SUBSCRIPTIONS</p>

        </div>
    </div>

    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/new-subscription"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="New Product Subscription">playlist_add</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($activeSubs)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Sum NGN</th>
                        <th>Sum Repay</th>
                        <th>Balance</th>
                        <th>Begin</th>
                        <th>Expires</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $activeSubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><a href="/user/page/<?php echo e($active->user_id); ?>"><?php echo e($active->user->first_name); ?>

                                <?php echo e($active->user->last_name); ?></a></td>
                        <td><?php echo e($active->product->name); ?></td>
                        <td><?php echo e(number_format($active->total_amount,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($active->totalSubDeductions($active->id),2,'.',',')); ?></td>
                        <td><?php echo e(number_format($active->total_amount-$active->totalSubDeductions($active->id),2,'.',',')); ?>

                        </td>
                        <td><?php echo e($active->start_date->toFormattedDateString()); ?></td>
                        <td><?php echo e($active->start_date->diffForHumans($active->end_date->toFormattedDateString())); ?></td>
                        <td><a href="/product/repay/<?php echo e($active->id); ?>" class="teal-text lighten-4">Repay</a> <a
                                href="/prodSub/stop/<?php echo e($active->id); ?>" class="pink-text lighten-3">Stop</a> </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($activeSubs->links()); ?> <?php else: ?>
            <p>No Active Product Subscriptions</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>