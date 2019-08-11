<div class="row">

    <div class="col s12 m8 offset-m2 l6 offset-l3">
        <?php if(count($errors)>0): ?> <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <p class="red-text darken-3"><?php echo e($error); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
    </div>
     
</div>

 