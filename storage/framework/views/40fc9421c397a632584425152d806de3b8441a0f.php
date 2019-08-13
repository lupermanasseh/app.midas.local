<?php $__env->startSection('admin'); ?>


<p class="paragraph">MY ACTIVITY</p>
<div>
    <?php echo $footPrints->container(); ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>