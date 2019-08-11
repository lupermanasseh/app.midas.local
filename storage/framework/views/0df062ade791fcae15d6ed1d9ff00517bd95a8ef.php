<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">PENDING SUBSCRIPTIONS</p>

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
            <?php if(count($pendingSubs)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Created On</th>
                        <th>Status</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $pendingSubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><a href="/user/page/<?php echo e($pending->user_id); ?>"><?php echo e($pending->user->first_name); ?>

                                <?php echo e($pending->user->lastname_name); ?></a></td>
                        <td><?php echo e($pending->product->name); ?></td>
                        <td><?php echo e($pending->created_at->toFormattedDateString()); ?></td>
                        <td><?php echo e($pending->status); ?></td>
                        <td><a href="/prodSub/review/<?php echo e($pending->id); ?>">Review</a> <a
                                href="/userProdSub/delete/<?php echo e($pending->id); ?>" class="red-text darken-4">Discard</a> </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($pendingSubs->links()); ?> <?php else: ?>
            <p>No Pending Product Subscriptions</p>
            <span><a href="/prodSub/active" class="btn grey">View Active Product Subscription(s)</a></span>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>