<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">POST LOAN OVER DEDUCTION</span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/loan/overdeduction"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Loan Overdeduction List">view_list</i></a></span>
        </div>
    </div>

    <div class="row user-profiles">
        <div class="col s12 m12 l12 profile">
            <p class="profile__heading text-grey darken-3">PROFILE</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name"><?php echo e($user->payment_number); ?></span>
            <span class="profile__user-name"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></span>
            <span class="profile__user-name">TOTAL CONTR
                <a
                    href="/saving/listings/<?php echo e($user->id); ?>"><?php echo e(number_format($user->totalSavings($user->id),2,'.',',')); ?></a></span>
            <span class="profile__user-name">MNTH SAVE
                <?php echo e(number_format($user->monthlySaving($user->id),2,'.',',')); ?></span>
        </div>
    </div>


    <div class="row">
        <form class="col s12" method="POST" action="/loanoverdeduction/store">
            <?php echo e(csrf_field()); ?>


            <div class="row">

                <div class="input-field col s12 m4 l4">
                    <input id="user_id" name="user_id" type="hidden" value="<?php echo e($user->id); ?>" class="validate">
                    <input id="overdeduct_id" name="overdeduct_id" type="hidden" value="<?php echo e($overdeductionObj->id); ?>" class="validate">
                    <input id="amount" name="amount" value="<?php echo e($overdeductionObj->overdeduction_amount); ?>" type="number" step=".01"
                        class="validate" disabled>
                    <label for="amount">Amount</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input id="_date" name="_date" value="<?php echo e($overdeductionObj->entry_date->toFormattedDateString()); ?>" type="text" class="validate datepicker" required disabled>
                    <label for="start_date">Date</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <select id="loan_id" name="loan_id">
                        <?php $__currentLoopData = $userActiveLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($myProduct->id); ?>"><?php echo e($myProduct->product->name); ?>/[<?php echo e(number_format($myProduct->user->singleLoanBalance($myProduct->id),2,'.',',')); ?>]</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <label>Active Loan(s)</label>
                </div>
            </div>

            <button type="submit" class="btn">Save</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>