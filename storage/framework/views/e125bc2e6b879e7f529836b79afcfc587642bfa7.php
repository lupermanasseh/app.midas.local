<figure class="review">
    <h5 class="review__heading">All Paid <a href='/Dashboard/myPaidLoans/<?php echo e(auth()->id()); ?>'><?php echo e($paid->count()); ?></a></h5>
    <h5 class="review__heading">Pending <a
            href='/Dashboard/myPendingLoans/<?php echo e(auth()->id()); ?>'><?php echo e($myPendingApp->count()); ?></a>
    </h5>
    <blockquote class="review__text">
        <?php echo $calendar->calendar(); ?>

    </blockquote>
    
</figure>
