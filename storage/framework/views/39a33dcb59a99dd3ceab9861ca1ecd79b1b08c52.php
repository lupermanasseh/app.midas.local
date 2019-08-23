<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">ACTIVATE LOAN</span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/approved/loans"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Pending Loans">view_list</i></a></span>
        </div>
    </div>

    <div class="row user-profiles">
        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">PAYMENT ID</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name"><?php echo e($review->user->payment_number); ?></span>
            <span class="profile__user-name"><?php echo e($review->user->first_name); ?> <?php echo e($review->user->last_name); ?></span>
            <span class="profile__user-name">TOTAL CONTR
                <a
                    href="/saving/listings/<?php echo e($review->user_id); ?>"><?php echo e(number_format($review->user->totalSavings($review->user_id),2,'.',',')); ?></a></span>
            <span class="profile__user-name">MNTH SAVE
                <?php echo e(number_format($review->user->monthlySaving($review->user_id),2,'.',',')); ?></span>
        </div>

        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">PRODUCT</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name"><?php echo e($review->product->name); ?></span>
            <span class="profile__user-name">Tenor <?php echo e($review->product->tenor); ?> [ <?php echo e($review->custom_tenor); ?> ]</span>
            <span class="profile__user-name">REQ %
                <?php echo e(number_format($review->user->requiredPercent($review->amount_applied),2,'.',',')); ?></span>
            <span class="profile__user-name">AVAIL %
                <?php echo e(number_format($review->user->availablePercent($review->user_id),2,'.',',')); ?></span>
        </div>
        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">PRODUCT SUMMARY</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name">Guarantor 1:
                <?php echo e($review->user->userInstance($review->guarantor_id)->first_name); ?> (<a
                    href="/#"><?php echo e($review->user->loanGuarantorCount($review->guarantor_id)); ?></a>)
            </span>
            <span class="profile__user-name">Guarantor 2:
                <?php echo e($review->user->userInstance($review->guarantor_id2)->first_name); ?> (<a
                    href="/#"><?php echo e($review->user->loanGuarantorCount($review->guarantor_id2)); ?></a>)
            </span>
            <span class="profile__user-name">Repayment N <?php echo e(number_format($review->monthly_deduction,2,'.',',')); ?></span>
            <span class="profile__user-name"><a href="/userLoan/discard/<?php echo e($review->id); ?>">Not sure, remove</a></span>
        </div>

        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">STATUS</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name"><?php echo e($review->loan_status); ?></span>
            <span class="profile__user-name">Active Loans <a
                    href="/user/page/<?php echo e($review->user_id); ?>"><?php echo e($review->user->activeLoans($review->user_id)); ?></a></span>
            <span class="profile__user-name">Net Pay N <?php echo e(number_format($review->net_pay,2,'.',',')); ?></span>
        </div>


    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/pay/store/<?php echo e($review->id); ?>">
            <?php echo e(csrf_field()); ?>


            <div class="row">

                <div class="input-field col s12 m6 l6">
                    <input id="sub_id" name="sub_id" type="hidden" value="<?php echo e($review->id); ?>" class="validate">
                    <input id="amount_approved" name="amount_approved" value="<?php echo e($review->amount_approved); ?>" type="text"
                        class="validate" disabled>
                    <label for="amount_approved">Amount Approved</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="start_date" name="start_date" type="text" class="validate datepicker" required>
                    <label for="start_date">Loan Start Date</label>
                </div>
            </div>

            <button type="submit" class="btn">Activate Loan</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>