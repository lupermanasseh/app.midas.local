<?php $__env->startSection('admin'); ?>
<p>LOAN DETAILS</p>
<div class="user-profiles">
    <div class="profile">
        <div class="myloandetail">
            <p class="review__rating">PRODUCT DETAILS</p>
            <span>Product Name: <?php echo e($userLoan->product->name); ?></span>
            <span>Tenor: <?php echo e($userLoan->product->tenor); ?> [ <?php echo e($userLoan->custom_tenor); ?> ]</span>
            <span>Amount Applied: <?php echo e(number_format($userLoan->amount_applied,2,'.',',')); ?></span>
            <span>Amount Approved: <?php echo e(number_format($userLoan->amount_approved,2,'.',',')); ?></span>
        </div>
    </div>
</div>

<div class="user-profiles">
    <div class="profile">
        <div class="myloandetail">
            <p class="review__rating">PAYMENT SUMMARY</p>
            <span>Total Deductions: <?php echo e(number_format($userLoan->totalLoanDeductions($userLoan->id),2,'.',',')); ?></span>
            <span>Balance:
                <?php echo e(number_format($userLoan->amount_approved-$userLoan->totalLoanDeductions($userLoan->id),2,'.',',')); ?></span>

            <span>Repayment:
                <?php echo e(number_format($userLoan->monthly_deduction,2,'.',',')); ?></span>

        </div>
    </div>
</div>

<div class="user-profiles">
    <div class="profile">
        <div class="myloandetail">
            <p class="review__rating">STATUS DETAILS</p>
            <span>Status: <?php echo e($userLoan->loan_status); ?></span>
            <span>Due Date:
                <?php echo e($userLoan->loan_start_date->diffForHumans($userLoan->loan_end_date->toFormattedDateString())); ?></span>
            <span>End Date:
                <?php echo e($userLoan->loan_end_date->toFormattedDateString()); ?></span>
        </div>
    </div>
</div>

<div class="user-profiles">

    <div class="profile-detail">

        <div>
            <p class="review__rating">Loan Guarantors</p>
            <table>
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>Payment#</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo e($userLoan->user->userInstance($userLoan->guarantor_id)->first_name); ?>

                            <?php echo e($userLoan->user->userInstance($userLoan->guarantor_id)->last_name); ?>

                        </td>
                        <td><?php echo e($userLoan->user->userInstance($userLoan->guarantor_id)->payment_number); ?>

                        </td>
                        <td><?php echo e($userLoan->user->userInstance($userLoan->guarantor_id)->phone); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo e($userLoan->user->userInstance($userLoan->guarantor_id2)->first_name); ?>

                            <?php echo e($userLoan->user->userInstance($userLoan->guarantor_id2)->last_name); ?>

                        </td>
                        <td><?php echo e($userLoan->user->userInstance($userLoan->guarantor_id2)->payment_number); ?>

                        </td>
                        <td><?php echo e($userLoan->user->userInstance($userLoan->guarantor_id2)->phone); ?>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>