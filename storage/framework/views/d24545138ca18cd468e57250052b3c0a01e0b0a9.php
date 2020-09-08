<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">LOAN BY DISBURSEMENT DATES</p>
        </div>
    </div>
    <?php if(count($loanByDate)>=1): ?>
    <!-- <div class="row">
        <div class="col s12 m3 l3">
            <a href="/loanbalance/excel" class="btn">DOWNLOAD EXCEL</a>
        </div>
        <div class="col s12 m3 l3">
            <a href="/loanbalance/pdf/" target="_blank" class="btn">DOWNLOAND PDF</a>
        </div>
    </div> -->
    <?php else: ?>
    <?php endif; ?>
    <div class="row">
        <div class="col s12">
            <?php if(count($loanByDate)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>REG NO</th>
                        <th>NAME</th>
                        <th>IPPIS NO</th>
                        <th>LOAN AMOUNT</th>
                        <th>DATE</th>
                        <th>ACTION</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $loanByDate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(substr($record->user->membership_type,0,1)); ?>/<?php echo e($record->user_id); ?></td>
                        <td><?php echo e($record->user->first_name); ?> <?php echo e($record->user->last_name); ?></td>
                        <td><?php echo e($record->user->payment_number); ?></td>
                        <td><?php echo e(number_format($record->amount_approved,2,'.',',')); ?></td>
                        <td>
                          <?php if($record->disbursement_date): ?>
                          <?php echo e($record->disbursement_date); ?>

                          <?php else: ?>
                          Not Available
                          <?php endif; ?></td>
                        <td>
                          <a class="waves-effect waves-light btn modal-trigger red darken-3 transferid" data-subid="<?php echo e($record->id); ?>" href="#modal1">Edit</a>
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
<!-- Modal Structure -->
 <div id="modal1" class="modal">
   <div class="modal-content">
     <h6>EDIT DISBURSEMENT DATE</h6>
     <div class="row">
         <form class="col s12" method="POST" action="/edit/disbursementdate">
             <?php echo e(csrf_field()); ?>

             <div class="row">
               <div class="input-field col s12 m12 l12">
                 <input id="sub_id" name="sub_id" value="" type="hidden">
                   <input id="disbursement_date" name="disbursement_date" type="text" class="validate datepicker" required>
                   <label for="disbursement_date">Disbursement Date</label>
               </div>
             </div>
             <button type="submit" class="btn">Save Date</button>
         </form>
     </div>
   </div>
   <div class="modal-footer">
     <a class="modal-close waves-effect waves-green btn-flat">Close</a>
   </div>
 </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>