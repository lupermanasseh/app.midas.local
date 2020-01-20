<table class="highlight">
    <thead>
        <tr>

            <th>S/NO</th>
            <th>IPPIS NUMBER</th>
            <th>NAME</th>
            <th>AMOUNT</th>
            <th>ENTRY DATE</th>
            <th>END DATE</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $loanSub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($active->user->payment_number); ?></td>
            <td><a href="/user/page/<?php echo e($active->user_id); ?>"><?php echo e($active->user->first_name); ?> <?php echo e($active->user->last_name); ?></a>
            </td>
            <td><?php echo e($active->totalIppisDeductions($active->user_id,$activeLoans)); ?></td>
            
            <td></td>
            <td><?php echo e($active->loanEndDate($active->user_id)->toFormattedDateString()); ?>

            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>