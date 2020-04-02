<?php $__env->startSection('signin-content'); ?>

<div class="container">
    <div class="row center-align">
        <div class="col s12 m8 offset-m2 l6 offset-l3">
            <p><a href="/"><img height="60" src="<?php echo e(asset('images/logo.png')); ?>" alt="logo"></a></p>
            <h5 class="teal-text">Sign In</h5>
        </div>
    </div>
    <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card-panel white">

            <form class="" method="POST" action="/signin">
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="input-field col s10 offset-s1">
                        <input id="email" name="email" type="text" class="validate" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col s10 offset-s1">
                        <input id="password" name="password" type="password" class="validate" required>
                        <label for="password">Password</label>
                    </div>


                </div>
                <div class="row center-align">
                    <div class="col s12 m8 offset-m2 l6 offset-l3">
                        <button type="submit" class="waves-effect waves-light waves-red btn-small red darken-4">Sign
                            In</button>
                    </div>
                </div>
            </form>

            <div class="row center-align">
                <div class="col s12 m8 offset-m2 l6 offset-l3">
                    <a href="/Dashboard/login">Member Login</a>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.signinLayout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>