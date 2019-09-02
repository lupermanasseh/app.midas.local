<header class="header">
    
    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="" class="logo"> 
    
    
    <nav class="user-nav">
        <div class="user-nav__icon-box">
            <svg class="user-nav__icon">
                <use xlink:href="<?php echo e(asset('images/sprite.svg#icon-bookmark')); ?>"></use>
            </svg>
            <span class="user-nav__notification">7</span>
        </div>
        <div class="user-nav__icon-box">
            <svg class="user-nav__icon">
                <use xlink:href="<?php echo e(asset('images/sprite.svg#icon-chat')); ?>"></use>
            </svg>
            <span class="user-nav__notification">13</span>
        </div>
        <div class="user-nav__user">
            <img src="<?php echo e(asset('images/boy.png')); ?>" alt="user photo" class="user-nav__user-photo">
            <span class="user-nav__user-name"><?php if(Auth::check()): ?><?php echo e(auth()->user()->first_name); ?><?php endif; ?></span>


        </div>
    </nav>
</header>