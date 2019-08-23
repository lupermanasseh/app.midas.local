<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">IPPIS LOAN DEDUCTION</h6>
        </div>
    </div>

    <div class="row">
        <div class="col s12 subject-header">
            <span><a class="btn" href="<?php echo e(route('default_ippis.export')); ?>"><i class="fas fa-file-excel"></i>
                    IPPIS Format XLSX</a>
            </span>
        </div>
    </div>



    <div class="row">
        <div class="col s12">
            <?php if(count($loanSub)>=1): ?>
            <?php echo $__env->make('LoanDeduction.ippisDisplay', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php else: ?>
            <p>No active records yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>