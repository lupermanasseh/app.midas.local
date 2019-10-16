<?php $__env->startSection('user-signin'); ?>
<div></div>
<div class="user-signinlogocontainer">
    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="" class="logo-usersignin">
</div>
<div class="user-signinform">
    <form class="user-customsearch" method="POST" action="/Dashboard/login">
        <?php echo e(csrf_field()); ?>


        <div class="user-customsearch__item"><input class="custom-input" type="text" name="username" id="username"
                placeholder="Username"></div>

        <div class="user-customsearch__item"><input class="custom-input" type="password" name="password" id="password"
                placeholder="Password"></div>

        <div class="user-customsearch__item">
            <button class="user-custom-input" type="submit">Login</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.userSigninLayout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>