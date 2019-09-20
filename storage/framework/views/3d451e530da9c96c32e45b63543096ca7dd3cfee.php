<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">LOAN PAYMENT SCHEDULE</p>
        </div>
    </div>

    <div class="row">
        <p>

            <a href="/loan/schedule/print/<?php echo e($loan->id); ?>" class=" btn pink darken-4" target="_blank"><i
                    class="fas fa-file-pdf"></i>
                Plain File</a> |
            <a href="/loan/schedule/printpdf/<?php echo e($loan->id); ?>" class=" btn pink darken-4" target="_blank"><i
                    class="fas fa-file-pdf"></i>
                PDF</a>
        </p>
    </div>
    <div class="row">
        <div class="col s12">
            <table class="highlight">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>DATE</th>
                        <th>NAME</th>
                        <th>PRODUCT</th>
                        <th>REPYMT</th>
                        <th>AMNT</th>
                        <th>BAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo e(1); ?></td>
                        <td><?php echo e($loan->loan_start_date->toFormattedDateString()); ?></td>
                        <td><?php echo e($loan->user->first_name); ?> <?php echo e($loan->user->last_name); ?></td>
                        <td><?php echo e($loan->product->name); ?></td>
                        <td><?php echo e(number_format($loan->monthly_deduction,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($loan->monthly_deduction,2,'.',',')); ?></td>
                        <td><?php echo e(number_format($loan->amount_approved - $loan->monthly_deduction,2,'.',',')); ?>

                        </td>
                    </tr>
                    <?php for($i=2; $i<=$loan->custom_tenor; $i++): ?>
                        <tr>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e($loan->loan_start_date->addMonths($i-1)->toFormattedDateString()); ?>

                            </td>
                            <td><?php echo e($loan->user->first_name); ?> <?php echo e($loan->user->last_name); ?></td>
                            <td><?php echo e($loan->product->name); ?></td>
                            <td><?php echo e(number_format($loan->monthly_deduction,2,'.',',')); ?></td>
                            <td><?php echo e(number_format($loan->monthly_deduction*$i,2,'.',',')); ?></td>
                            <td><?php echo e(number_format($loan->amount_approved-$loan->monthly_deduction*$i,2,'.',',')); ?>

                            </td>
                        </tr>
                        <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>