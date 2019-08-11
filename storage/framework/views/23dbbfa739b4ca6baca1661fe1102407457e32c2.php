<div class="overview">
    <h6 class="overview__heading">
        <a href="" class="overview__savings">Closing <?php echo e(number_format($totalSaving,2,'.',',')); ?></a>
    </h6>
    <span><svg class="overview__icon-star">
            <use xlink:href="<?php echo e(asset('images/sprite.svg#icon-chevron-with-circle-left')); ?>"></use>
        </svg>
    </span>
    <h6 class="overview__heading overview__push"><?php echo e(now()->toFormattedDateString()); ?></h6>

      

<div class="overview__rating">
    <div class="overview__rating-average"><a href="" class="overview__link">N
            <?php echo e(number_format($tsSaving,2,'.',',')); ?></a>
    </div>
    <div class="overview__rating-count">TS</div>
    <div class="overview__rating-count"><?php echo e(now()->toDateString()); ?></div>
</div>
</div>