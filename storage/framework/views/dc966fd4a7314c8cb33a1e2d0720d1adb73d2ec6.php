<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12">
            <h6 class="teal-text">FIND CONSOLIDATED LOAN BALANCES</h6>
        </div>

        <form class="col s12" method="POST" action="/consolidatedLoanBalances/find">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="input-field col s12 m12 l12">
                    <input id="to" name="to" type="text" class="validate datepicker" required>
                    <label for="to">End Date</label>
                </div>
            </div>

            <button type="submit" class="btn">Find</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>