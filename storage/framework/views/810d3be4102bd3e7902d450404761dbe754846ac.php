<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">LOAN GUARANTORS</span>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/pendingLoans"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Pending Loans">view_list</i></a></span>
        </div>
    </div> -->

    <div class="row user-profiles">
        <?php $__currentLoopData = $uniqueGuarantors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guarantor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col s12 m3 l3 profile">
          <p class="profile__heading text-grey darken-3">REG: <?php echo e($guarantor); ?></p>
            <p class="profile__heading text-grey darken-3"><?php echo e($review->user->userInstance($guarantor)->first_name); ?> <?php echo e($review->user->userInstance($guarantor)->last_name); ?></p>
            <!-- <span><i class="small material-icons pink-text lighten-4">looks</i></span> -->
            <span>
              <?php echo e(number_format($review->totalLiability($guarantor),2,'.',',')); ?>

            </span>
            <!-- <span>
              <?php if($review->imageCount($guarantor)===0): ?>
              <img src="/images/logo.png" class="guarantor_photo"/>
                  <?php else: ?>
                  <img src="<?php echo e($review->user->userInstance($guarantor)->photo); ?>" alt="" class="guarantor_photo">
                  <?php endif; ?>
            </span> -->
            <span class="profile__user-name">
              Total Loans Guaranteed
            </span>
            <span class="profile__user-name">
              <a  class="guarantor_count" href="/guarantor/Details/<?php echo e($guarantor); ?>"><?php echo e($review->loanGuarantorCount($guarantor)); ?></a>
            </span>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>