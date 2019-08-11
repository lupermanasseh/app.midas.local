<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">LOAN HISTORY</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($loanHistory)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $loanHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->entry_month->toFormattedDateString()); ?></td>
                        <td><a href="/user/page/<?php echo e($item->user_id); ?>"><?php echo e($item->user->first_name); ?></a></td>
                        <td><?php echo e($item->product->name); ?></td>
                        <td><?php echo e(number_format($item->amount_deducted,2,'.',',')); ?></td>
                        <td><?php echo e($item->notes); ?></td>

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>