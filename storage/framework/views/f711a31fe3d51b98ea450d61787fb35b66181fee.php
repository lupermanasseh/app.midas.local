<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">EDIT PROFILE DETAILS</p>
            <span><a href="/userDetails/<?php echo e($user->id); ?>"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Back To User Deatils">arrow_back</i></a></span>
            <span><a href="/user/all"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Users">group</i></a></span>
        </div>
    </div>
    <div class="row">

        <form class="col s12" method="POST" action="/updateProfile/<?php echo e($user->id); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="input-field col s6">
                    <input id="staff_no" name="staff_no" value="<?php echo e($user->staff_no); ?>" type="text" class="validate"
                        required>
                    <label for="staff_no">ID Card Number</label>
                </div>

                <div class="input-field col s6">
                    <input id="payment_number" name="payment_number" value="<?php echo e($user->payment_number); ?>" type="text"
                        class="validate" required>
                    <label for="payment_number">Payment Number</label>
                </div>

            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="email" name="email" type="email" value="<?php echo e($user->email); ?>" class="validate" required>
                    <label for="email">Email</label>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('all')): ?>
                <div class="input-field col s6">
                    <select id="role" name="role">
                        <option value="" selected disabled>Cooperator</option>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>"><?php echo e($role); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <label>System Role</label>
                </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="input-field col s4">
                    <select id="title" name="title">
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Miss">Miss</option>
                        <option value="Dr">Dr</option>
                    </select>
                    <label>Title</label>
                </div>

                <div class="input-field col s4">
                    <select id="sex" name="sex">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label>Gender</label>
                </div>
                <div class="input-field col s4">
                    <select id="marital_status" name="marital_status">
                        <option value="Married">Married</option>
                        <option value="Single">Single</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widow">Widow</option>
                        <option value="Widower">Widower</option>
                    </select>
                    <label>Marital Status</label>
                </div>
            </div>

            <div class="row">


                <div class="input-field col s4">
                    <input id="first_name" name="first_name" value="<?php echo e($user->first_name); ?>" type="text" class="validate"
                        required>
                    <label for="first_name">Surname</label>
                </div>

                <div class="input-field col s4">
                    <input id="last_name" name="last_name" value="<?php echo e($user->last_name); ?>" type="text" class="validate"
                        required>
                    <label for="last_name">Last name</label>
                </div>
                <div class="input-field col s4">
                    <input id="other_name" name="other_name" value="<?php echo e($user->other_name); ?>" type="text">
                    <label for="other_name">Other name</label>
                </div>

            </div>
            <div class="row">
                <div class="input-field col s4">
                    <select id="member_type" name="member_type">
                        <option value="Ordinary">Ordinary</option>
                        <option value="Associate">Associate</option>
                    </select>
                    <label>Membership Type</label>
                </div>
                <div class="input-field col s4">
                    <select id="employ_type" name="employ_type">
                        <option value="Permanent">Permanent</option>
                        <option value="Temporal">Temporal</option>
                        <option value="Temporal">MIDAS Permanent</option>
                    </select>
                    <label>Employment Type</label>
                </div>
                <div class="input-field col s4">
                    <select id="job_cadre" name="job_cadre">
                        <option value="Senior">Senior</option>
                        <option value="Junior">Junior</option>
                    </select>
                    <label>Job Cadre</label>
                </div>

            </div>

            <div class="row">

                <div class="input-field col s4">
                    <input id="dept" name="dept" value="<?php echo e($user->dept); ?>" type="text" class="validate" required>
                    <label for="dept">Dept</label>
                </div>

                <div class="input-field col s4">
                    <input id="phone" name="phone" value="<?php echo e($user->phone); ?>" type="text" class="validate" required>
                    <label for="phone">Phone</label>
                </div>
                <div class="input-field col s4">
                    <input id="dob" name="dob" value="<?php echo e($user->dob); ?>" type="text" class="validate datepicker" required>
                    <label for="dob">DOB</label>
                </div>

            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="home_add" name="home_add" value="<?php echo e($user->home_add); ?>" type="text" class="validate"
                        required>
                    <label for="home_add">Home Address</label>
                </div>
                <div class="input-field col s6">
                    <input id="res_add" name="res_add" value="<?php echo e($user->res_add); ?>" type="text" class="validate" required>
                    <label for="res_add">Residential Address</label>
                </div>
            </div>

            <button type="submit" class="btn">Update Profile</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>