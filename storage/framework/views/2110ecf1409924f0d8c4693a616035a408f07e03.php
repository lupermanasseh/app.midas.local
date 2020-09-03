<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">EDIT LOAN DEDUCTION</h6>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/loanDeduction/listings"><i class="tiny material-icons tooltipped" data-position="bottom"
                        data-tooltip="Go Back">arrow_back</i></a></span>

        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/loanDeduction/update/<?php echo e($deduction->id); ?>">
            <?php echo e(csrf_field()); ?>

            
<div class="row">
    

<div class="input-field col s12 m3 l3">
    <input id="credit" name="credit" value="<?php echo e(number_format($deduction->amount_deducted,3,'.','')); ?>" type="text" class="validate">
    <label for="credit">Credit</label>
</div>

<div class="input-field col s12 m3 l3">
    <input id="debit" name="debit" value="<?php echo e(number_format($deduction->amount_debited,3,'.','')); ?>" type="text" class="validate">
    <label for="debit">Debit</label>
</div>
<div class="input-field col s12 m3 l3">
    <input id="bank_name" name="bank_name" value="<?php echo e($deduction->bank_name); ?>" type="text" class="validate">
    <label for="bank_name">Bank Name</label>
</div>

<div class="input-field col s12 m3 l3">
    <input id="depositor_name" name="depositor_name" value="<?php echo e($deduction->depositor_name); ?>" type="text">
    <label for="depositor_name">Depositor Name</label>
</div>

</div>
<div class="row">

    <div class="input-field col s12 m4 l4">
        <input id="teller_number" name="teller_number" value="<?php echo e($deduction->teller_no); ?>" type="text">
        <label for="teller_number">Teller Number</label>
    </div>

    <div class="input-field col s12 m4 l4">
        <input id="description" name="description" value="<?php echo e($deduction->notes); ?>" type="text">
        <label for="description">Description</label>
    </div>

    <div class="input-field col s12 m4 l4">
        <input id="entry_date" name="entry_date" value="<?php echo e($deduction->entry_month->toDateString()); ?>" type="date"
            class="validate">
        <label for="entry_date">Date</label>
    </div>

    <!-- <div class="input-field col s12 m4 l4">
        <input id="subid" name="subid" value="<?php echo e($deduction->lsubscription_id); ?>" type="hidden"
            class="validate">

    </div> -->
</div>

<!-- <div class="row">
    <div class="input-field col s12 m6 l6">
        <select id="mode" name="mode">
            <option value="IPPIS">IPPIS</option>
            <option value="Bank">Bank</option>
        </select>
        <label>Payment Mode</label>
        <span>Hint: <?php echo e($deduction->repayment_mode); ?></span>
    </div>
</div> -->

<button type="submit" class="btn">Save</button>
</form>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>