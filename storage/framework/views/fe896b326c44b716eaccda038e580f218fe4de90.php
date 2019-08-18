<table class="highlight">
    <thead>
        <tr>
            <th>NAME</th>
            <th>PRODUCT</th>
            <th>AMOUNT</th>
            <th>DUE</th>
            <th>HISTORY</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $loanSub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <a href="/user/page/<?php echo e($active->user_id); ?>"><?php echo e($active->user->first_name); ?> <?php echo e($active->user->last_name); ?></a>
            </td>
            <td><?php echo e($active->product->name); ?></td>
            <td><?php echo e(number_format($active->monthly_deduction,2,'.',',')); ?></td>
            <td>
                <?php echo e($active->loan_end_date->toFormattedDateString()); ?>


            </td>
            <td><a href="/loanDeduction/history/<?php echo e($active->id); ?>">History</a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>