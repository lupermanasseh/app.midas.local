<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <h6 class="teal-text">SAVING UPLOAD SUMMARY</h6>
        </div>
    </div>

    <div class="row">
        <div class="col s12 subject-header">
            <button data-target="modal1" class="btn modal-trigger">Find Master Saving</button>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($masterRecords)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>SAVING TOTAL</th>
                        <th>POST</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $masterRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <a href="/savingMaster/listing/<?php echo e($myItem->entry_date); ?>">
                                <?php echo e($myItem->entry_date->toFormattedDateString()); ?>

                            </a>
                        </td>
                        <td><?php echo e(number_format($myItem->saving,2,'.',',')); ?></td>
                        <td>
                            <a href="/saving/distribute/<?php echo e($myItem->entry_date); ?>">POST</a>
                        </td>
                        <td>
                            <a href="/delete/savings/<?php echo e($myItem->entry_date); ?>">DELETE</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
            <?php else: ?>
            <p>No Records Available</p>
            <?php endif; ?>
        </div>
    </div>
</div>



<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>