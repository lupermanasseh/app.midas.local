<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?famaily=Open+Sans:300,400,600">
    <link rel="stylesheet" href="<?php echo e(asset('css/print.css')); ?>">
    <title>MIDAS- Prints:: <?php echo e($title); ?></title>
    <script language="Javascript1.2">
        function printpage() {
            window.print();
            }
    </script>
</head>

<body onload="printpage()">
    <div class="midas-container">
        <header class="header">
            <section class="midas-item-container">
                <img src="<?php echo e(asset('images/logo2.png')); ?>" alt="" class="logo">
                <div class="midas-item-wrapper">
                    <span class="profile-item">1 Hospital Road, Mission Ward</span>
                    <span class="profile-item">Makurdi, Benue State</span>
                    <span class="profile-item">mindastouch@gmail.com</span>
                    <span class="profile-item">www.midastouchonline.co</span>
                    <span class="profile-item">+234 81-1890-1411</span>
                </div>
            </section>

            <section class="statement-notification">
                <span class="profile-name">Period</span>
                
                <span class="profile-item">Printed On: <?php echo e(now()->toFormattedDateString()); ?></span>
            </section>
        </header>
        <section class="statement-title">
            <h4>CONSOLIDATED LOAN DEDUCTION HISTORY</h4>
        </section>

        <section class="header-content">
            <div class="membership-details precision-left">
                <span class="profile-item">Name: <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                    <?php echo e($user->other_name); ?></span>
                <span class="profile-item">Membership No: <?php echo e($user->membership_type); ?>/<?php echo e($user->id); ?></span>
            </div>
            <div class="membership-details precision-right">
                 <!-- <span class="profile-item">
                  </span>
                <span class="profile-item">Tenor:
                     Mnths</span>
                <span class="profile-item">Monthly Rpymt:

                </span>
                <span class="profile-item">Start Date:

                </span>
                <span class="profile-item">End Date:

                </span>  -->
            </div>
        </section>
        <section class="print-area">
            <?php echo $__env->yieldContent('print-area'); ?>
        </section>

    </div>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>

</html>
