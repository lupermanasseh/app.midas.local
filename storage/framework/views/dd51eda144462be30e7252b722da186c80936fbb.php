<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">FILTERED MEMBERS</h6>
        </div>
    </div>

    <?php if(count($members)>=1): ?>
    <div class="row">
        <div class="col s12">
            <span>
                <a class="btn-small purple lighten-1" href="/members/<?php echo e($status); ?>/<?php echo e($end_date); ?>/<?php echo e($cadre); ?>"><i
                        class="fas fa-file-excel"></i>
                    DOWNLOAD</a>
            </span>
            <p><?php echo e(count($members)); ?> Available</p>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col s12">
            <?php if(count($members)>=1): ?>
            <?php echo $__env->make('Registration.display', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
            <?php else: ?>
            <p>No matching records yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>