<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">ACTIVE MONTHLY DEDUCTIONS</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a class="btn" href="<?php echo e(route('usersaving.export')); ?>"><i class="fas fa-arrow-circle-down"></i> Download
                </a></span>
        </div>
    </div>



    <div class="row">
        <div class="col s12">
            <?php if(count($savings)>=1): ?>
            <?php echo $__env->make('MonthlySaving.savingsTable',$savings, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?>
            <p>No active saving records yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>