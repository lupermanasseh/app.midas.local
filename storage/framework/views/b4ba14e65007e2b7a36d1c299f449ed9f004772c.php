<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">EDIT CONSOLIDATED LOAN DEDUCTION</h6>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a class="btn" href="/user/landingPage/<?php echo e($deduction->user_id); ?>"><i class="tiny material-icons tooltipped" data-position="bottom"
                        data-tooltip="Go Back">arrow_back</i></a></span>

        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/consolidatedLoanDeduction/update/<?php echo e($deduction->id); ?>">
            <?php echo e(csrf_field()); ?>


<div class="row">

<div class="input-field col s12 m6 l6">
    <?php if($deduction->credit): ?>
    <input id="credit" name="credit" value="<?php echo e(number_format($deduction->credit,2,'.','')); ?>"
    type="number" class="validate">
    <label for="credit">Credit</label>
    <?php else: ?>
    <input disabled id="credit" name="credit" value=""
    type="number" class="validate">
    <label for="credit">Credit</label>
    <?php endif; ?>
</div>


<div class="input-field col s12 m6 l6">
    <?php if($deduction->debit): ?>
    <input id="debit" name="debit" value="<?php echo e(number_format($deduction->debit,2,'.','')); ?>"
    type="number" class="validate">
    <label for="debit">Debit</label>
    <?php else: ?>
    <input disabled id="debit" name="debit" value=""
    type="number" class="validate">
    <label for="debit">Debit</label>
    <?php endif; ?>
</div>

</div>
<div class="row">
    <div class="input-field col s12 m6 l6">
        <input id="description" name="description" value="<?php echo e($deduction->description); ?>" type="text">
        <label for="description">Description</label>
    </div>

    <div class="input-field col s12 m6 l6">
        <input id="entry_date" name="entry_date" value="<?php echo e($deduction->date_entry->toDateString()); ?>" type="date"
            class="validate">
        <label for="entry_date">Date</label>
    </div>

</div>
<button type="submit" class="btn">Save</button>
</form>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>