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
                    <input id="reg_number" name="reg_number" type="text" placeholder="e.g 78" class="validate" required>
                    <label for="reg_number">Registration Number</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="from" name="from" type="text" class="validate datepicker" required>
                    <label for="from">Start Date</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="to" name="to" type="text" class="validate datepicker" required>
                    <label for="to">End Date</label>
                </div>

            </div>

            <button type="submit" class="btn">Find</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>