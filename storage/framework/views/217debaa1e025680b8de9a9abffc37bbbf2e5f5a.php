<?php $__env->startSection('user-signin'); ?>
<div></div>
<div class="user-signinlogocontainer">
    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="" class="logo-usersignin">
</div>
<div class="user-signinlogocontainer">
    <span>Hi, <?php echo e(auth()->user()->first_name); ?>, change your password!</span>
</div>
<div class="user-signinlogocontainer">
    <?php if(count($errors)>0): ?> <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <p class="red-text darken-3"><?php echo e($error); ?></p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
</div>
<div class="user-signinform">
    <form class="user-customsearch" method="POST" action="/Dashboard/onboarding/<?php echo e(auth()->user()->id); ?>">
        <?php echo e(csrf_field()); ?>


        <div class="user-customsearch__item"><input class="custom-input" type="password" name="password"
                class="validate" id="password" required placeholder="new password"></div>

        <div class="user-customsearch__item"><input class="custom-input" type="password" name="password_confirmation"
                class="validate" id="password_confirmation" placeholder="confirm password"></div>

        <div class="user-customsearch__item">
            <button class="user-custom-input" type="submit">change</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.userSigninLayout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>