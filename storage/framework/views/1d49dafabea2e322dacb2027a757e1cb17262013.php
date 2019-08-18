<table class="highlight">
    <thead>
        <tr>
            <th>NAME</th>
            <th>SEX</th>
            <th>REG NO</th>
            <th>STAFF NO</th>
            <th>PHONE</th>
            <th>DEPT</th>
            <th>CADRE</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <?php echo e($active->first_name); ?> <?php echo e($active->last_name); ?>

            </td>
            <td><?php echo e($active->sex); ?></td>
            <td><?php echo e($active->membership_type); ?>/<?php echo e($active->id); ?></td>
            <td><?php echo e($active->staff_no); ?></td>
            <td><?php echo e($active->phone); ?></td>
            <td><?php echo e($active->dept); ?></td>
            <td><?php echo e($active->job_cadre); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>