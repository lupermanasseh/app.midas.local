<?php $__env->startSection('main-content'); ?>
<div class="container">
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">Edit Product</p>
            <span><a href="/product/create"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Create Product">playlist_add</i></a></span>
            <span><a href="/products"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Products">view_list</i></a></span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/updateProduct/<?php echo e($product->id); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="input-field col s12 m4 l4">
                    <select id="product_category" name="product_category">
                        <?php $__currentLoopData = $catlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=> $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <label>Product Category</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="product_name" name="product_name" value="<?php echo e($product->name); ?>" type="text" class="validate"
                        required>
                    <label for="product_name">Product Name</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="description" name="description" value="<?php echo e($product->description); ?>" type="text"
                        class="validate" required>
                    <label for="description">Product Description</label>
                </div>
            </div>
            <div class="row">

                <div class="input-field col s12 m4 l4">
                    <input id="unit_cost" name="unit_cost" value="<?php echo e($product->unit_cost); ?>" type="text" class="validate">
                    <label for="unit_cost">Unit Cost</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="tenor" name="tenor" type="text" value="<?php echo e($product->tenor); ?>" class="validate" required>
                    <label for="tenor">Tenor</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="interest" name="interest" type="text" value="<?php echo e($product->interest); ?>" class="validate"
                        required>
                    <label for="interest">Interest Rate</label>
                </div>
            </div>

            <button type="submit" class="btn">Update</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>