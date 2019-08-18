<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">USER PRODUCT(S)</p>
        </div>
    </div>


    <div class="row user-profiles">
        <div class="col s12 m3 l3 profile">
            
            <p class="profile__heading text-grey darken-3">Personal Details</p>

            <a href="/userDetails/<?php echo e($user->id); ?>"><img src="<?php echo e($user->photo); ?>" alt="profile img"
                    class="profile__photo"></a>
            <span><a href="/photo/<?php echo e($user->id); ?>" class="pink-text darken-2">Edit Photo</a></span>

            



            <span class="profile__user-name"><?php echo e($user->title); ?></span>
            <span class="profile__user-name"><a href="/userDetails/<?php echo e($user->id); ?>"><?php echo e($user->first_name); ?>

                    <?php echo e($user->last_name); ?></a></span>
            <div class="profile__user-box">
                <span class="black-text sub-profile">Savings</span>
                <span class="profile__user-date grey-text lighten-2"><a href="/saving/listings/<?php echo e($user->id); ?>">N
                        <?php echo e(number_format($saving->mySavings($user->id),2,'.',',')); ?></a></span>
                
            </div>
            <p><a href="/saving/withdraw/<?php echo e($user->id); ?>" class="btn pink darken-4"> 25% withdrawal</a></p>
            <p><a href="" class="btn red lighten-2"> Full withdrawal</a></p>

            
        </div>

        <div class="col s12 m9 l9 profile-detail">

            <div>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Staff #</th>
                            <th>Payment #</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo e($user->staff_no); ?></td>
                            <td><?php echo e($user->payment_number); ?></td>
                            <td><?php echo e($user->phone); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <?php if($activeLoans->count() >=1 ): ?>
    <div class="row user-profiles">
        <div class="col s12 m12 l12  profile-detail">
            <p class="profile__heading text-grey darken-3">
                <?php echo e($user->activeLoans($user->id)); ?> Active Loan(s) | <span><a href="" class="pink-text darken-2">ALL
                        LOANS</a></span></p>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Prin.</th>
                        <th>Paid</th>
                        <th>Bal</th>
                        <th>Due</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $activeLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <a href="/activeLoan/detail/<?php echo e($active->id); ?>"><?php echo e($active->product->name); ?></a>
                        </td>
                        <td>
                            <?php echo e(number_format($active->amount_approved,2,'.',',')); ?>

                        </td>
                        <td><a
                                href="/loanDeduction/history/<?php echo e($active->id); ?>"><?php echo e(number_format($active->totalLoanDeductions($active->id),2,'.',',')); ?></a>
                        </td>
                        <td><?php echo e(number_format($active->amount_approved-$active->totalLoanDeductions($active->id),2,'.',',')); ?>

                        </td>
                        <td><?php echo e($active->loan_end_date->toFormattedDateString()); ?>

                        </td>
                        <td>
                            <a href="/loanSub/stop/<?php echo e($active->id); ?>" class="btn red">Stop</a>
                            <a href="/loan/payment/<?php echo e($active->id); ?>" class="btn">Repay</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

    </div>
    <?php else: ?> <?php endif; ?>


    <?php if($pendingLoans->count() >=1): ?>
    <div class="row user-profiles">
        <div class="col s12 m12 l12  profile-detail">
            <p class="profile__heading text-grey darken-3">
                <?php echo e($user->pendingLoans($user->id)); ?> Pending Application(s) </p>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Amount (NGN)</th>
                        <th>Date Applied</th>
                        <th>Required 30%</th>
                        <th>Available 30%</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $pendingLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><a href="/pendingApp/detail/<?php echo e($pending->id); ?>"><?php echo e($pending->product->name); ?></a></td>
                        <td><?php echo e(number_format($pending->amount_applied,2,'.',',')); ?></td>
                        <td><?php echo e($pending->created_at->toDateString()); ?></td>
                        <td><?php echo e(number_format($pending->user->requiredPercent($pending->amount_applied), 2,'.',',')); ?></td>
                        <td><?php echo e(number_format($pending->user->availablePercent($pending->user_id), 2,'.',',')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

    </div>
    <?php else: ?>
    <p>User has no pending loan applications</p>
    <span><a href="/loanSub/create" class="btn green">New Loan</a></span>
    <?php endif; ?>

    <?php if($targetsr->count() >=1): ?>
    <div class="row user-profiles">
        <div class="col s12 m12 l12  profile-detail">
            <p class="profile__heading text-grey darken-3">
                Available Target Saving Subscription(s) </p>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Date Reg</th>
                        <th>Amount (NGN)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $targetsr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tsr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($tsr->created_at->toDateString()); ?></td>
                        <td><a href="/tsSub/detail/<?php echo e($tsr->id); ?>"><?php echo e(number_format($tsr->monthly_saving,2,'.',',')); ?></a>
                        </td>
                        <td><?php echo e($tsr->status); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <p><a href="/ts/withdrawal/<?php echo e($user->id); ?>" class="btn pink darken-3">WITHDRAW</a> <a
                href="/new/ts/<?php echo e($user->id); ?>" class="btn">New TS</a></p>
    </div>
    <?php else: ?>
    <p>No available Target Saving subscriptions</p>
    <p><a href="/new/ts/<?php echo e($user->id); ?>" class="btn">Regiser New TS</a></p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>