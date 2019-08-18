<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">LOAN DEDUCTION</h6>
        </div>
    </div>

    <?php if(count($loanSub)>=1): ?>
    <div class="row">
        <div class="col s12">
            <span>
                <a class="btn-small purple lighten-1" href="/midasFilterExcel/<?php echo e($start_date); ?>/<?php echo e($end_date); ?>"><i
                        class="fas fa-file-excel"></i>
                    MIDAS EXCEL</a>
            </span>
            <span>
                <a class="btn-small purple lighten-1" href="/filterExcel/<?php echo e($start_date); ?>/<?php echo e($end_date); ?>"><i
                        class="fas fa-file-excel"></i>
                    IPPIS EXCEL</a>
            </span>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col s12">
            <?php if(count($loanSub)>=1): ?>
            <?php echo $__env->make('LoanDeduction.display', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php else: ?>
            <p>No active records yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>