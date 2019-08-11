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
            <img src="<?php echo e(url('storage/photos/'.$user->photo)); ?>" alt="" class="profile__photo">
            <span class="profile__user-name"><?php echo e($user->title); ?></span>
            <span class="profile__user-name"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></span>
            <div class="profile__user-box">
                <span class="black-text sub-profile">Birth Date</span>
                <span class="profile__user-date grey-text lighten-2"><?php echo e($user->dob->toFormattedDateString()); ?></span>
                <span class="black-text sub-profile">Joined Since</span>
                <span class="profile__join-date grey-text lighten-2"><?php echo e($user->created_at->diffForHumans()); ?></span>
                <span class="black-text sub-profile">Sex</span>
                <span class="profile__user-status grey-text lighten-2"><?php echo e($user->sex); ?></span>
            </div>

            <span><a href="/editProfile/<?php echo e($user->id); ?>" class="pink-text darken-2">Edit</a></span>
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
        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">Active Loans</p>
            <p><i class="small material-icons pink-text darken-4">wc</i></p>
            <span class="profile__user-name"><?php echo e($user->activeLoans($user->id)); ?></span>
            <span class="profile__user-name"></span>
            <div class="profile__user-box">
                <span class="black-text sub-profile"></span>
                <span class="profile__user-status grey-text lighten-2"></span>
            </div>
            <span><a href="" class="pink-text darken-2">All Payment History</a></span>
        </div>

        <div class="col s12 m9 l9 blue lighten-4  profile-detail">
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Principal NGN</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                        <th>History</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $activeLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><a
                                href="/activeLoan/detail/<?php echo e($active->id); ?>"><?php echo e(number_format($active->amount_approved,2,'.',',')); ?></a>
                        </td>
                        <td><?php echo e($active->loan_start_date->toFormattedDateString()); ?></td>
                        <td><?php echo e($active->loan_start_date->diffForHumans($active->loan_end_date->toFormattedDateString())); ?>

                        </td>
                        <td>
                            <a href="/userLoan/stop/<?php echo e($active->id); ?>">Stop</a>
                            <a href="/loan/repay/<?php echo e($active->id); ?>">Pay</a>
                        </td>
                        <td><a href="/loanDeduction/history/<?php echo e($active->id); ?>">View</a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

    </div>
    <?php else: ?> <?php endif; ?>

    <div class="row user-profiles">
        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">Pending Application(s)</p>
            <p><i class="small material-icons pink-text lighten-4">looks</i></p>
            <span class="profile__user-name"><?php echo e($user->pendingLoans($user->id)); ?></span>
            <span class="profile__user-name"></span>

            <div class="profile__user-box">
                <span class="black-text sub-profile">Total Contribution</span>
                <span class="profile__user-date grey-text lighten-2">NGN
                    <?php echo e(number_format($user->totalSavings($user->id)), 2, '.',','); ?></span>
                <span class="black-text sub-profile">Monthly Contribution</span>
                <span class="profile__join-date grey-text lighten-2">
                    NGN <?php echo e(number_format($user->monthlySaving($user->id), 2,'.',',')); ?>

                </span>
            </div>
            
        </div>
        <div class="col s12 m9 l9 pink lighten-4 profile-detail">
            <?php if($pendingLoans->count() >=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Amount (NGN)</th>
                        <th>Required 30%</th>
                        <th>Available 30%</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $pendingLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(number_format($pending->amount_applied,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($pending->user->requiredPercent($pending->amount_applied), 2,'.',',')); ?></td>
                        <td><?php echo e(number_format($pending->user->availablePercent($pending->user_id), 2,'.',',')); ?></td>
                        <td><a href="/userLoan/review/<?php echo e($pending->id); ?>">Review</a> <a
                                href="/userLoan/discard/<?php echo e($pending->id); ?>">Discard</a> </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>User has no loan applications</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>