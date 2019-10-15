<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s3">
            <h5 class="teal-text">Add Staff User</h5>
        </div>

        <form class="col s12" method="POST" action="/add/user/store">
            <?php echo e(csrf_field()); ?>


            <div class="row">
                <div class="input-field col s6">
                    <input id="password" name="password" type="password" class="validate" required>
                    <label for="password">Password</label>
                </div>

                <div class="input-field col s6">
                    <input id="password_confirmation" name="password_confirmation" type="password" class="validate"
                        required>
                    <label for="password_confirmation">Confirm Password</label>
                </div>
            </div>


            <div class="row">
                <div class="input-field col s6">
                    <input id="email" name="email" type="email" class="validate" required>
                    <label for="email">Email</label>
                </div>
                
                <div class="input-field col s6">
                    <select id="role" name="role">
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>"><?php echo e($role); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <label>Role</label>
                </div>
                
            </div>
            <div class="row">

                <div class="input-field col s6">
                    <select id="sex" name="sex">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label>Gender</label>
                </div>
                <div class="input-field col s6">
                    <input id="phone" name="phone" type="text" class="validate" required>
                    <label for="phone">Phone</label>
                </div>
                
            </div>

            <div class="row">


                <div class="input-field col s4">
                    <input id="first_name" name="first_name" type="text" class="validate" required>
                    <label for="first_name">Surname</label>
                </div>

                <div class="input-field col s4">
                    <input id="last_name" name="last_name" type="text" class="validate" required>
                    <label for="last_name">Last name</label>
                </div>
                <div class="input-field col s4">
                    <input id="other_name" name="other_name" type="text">
                    <label for="other_name">Other name</label>
                </div>

            </div>

            <button type="submit" class="btn">Create</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>