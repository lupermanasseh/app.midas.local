 
<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">Edit Saving Record</span>
            <span><a href="/"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="New Loan Subscription">playlist_add</i></a></span>
            <span><a href="/saving/search"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Search Savings">search</i></a></span>
            <span><a href="/products"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Upload Savings">cloud_upload</i></a></span>
            <span><a href="/"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All User Savings">view_list</i></a></span>
            <span><a href="/products"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All Savings">visibility</i></a></span>
            <span><a href="<?php echo e(route('usersaving.create')); ?>"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="New Savings Upload">cloud_upload</i></a></span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/saving/update/<?php echo e($Saving->id); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="input-field col s12 m12 l12">
                    <input id="amount_saved" name="amount_saved" value="<?php echo e($Saving->amount_saved); ?>" type="text" class="validate">
                    <label for="amount_saved">Amount Saved</label>
                </div>
            </div>

            <button type="submit" class="btn">Edit Saving Record</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>