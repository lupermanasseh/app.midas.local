 
<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">EDIT NOK DETAILS</p>
            <span><a href="/userDetails/<?php echo e($bank->user->id); ?>"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Back To User Deatils">arrow_back</i></a></span>
            <span><a href="/user/all"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All Users">group</i></a></span>
        </div>
    </div>
    <div class="row">

        <form class="col s12" method="POST" action="/updateBank/<?php echo e($bank->id); ?>">
            <?php echo e(csrf_field()); ?> 

            <div class="row">
                <div class="input-field col s4">
                    <input id="bank_name" name="bank_name" value="<?php echo e($bank->bank_name); ?>" type="text" class="validate" required>
                    <label for="bank_name">Bank Name</label>
                </div>

                <div class="input-field col s4">
                    <input id="bank_branch" name="bank_branch" value="<?php echo e($bank->bank_branch); ?>" type="text" class="validate" required>
                    <label for="bank_branch">Bank Branch</label>
                </div>
                <div class="input-field col s4">
                    <input id="sort_code" name="sort_code" value="<?php echo e($bank->sort_code); ?>" type="text" class="validate" required>
                    <label for="sort_code">Sort Code</label>
                </div>
            </div>

            <div class="row">

                <div class="input-field col s6">
                    <input id="acct_name" name="acct_name" value="<?php echo e($bank->acct_name); ?>" type="text" class="validate">
                    <label for="acct_name">Account Name</label>
                </div>

                <div class="input-field col s6">
                    <input id="acct_number" name="acct_number" value="<?php echo e($bank->acct_number); ?>" type="text" class="validate" required>
                    <label for="acct_number">Account Number</label>
                </div>

            </div>
            <button type="submit" class="btn">Update Bank Details</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>