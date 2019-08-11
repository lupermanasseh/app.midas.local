<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">EDIT PRODUCT CATEGORY</span>
            <span><a href="/product/category"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Products">view_list</i></a></span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/product/category/update/<?php echo e($category->id); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="input-field col s12">
                    <input id="category_name" name="category_name" type="text" class="validate" required
                        value="<?php echo e($category->name); ?>" placeholder="Category Name">
                </div>

                <div class="input-field col s12">
                    <input id="description" name="description" type="text" class="validate" required
                        value="<?php echo e($category->description); ?>" placeholder="Description">
                </div>
            </div>

            <button type="submit" class="btn">Edit</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>