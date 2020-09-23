<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">GUARANTOR DETAIL</span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/guarantor/dashboard"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Back">arrow_back</i></a></span>
        </div>
    </div>

    <div class="row user-profiles">
        <div class="col s12 m12 l12 profile">
            <p class="profile__heading text-grey darken-3">GUARANTOR</p>
            <!-- <span><i class="small material-icons pink-text lighten-4">looks</i></span> -->
            <span>
              <?php if($newUser->imageCount($newUser->id)===0): ?>
              <img src="/images/logo.png" class="guarantor_photo"/>
                  <?php else: ?>
                  <img src="<?php echo e($newUser->photo); ?>" alt="" class="guarantor_photo">
                  <?php endif; ?>
            </span>
            <span class="profile__user-name"><a href="/user/page/<?php echo e($newUser->id); ?>"><?php echo e($newUser->first_name); ?>

                    <?php echo e($newUser->last_name); ?></a></span>
            <span class="profile__user-name"><?php echo e($newUser->payment_number); ?></span>
            <span class="profile__user-name">TOTAL CONTR
                <?php echo e(number_format($newUser->totalSavings($newUser->id),2,'.',',')); ?></span>
            <span class="profile__user-name">MNTH SAVE
                <?php echo e(number_format($newUser->monthlySaving($newUser->id),2,'.',',')); ?></span>
        </div>

        <!-- <div class="col s12 m6 l6 profile">
            <p class="profile__heading text-grey darken-3">INDEBTEDNESS</p>
            <span><i class="small material-icons pink-text lighten-4">looks</i></span>
            <span class="profile__user-name">Deductions <a href="/loanDeduction/history/<?php echo e($newUser->id); ?>">
              </a></span>
            <span class="profile__user-name">Repayment =N=
                </span>
            <span class="profile__user-name">Balance
                </span>
        </div> -->

    </div>


    <div class="row user-profiles">
        <div class="col s12 m9 l9 profile-detail">

                <p class="profile__heading text-grey darken-3">Loans Guaranteed</p>



                <table class="highlight">
                    <thead>
                        <tr>
                            <th>REG</th>
                            <th>MEMBER</th>
                            <TH>PRODUCT</TH>
                            <TH>LOAN BAL</TH>
                            <TH>LIABILITY</TH>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $firstGuarantor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $firstg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(substr($firstg->user->membership_type,0,1)); ?>/<?php echo e($firstg->user_id); ?></td>
                            <td><?php echo e($firstg->user->first_name); ?> <?php echo e($firstg->user->last_name); ?></td>
                            <td><?php echo e($firstg->product->name); ?></td>
                            <td><?php echo e(number_format($firstg->user->singleLoanBalance($firstg->id),2,'.',',')); ?></td>
                            <td><?php echo e(number_format($firstg->user->singleLoanBalance($firstg->id)/2,2,'.',',')); ?></td>
                            <td><?php echo e($firstg->loan_status); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $secondGuarantor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $secondg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                              <td><?php echo e(substr($secondg->user->membership_type,0,1)); ?>/<?php echo e($secondg->user_id); ?></td>
                              <td><?php echo e($secondg->user->first_name); ?> <?php echo e($secondg->user->last_name); ?></td>
                              <td><?php echo e($secondg->product->name); ?></td>
                              <td><?php echo e(number_format($secondg->user->singleLoanBalance($secondg->id),2,'.',',')); ?></td>
                              <td><?php echo e(number_format($secondg->user->singleLoanBalance($secondg->id)/2,2,'.',',')); ?></td>
                              <td><?php echo e($secondg->loan_status); ?>

                              </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php if(count($firstGuarantor)>=1 OR count($secondGuarantor)>=1 ): ?>
                          <tr>
                              <th colspan="3">Summary</th>

                              <th><?php echo e(number_format($newSubObj->totalLiability($newUser->id)*2,2,'.',',')); ?></th>
                              <th><?php echo e(number_format($newSubObj->totalLiability($newUser->id),2,'.',',')); ?></th>
                          </tr>
                          <?php else: ?>
                          <?php endif; ?>
                    </tbody>
                </table>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>