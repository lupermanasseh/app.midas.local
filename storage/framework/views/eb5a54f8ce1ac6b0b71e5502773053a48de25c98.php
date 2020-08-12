<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">LON PAYMENT OPTIONS</span>
        </div>
    </div>
    <div class="row user-profiles">
        <div class="col s12 m6 l6 profile">
            <p class="profile__heading text-grey darken-3">DIRECT BANK DEPOSIT</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name"><a href="/bank/repay/<?php echo e($id); ?>">BEGIN</a></span>
        </div>
        <div class="col s12 m6 l6 profile">
            <p class="profile__heading text-grey darken-3">SAVINGS</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name"><a href="/saving/repay/<?php echo e($id); ?>">BEGIN</a></span>
        </div>
        
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>