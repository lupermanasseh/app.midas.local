<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12">
            <h6 class="teal-text">NEW SAVING DEPOSIT</h6>
        </div>

        <form class="col s12" method="POST" action="/saving/store">
            <?php echo e(csrf_field()); ?>

            <div class="row">

                <div class="input-field col s12 m4 l4">
                    <input id="user_id" name="user_id" type="hidden" value=<?php echo e($userid); ?> class="validate" required>
                    <input id="amount" name="amount" type="text" class="validate" required>
                    <label for="amount">Amount</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="date" name="date" type="text" class="validate datepicker" required>
                    <label for="date">Date</label>
                </div>

                <div class="input-field col s12 m4 l4">
                    <input id="notes" name="notes" type="text" class="validate" required>
                    <label for="notes">Description</label>
                </div>
            </div>

            <div class="row">

                <div class="input-field col s12 m3 l3">
                    <input id="bank" name="bank" type="text" class="validate" required>
                    <label for="bank">Bank</label>
                </div>

                <div class="input-field col s12 m3 l3">
                    <input id="bank_add" name="bank_add" type="text" class="validate" required>
                    <label for="bank_add">Bank Adress</label>
                </div>

                <div class="input-field col s12 m3 l3">
                    <input id="depositor" name="depositor" type="text" class="validate" required>
                    <label for="depositor">Depositor</label>
                </div>
                <div class="input-field col s12 m3 l3">
                    <input id="teller" name="teller" type="text" class="validate" required>
                    <label for="teller">Teller</label>
                </div>
            </div>

            <button type="submit" class="btn">save now</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>