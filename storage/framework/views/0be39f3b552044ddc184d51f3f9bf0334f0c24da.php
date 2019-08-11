<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">CATEGORY ITEMS</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/product/create"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Create Product">playlist_add</i></a></span>
            <span><a href="/new-subscription"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Product Subscription">add_shopping_cart</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($categoryItems)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $categoryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($product->productcategory['name']); ?></td>
                        <td><a href="/product/detail/<?php echo e($product->id); ?>"><?php echo e($product->name); ?></a></td>
                        <td><?php echo e($product->status); ?></td>
                        <?php if($product->status=='Active'): ?>
                        <td><a href="/deactivate/<?php echo e($product->id); ?>" class="red btn">Deactivate</a></td>
                        <?php else: ?>
                        <td><a href="/activate/<?php echo e($product->id); ?>" class="green btn">Activate</a></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No product for this category yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>