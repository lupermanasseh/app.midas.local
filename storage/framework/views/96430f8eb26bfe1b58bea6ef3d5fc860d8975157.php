 
<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row subject-header">
        <div class="col s6">
            <h5 class="teal-text">All Next of Kin | </h5>
            <div class="divider"></div>
        </div>
        <div class="col s6">
            <h5 class="teal-text"><a href="/Nok"><i class="material-icons">add</i> New</a></h5>
            <div class="divider"></div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($users)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Surname</th>
                        <th>Last Name</th>
                        <th>Next Of Kin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user->first_name); ?></td>
                        <td><?php echo e($user->last_name); ?></td>
                        <td><a href="/user/userDetails/<?php echo e($user->id); ?>"><?php echo e($user->nok->first_name); ?></a></td>
                        <td><a class="waves-effect waves-light btn-small  blue darken-1" href="/userNokEdit/<?php echo e($user->nok->id); ?>"><i class="material-icons tiny">mode_edit</i></a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($users->links()); ?> <?php else: ?>
            <p>No Record Yet</p>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>