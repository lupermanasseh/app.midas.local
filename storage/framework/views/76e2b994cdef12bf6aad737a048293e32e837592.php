<?php $__env->startSection('user-signin'); ?>
<div></div>
<div class="user-signinlogocontainer">
    <p>Oops! Something went wrong</p>
    
</div>

<div class="user-signinform">
    <div class="user-customsearch__item">
        <p><a href="/Dashboard">Home</a></p>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.userSigninLayout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>