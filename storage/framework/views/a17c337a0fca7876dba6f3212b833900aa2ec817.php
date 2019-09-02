<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?famaily=Open+Sans:300,400,600">
    <link rel="stylesheet" href="<?php echo e(asset('css/portal.css')); ?>">
    <title>MIDAS- User Dashboard:: <?php echo e($title); ?></title>
</head>

<body>
    <div class="midas-container">
        
        <?php echo $__env->make('inc.dashboard-header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
        <div class="midas-content">
            
            <?php echo $__env->make('inc.dashboard-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
            <main class="midas-view">
                
                <?php echo $__env->make('inc.dashboard-overview', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('inc.dashboard-search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                
                <div class="detail">
                    
                    <div class="description">
                        
                        <?php echo $__env->yieldContent('admin'); ?>

                        <div class="recommend">
                            
                        </div>
                    </div>
                    
                    

                </div>
                

                
            </main>

        </div>
    </div>

    
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset( 'js/echarts.min.js')); ?> "></script>
    

</body>

</html>