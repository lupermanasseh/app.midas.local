<?php $__env->startSection('main-content'); ?> 
<h5>MIDAS TOUCH MULTIPURPOSE COOPERATIVE SOCIETY DASHBOARD</h5>
<div class="row">


    <div class="col s12 m6 l6">
        <div class="card-panel pink-text center">
            <i class="fas fa-user-friends"></i>
            <div>
                <h6>Membership Spread</h6>
                <?php echo $chart->container(); ?>

            </div>
        </div>
    </div>

    <div class="col s12 m6 l6">
        <div class="card-panel  pink-text center">
            <i class="fas fa-plus-circle"></i>
            <div>
                <h6>Loan Status</h6>
                <?php echo $item->container(); ?>

            </div>
        </div>
    </div>

    

    
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>