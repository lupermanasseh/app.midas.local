<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12">
            <h6 class="teal-text">CREATE/REVIEW SAVING</h6>
        </div>

        <form class="col s12" method="POST" action="/saving/review/store">
            <?php echo e(csrf_field()); ?>

            <div class="row">

                <div class="input-field col s6">
                    <input id="user_id" name="user_id" type="hidden" value=<?php echo e($id); ?> class="validate" required>
                    <input id="amount" name="amount" type="text" class="validate" required>
                    <label for="amount">Amount</label>
                </div>
            </div>

            <button type="submit" class="btn">Register Saving</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>