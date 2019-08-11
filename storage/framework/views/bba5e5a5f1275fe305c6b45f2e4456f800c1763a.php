<?php $__env->startSection('admin'); ?>
<p>PRODUCT SUBSCRIPTION DETAILS</p>
<div class="user-profiles">
    <div class="profile">
        <div class="myloandetail">
            <p class="review__rating">PRODUCT DETAILS</p>
            <span>Product Name: <?php echo e($products->product->name); ?></span>
            <span>Tenor: <?php echo e($products->product->tenor); ?></span>
            <span>Total Amount: <?php echo e(number_format($products->amount_applied,2,'.',',')); ?></span>
            <span>Monthly Payment: <?php echo e(number_format($products->monthly_deduction,2,'.',',')); ?></span>
        </div>
    </div>
</div>

<div class="user-profiles">
    <div class="profile">
        <div class="myloandetail">
            <p class="review__rating">STATUS DETAILS</p>
            <span>Status: <?php echo e($products->loan_status); ?></span>
            
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>