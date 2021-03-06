<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="<?php echo e(asset('css/portal.css')); ?>">

    <link rel="manifest" href="/manifest.json">
    <title><?php echo e($title); ?></title>
</head>

<body>
    <div class="midas-container">
        
        <?php echo $__env->make('inc.usersignin-header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
        <div class="midas-content">

            <main class="midas-view">


                <div class="detail">
                    
                    <div class="description">
                        
                        <?php echo $__env->yieldContent('user-signin'); ?>

                    </div>


                </div>

            </main>

        </div>
    </div>

    
    <script src="<?php echo e(asset('js/promise.js')); ?>"></script>
    <script src="<?php echo e(asset('js/fetch.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>

</html>