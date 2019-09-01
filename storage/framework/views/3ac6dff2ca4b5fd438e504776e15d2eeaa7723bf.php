<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s5">
            <h5 class="teal-text">User Bank Details</h5>
        </div>

        <form class="col s12" method="POST" action="/bankStore">
            <?php echo e(csrf_field()); ?>

            <div class="row">

                <div class="input-field col s6">
                    <input id="user_id" name="user_id" value="<?php echo e($id); ?>" type="hidden" class="validate" required>
                </div>

            </div>

            <div class="row">
                <div class="input-field col s12 m4 l4">
                    <input id="bank_name" name="bank_name" type="text" class="validate" required>
                    <label for="bank_name">Bank Name</label>
                </div>

                
                <div class="input-field col s12 m4 l4">
                    <input id="acct_number" name="acct_number" type="text" class="validate" required>
                    <label for="acct_number">Account Number</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="sort_code" name="sort_code" type="text" class="validate" required>
                    <label for="sort_code">Bank Code</label>
                </div>
            </div>

            <div class="row">
                
            </div>



            <button type="submit" class="btn">Save Bank Details</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>