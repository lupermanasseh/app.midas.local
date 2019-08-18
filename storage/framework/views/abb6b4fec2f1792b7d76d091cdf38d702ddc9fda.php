<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12">
            <h6 class="teal-text">CREATE/REVIEW TS-SAVING</h6>
        </div>

        <form class="col s12" method="POST" action="/new/ts/store">
            <?php echo e(csrf_field()); ?>

            <div class="row">

                <div class="input-field col s12 m4 l4">
                    <input id="user_id" name="user_id" type="hidden" value=<?php echo e($userid); ?> class="validate" required>
                    <input id="amount" name="amount" type="text" class="validate" required>
                    <label for="amount">Amount</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="start_date" name="start_date" type="text" class="validate datepicker" required>
                    <label for="start_date">Start Date</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="end_date" name="end_date" type="text" class="validate datepicker" required>
                    <label for="end_date">End Date</label>
                </div>
            </div>

            <button type="submit" class="btn">Register TS</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>