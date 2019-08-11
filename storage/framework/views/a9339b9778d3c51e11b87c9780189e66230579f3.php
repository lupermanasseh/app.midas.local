 
<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">PRODUCT SUBSCRIPTION DEDUCTION</h6>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="New Loan Subscription">playlist_add</i></a></span>
            <span><a href="/saving/search"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Search Savings">search</i></a></span>

            <span><a href="<?php echo e(route('prod-deductions.upload')); ?>"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Upload Product Deductions">cloud_upload</i></a></span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a class="btn" href="<?php echo e(route('prod-deductions.export')); ?>"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Download Product Deductions">cloud_download</i> Download</a></span>
        </div>
    </div>



    <div class="row">
        <div class="col s12">
            <?php if(count($allProductSub)>=1): ?>
    <?php echo $__env->make('ProductDeduction.viewTable',$allProductSub, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php else: ?>
            <p>No active records yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>