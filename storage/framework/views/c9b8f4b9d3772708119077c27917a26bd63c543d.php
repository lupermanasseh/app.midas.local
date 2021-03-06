<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">VERIFY BALANCES</h6>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($loans)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DISBURSEMENT DATE</th>
                        <th>REG NO</th>
                        <th>NAME</th>
                        <th>PRODUCT</th>
                        <th>AMOUNT</th>
                        <TH>BALANCE</TH>
                        <TH>ACTION</TH>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loan->findCompleteBalance($loan->id) ==0): ?>
                    <?php continue; ?>
                    <?php endif; ?>
                    <tr>
                        <td><?php echo e($loan->disbursement_date->toFormattedDateString()); ?></td>
                        <td><?php echo e($loan->user->id); ?></td>
                        <td><?php echo e($loan->user->first_name); ?>

                                <?php echo e($loan->user->last_name); ?></td>
                        <td><?php echo e($loan->product->name); ?></td>
                        <td><?php echo e(number_format($loan->amount_approved,2,'.',',')); ?></td>
                        <td><a href="/loanDeduction/history/<?php echo e($loan->id); ?>"><?php echo e(number_format($loan->findCompleteBalance($loan->id),2,'.',',')); ?></a></td>
                        <td>
                            <a href="/activate/verifyBalances/<?php echo e($loan->id); ?>" id="delete"> <i
                            class="tiny material-icons green-text tooltipped" data-position="bottom" data-tooltip="Activate Loan">check</i></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
             <?php else: ?>
            <p>No Records Available</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>