<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12">
            <h6 class="teal-text">FIND STATEMENT OF SAVINGS</h6>
        </div>

        <form class="col s12" method="POST" action="/saving/statement/process">
            <?php echo e(csrf_field()); ?>

            <div class="row">

                <div class="input-field col s12 m4 l4">
                    <input id="payment_number" name="payment_number" type="text" class="validate" required>
                    <label for="payment_number">Payment Number</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="from" name="from" type="date" class="validate" required>
                    <label for="from">From</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="to" name="to" type="date" class="validate" required>
                    <label for="to">To</label>
                </div>

            </div>

            <button type="submit" class="btn">Find</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>