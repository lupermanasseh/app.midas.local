 
<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">USER PRODUCT SUBSCRIPTIONS</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/product/create"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Create Product">playlist_add</i></a></span>
            <span><a href="/subscriptions"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All Subscriptions">view_list</i></a></span>
            <span><a href="/new-subscription"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="New Product Subscription">add_shopping_cart</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($userProducts)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Owner</th>
                        <th>Units</th>
                        <th>Cost</th>
                        <th>Status</th>
                        <th>Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $userProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($userProduct->product->name); ?></td>
                        <td><a href="/user/page/<?php echo e($userProduct->user->id); ?>"><?php echo e($userProduct->user->first_name); ?></a></td>
                        <td><?php echo e($userProduct->units); ?></td>
                        <td><?php echo e($userProduct->product->unit_cost); ?></td>
                        <td><?php echo e($userProduct->status); ?></td>
                        <td><?php echo e($userProduct->created_at->diffForHumans()); ?></td>
                        <td>
                            <?php if($userProduct->status=='Active'): ?> <?php else: ?>
                            <a class="btn" href="/userProdSub/edit/<?php echo e($userProduct->id); ?>"><i class="small material-icons">edit</i></a>                            <a class="btn red" id="delete" href="/userProdSub/delete/<?php echo e($userProduct->id); ?>"><i class="small material-icons">delete</i></a><?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No product Subscriptions added yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>