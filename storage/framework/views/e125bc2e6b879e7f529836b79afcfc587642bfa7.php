<figure class="review">
    <h5 class="review__heading">All Paid <a href='/Dashboard/myPaidLoans/<?php echo e(auth()->id()); ?>'><?php echo e($paid->count()); ?></a></h5>
    <h5 class="review__heading">Pending <a
            href='/Dashboard/myPendingLoans/<?php echo e(auth()->id()); ?>'><?php echo e($myPendingApp->count()); ?></a>
    </h5>
    <blockquote class="review__text">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, architecto.
    </blockquote>
    <figcaption class="review__user">
        <img src="<?php echo e(asset('images/andy.jpg')); ?>" alt="review photo" class="review__photo">
        <div class="review__user-box">
            <p class="review__user-name">Shimakaa Iorlumun</p>
            <p class="review__user-date">Feb 23rd, 2019</p>
        </div>
        <div class="review__rating">
            9.9
        </div>
    </figcaption>
</figure>
