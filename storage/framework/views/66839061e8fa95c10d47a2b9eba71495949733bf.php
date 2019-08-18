<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">BANK DETAIL BULK UPLOAD</span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/bank/upload/process" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="row">

                <div class="file-field input-field col s12 m6 l6">
                    <div class="btn">
                        <span>Browse</span>
                        <input type="file" name="bank_import">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Choose xlsx file">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn">Upload BANK DETAILS</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>