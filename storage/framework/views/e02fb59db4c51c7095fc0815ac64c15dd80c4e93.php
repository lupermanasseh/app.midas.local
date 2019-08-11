<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">PRODUCT SUBSCRIPTION(s)</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/subscriptions"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Subscriptions">view_list</i></a></span>
            <span><a href="/new-subscription"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="New Product Subscription">add_shopping_cart</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($subs)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Owner</th>
                        <th>Total</th>
                        <th>Net Pay</th>
                        <th>Date Added</th>
                        <th>Action/Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($sub->product->name); ?></td>
                        <td><a href="/user/products/<?php echo e($sub->user_id); ?>"><?php echo e($sub->user->first_name); ?></a></td>
                        <td><?php echo e(number_format($sub->total_amount,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($sub->net_pay,2,'.',',')); ?></td>
                        <td><?php echo e($sub->created_at->diffForHumans()); ?></td>
                        <td>
                            <?php if($sub->status == 'Active'): ?>
                            <?php echo e($sub->status); ?>

                            <?php else: ?>
                            <a href="/prodSub/review/<?php echo e($sub->id); ?>" class="blue-text darken-2">Review</a> <a
                                href="/userProdSub/delete/<?php echo e($sub->id); ?>" class="red-text lighten-3">Discard</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($subs->links()); ?> <?php else: ?>
            <p>No product Subscriptions added yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>