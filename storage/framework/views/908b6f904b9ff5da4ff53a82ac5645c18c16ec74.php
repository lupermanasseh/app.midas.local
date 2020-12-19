<header class="header">
    
    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="" class="logo"> 
    
    
    <nav class="user-nav">
        
        
        <div class="user-nav__user">
            <img src='<?php echo e(auth()->user()->photo); ?>' alt="user photo" class="user-nav__user-photo">
            <span class="user-nav__user-name"><?php if(Auth::check()): ?><?php echo e(auth()->user()->first_name); ?><?php endif; ?></span>


        </div>
    </nav>
</header>