 
<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">REVIEW PRODUCT SUBSCRIPTION</span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/subscriptions"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All Product Subscription">view_list</i></a></span>
        </div>
    </div>

    <div class="row user-profiles">
        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">PAYMENT ID</p>
            <p><i class="small material-icons pink-text lighten-4">looks</i></p>
            <span class="profile__user-name"><?php echo e($review->user->payment_number); ?></span>
            <span class="profile__user-name"><?php echo e($review->user->first_name); ?> <?php echo e($review->user->last_name); ?></span>

            <div class="profile__user-box">
                <span class="black-text sub-profile"></span>
                <span class="profile__user-date grey-text lighten-2"></span>
                <span class="black-text sub-profile"></span>
                <span class="profile__join-date grey-text lighten-2"></span>
            </div>
        </div>

        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">PRODUCT</p>
            <p><i class="small material-icons pink-text lighten-4">looks</i></p>
            <span class="profile__user-name"><?php echo e($review->product->name); ?></span>
            <span class="profile__user-name">Unit Cost N <?php echo e(number_format($review->product->unit_cost,2,'.','.')); ?></span>
        </div>
        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">PRODUCT SUMMARY</p>
            <p><i class="small material-icons pink-text lighten-4">looks</i></p>
            <span class="profile__user-name">Units <?php echo e($review->units); ?> (Total N <?php echo e(number_format($review->total_amount,2,'.',',')); ?>)</span>
            <span class="profile__user-name">Repayment N <?php echo e(number_format($review->monthly_repayment,2,'.',',')); ?></span>
        </div>

        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">STATUS</p>
            <p><i class="small material-icons pink-text lighten-4">looks</i></p>
            <span class="profile__user-name"><?php echo e($review->status); ?></span>
            <span class="profile__user-name">Net Pay N <?php echo e(number_format($review->net_pay,2,'.',',')); ?></span>

            <div class="profile__user-box">
                <span class="black-text sub-profile"></span>
                <span class="profile__user-date grey-text lighten-2"></span>
                <span class="black-text sub-profile"></span>
                <span class="profile__join-date grey-text lighten-2"></span>
            </div>

        </div>

    </div>



    <div class="row">
        <form class="col s12" method="POST" action="/prodSub/reviewStore/<?php echo e($review->id); ?>">
            <?php echo e(csrf_field()); ?>


            <div class="row">
                <div class="input-field col s12 m3 l3">
                    <input id="units" name="units" type="text" value="<?php echo e($review->units); ?>" class="validate">
                    <label for="units">Units</label>
                </div>

                <div class="input-field col s12 m3 l3">
                    <input id="start_date" name="start_date" type="text" class="validate datepicker" required>
                    <label for="start_date">Start Date</label>
                </div>

                <div class="input-field col s12 m3 l3">
                    <input id="end_date" name="end_date" type="text" class="validate datepicker" required>
                    <label for="end_date">End Date</label>
                </div>
                <div class="input-field col s12 m3 l3">
                    <textarea id="notes" name="notes" class="materialize-textarea validate" data-length="50"></textarea>
                    <label for="notes">Review Notes</label>
                </div>
            </div>

            <button type="submit" class="btn">Review P-SUB</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>