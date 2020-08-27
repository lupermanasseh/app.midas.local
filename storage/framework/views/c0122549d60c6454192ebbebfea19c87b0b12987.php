<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 m6 l6 subject-header">
            <p class="teal-text">USER LOAN(S)</p>
        </div>
        <div class="col s12 m6 l6 subject-header right">
            <a href="/user/landingPage/<?php echo e($id); ?>"><i class="tiny material-icons">arrow_back</i> RETURN</a>
        </div>
    </div>


    <div class="row user-profiles">
        <div class="col s12 m12 l12  profile-detail">
            <p class="profile__heading text-grey darken-3">
                <?php echo e($allLoans->count()); ?> Loan(s) Available | <span></p>
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
                    <?php $__currentLoopData = $allLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php echo e($loan->product->name); ?>

                        </td>
                        <td>
                            <?php echo e(number_format($loan->amount_approved,2,'.',',')); ?>

                        </td>
                        <td><a
                                href="/loanDeduction/history/<?php echo e($loan->id); ?>"><?php echo e(number_format($loan->totalLoanDeductions($loan->id),2,'.',',')); ?></a>
                        </td>
                        <td><?php echo e(number_format($loan->amount_approved-$loan->totalLoanDeductions($loan->id),2,'.',',')); ?>

                        </td>
                        <td><?php echo e($loan->loan_end_date->toFormattedDateString()); ?>

                        </td>
                        <td>
                            <a href="/loanSub/stop/<?php echo e($loan->id); ?>" class="btn red">Stop</a>
                            <a href="/loan/payment/<?php echo e($loan->id); ?>" class="btn">Repay</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>