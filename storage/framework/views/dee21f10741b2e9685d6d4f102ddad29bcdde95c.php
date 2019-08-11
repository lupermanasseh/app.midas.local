<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">NEW PRODUCT SUBSCRIPTION</span>
        </div>
    </div>

    <div class="row">
        <div class="col s12 subject-header">

            <span><a href="/subscriptions"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Subscription">view_list</i></a></span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/productsub">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="input-field col s12 m2 l2">
                    <input placeholder="IPPIS #" id="payment_id" name="payment_id" type="text" class="validate">
                    <label for="payment_id">Payment ID</label>
                </div>
                
                <div class="input-field col s12 m5 l5">
                    <select id="product_cat" name="product_cat">
                        <?php $__currentLoopData = $catlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <label>Product Category</label>
                </div>

                <div class="input-field col s12 m5 l5">
                    <select id="product_item" name="product_item">
                    </select>
                    <label>Product</label>
                </div>
            </div>

            <div class="row">

                <div class="input-field col s12 m6 l6">
                    <input id="units" name="units" type="text" class="validate" placeholder="Units Optional">
                    <label for="units">Units</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="net_pay" name="net_pay" type="text" class="validate">
                    <label for="net_pay">Net Pay</label>
                </div>
            </div>
            <button type="submit" class="btn">Subscribe</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>