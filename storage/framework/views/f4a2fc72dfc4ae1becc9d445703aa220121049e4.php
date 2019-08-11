<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <h class="teal-text">LOAN REPAYMENT</h>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/user/page/<?php echo e($subscription->user->id); ?>"><i class="small material-icons tooltipped"
                        data-position="bottom" data-tooltip="Go Back">arrow_back</i></a></span>

        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/loanRepay/store">
            <?php echo e(csrf_field()); ?>


            <div class="row">
                <div class="input-field col s12 m2 l2">
                    <input id="sub_id" name="sub_id" value="<?php echo e($subscription->id); ?>" type="hidden">
                    <input id="amount" name="amount" type="text" class="validate">
                    <label for="amount">Enter Amount</label>
                </div>
                <div class="input-field col s12 m2 l2">
                    <input id="teller_number" name="teller_number" type="text" class="validate">
                    <label for="teller_number">Teller Number</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="bank_name" name="bank_name" type="text" class="validate">
                    <label for="bank_name">Bank Name</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="bank_add" name="bank_add" type="text" class="validate">
                    <label for="bank_add">Bank Add</label>
                </div>
            </div>
            <div class="row">

                <div class="input-field col s12 m4 l4">
                    <input id="depositor_name" name="depositor_name" type="text" class="validate">
                    <label for="depositor_name">Depositor Name</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="entry_date" name="entry_date" type="text" class="validate datepicker">
                    <label for="entry_date">Date</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="notes" name="notes" type="text" class="validate">
                    <label for="notes">Notes</label>
                </div>
            </div>

            <button type="submit" class="btn">Repay Loan</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>