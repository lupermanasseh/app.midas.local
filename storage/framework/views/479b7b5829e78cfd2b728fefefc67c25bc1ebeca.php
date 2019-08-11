<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">PRODUCT DETAILS</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/category/items/<?php echo e($product->productcategory->id); ?>"><i class="small material-icons tooltipped"
                        data-position="bottom" data-tooltip="Return">arrow_back</i></a></span>
            <span><a href="/products"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Products">view_list</i></a></span>
        </div>
    </div>

    <div class="row user-profiles">
        <div class="col s12 m3 l3 profile">
            
            <p class="profile__heading text-grey darken-3">Bird View</p>
            
            

            <div class="profile__user-box">
                <span class="black-text sub-profile">Category</span>
                <span class="profile__user-status grey-text lighten-2"><?php echo e($product->productcategory->name); ?></span>
                <span class="black-text sub-profile">Interest Rate</span>
                <span class="profile__user-status grey-text lighten-2"><?php echo e($product->interest); ?></span>
                <span class="black-text sub-profile">Added On</span>
                <span class="profile__user-date grey-text lighten-2">
                    <?php echo e($product->created_at->toFormattedDateString()); ?>

                </span>
                <span><a href="/editProduct/<?php echo e($product->id); ?>" class="pink-text darken-2">Edit</a></span>
                <span class="black-text sub-profile">Subscriptions</span>
                <h4 class="profile__join-date grey-text lighten-2"><?php echo e($product->productSubCount($product->id)); ?></h4> 
            </div>
            <span><a href="/p-sub/<?php echo e($product->id); ?>" class="pink-text darken-2">More</a></span>
        </div>
        <div class="col s12 m9 l9 profile-detail">
            <?php if($product): ?>
            <div>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Unit Cost</th>
                            <th>Tenor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo e($product->name); ?></td>
                            <td><?php echo e($product->description); ?></td>
                            <td><?php echo e(number_format($product->unit_cost,2,'.','.')); ?></td>
                            <td><?php echo e($product->tenor); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <p>No Record Added Yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>