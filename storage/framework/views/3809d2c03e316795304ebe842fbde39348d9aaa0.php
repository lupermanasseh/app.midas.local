<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">PHOTO IMAGE UPLAOD</h6>
        </div>
    </div>
</div>
<div class="row">
    <form class="col s12" method="POST" action="/photoStore" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="row">
            <div class="file-field input-field col s12 m6 l6">
                <div class="btn">
                    <span>Browse</span>
                    <input type="file" name="photo_image">
                    <input id="user_id" name="user_id" value="<?php echo e($id); ?>" type="hidden" class="validate" required>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Choose Photo Image">
                </div>
            </div>
        </div>
        <button type="submit" class="btn">Upload Photo</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>