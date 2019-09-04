<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <span class="teal-text">EDIT LOAN APPLICATIONS</span>
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="/loanSub/update/<?php echo e($lSub->id); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="input-field col s12 m4 l4">
                    <input placeholder="Reg Number" id="reg_no" value="<?php echo e($applicant_reg); ?>" name="reg_no" type="text"
                        class="validate">
                    <label for="reg_no">Applicant's Reg Number</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input placeholder="GUARANTOR Reg Number" id="guarantor_id1" name="guarantor_id1" value="<?php echo e($g1); ?>"
                        type="text" class="validate">
                    <label for="guarantor_id1">First Guarantor</label>
                </div>
                <div class="input-field col s12 m4 l4">
                    <input placeholder="GUARANTOR Reg Number" id="guarantor_id2" name="guarantor_id2" value="<?php echo e($g2); ?>"
                        type="text" class="validate">
                    <label for="guarantor_id2">Second Guarantor</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m5 l5">
                    <select id="product_cat" name="product_cat">
                        <?php $__currentLoopData = $catlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <label>Product Category</label>
                </div>
                <div class="input-field col s12 m2 l2">
                    <input id="units" name="units" value="<?php echo e($lSub->units); ?>" type="number" class="validate">
                    <label for="units">Units</label>
                    <span>Hint: <?php echo e($lSub->units); ?></span>
                </div>
                <div class="input-field col s12 m5 l5">
                    <select id="product_item" name="product_item">
                    </select>
                    <label>Product</label>
                    <span>Hint: <?php echo e($lSub->product->name); ?></span>
                </div>

            </div>

            <div class="row">
                <div class="input-field col s12 m3 l3">
                    <input id="amount_applied" name="amount_applied" value="<?php echo e($lSub->amount_applied); ?>" type="text"
                        class="validate">
                    <label for="amount_applied">Amount Applied</label>
                </div>
                <div class="input-field col s12 m3 l3">
                    <input id="net_pay" name="net_pay" type="text" value="<?php echo e($lSub->net_pay); ?>" class="validate">
                    <label for="net_pay">Net Pay</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="custom_tenor" name="custom_tenor" type="text" value="<?php echo e($lSub->custom_tenor); ?>"
                        placeholder="Eg 3 or 5 (values in months Optional)">
                    <label for="custom_tenor">Custom Tenor</label>
                </div>
            </div>

            <button type="submit" class="btn">edit Loan Request</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>