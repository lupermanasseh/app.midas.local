<table class="highlight">
    <thead>
        <tr>
            <th colspan="6">MIDAS TOUCH MULTIPURPOSE COOPERATIVE SOCIETY LTD</th>
        </tr>
        <tr>
            <th colspan="6">FEDERAL MEDICAL CENTER, MAKURDI</th>
        </tr>
        <tr>
            <th colspan="6">LOAN LIABILITY REPORT AS AT <?php echo e($to); ?></th>
        </tr>
        <tr>
          <th>REG NO</th>
          <th>NAME</th>
          <th>IPPIS NO</th>
          <th>CLOSING DATE</th>
          <th>BALANCE</th>
        </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $uniqueDebtors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
          <td><?php echo e(substr($listing->user->membership_type,0,1)); ?>/<?php echo e($listing->user_id); ?></td>
          <td><?php echo e($listing->user->first_name); ?> <?php echo e($listing->user->last_name); ?></td>
          <td><?php echo e($listing->user->payment_number); ?></td>
          <td><?php echo e($to); ?></td>
          <td><?php echo e($listing->userBalancesByDate($collection,$listing->user_id)); ?>

          </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php if(count($uniqueDebtors)>=1): ?>
      <tr>
          <th colspan="4">Total</th>
          <th><?php echo e($listing->consolidatedLoanBalanceAggregateAt($collection)); ?></th>
      </tr>
      <?php else: ?>
      <?php endif; ?>
    </tbody>
</table>
