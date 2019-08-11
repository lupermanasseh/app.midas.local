<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12">
            <h6 class="teal-text">SEARCH TS</h6>
        </div>

        <form class="col s12" method="POST" action="/ts/search/process">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <input id="from" name="from" type="text" class="validate datepicker" required>
                    <label for="from">From</label>
                </div>

                <div class="input-field col s12 m6 l6">
                    <input id="to" name="to" type="text" class="validate datepicker" required>
                    <label for="to">To</label>
                </div>

            </div>

            <button type="submit" class="btn">search</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>