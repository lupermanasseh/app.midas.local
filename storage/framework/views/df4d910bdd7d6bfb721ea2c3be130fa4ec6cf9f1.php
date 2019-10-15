<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s3">
            <h5 class="teal-text">New User</h5>
        </div>

        <form class="col s12" method="POST" action="/Create">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="input-field col s6">
                    <input id="staff_no" name="staff_no" type="text" class="validate" required>
                    <label for="staff_no">ID Card Number</label>
                </div>

                <div class="input-field col s6">
                    <input id="payment_number" name="payment_number" type="text" class="validate" required>
                    <label for="payment_number">IPPIS Number</label>
                </div>

            </div>
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
            <div class="row">
                <div class="input-field col s3">
                    <select id="member_type" name="member_type">
                        <option value="Ordinary">Ordinary</option>
                        <option value="Associate">Associate</option>
                    </select>
                    <label>Membership Type</label>
                </div>
                <div class="input-field col s3">
                    <input id="dofa" name="dofa" type="date" class="validate" required>
                    <label for="dofa">DOFA</label>
                </div>
                <div class="input-field col s3">
                    <select id="employ_type" name="employ_type">
                        <option value="Permanent">Permanent</option>
                        <option value="Temporal">Temporal</option>
                        <option value="Temporal">MIDAS Permanent</option>
                    </select>
                    <label>Employment Type</label>
                </div>
                <div class="input-field col s3">
                    <select id="job_cadre" name="job_cadre">
                        <option value="Senior">Senior</option>
                        <option value="Junior">Junior</option>

                    </select>
                    <label>Job Cadre</label>
                </div>

            </div>

            <div class="row">

                <div class="input-field col s4">
                    <select id="dept" name="dept">
                        <option value="Administration">Administration</option>
                        <option value="Finance And Accounts">Finance And Accounts</option>
                        <option value="Family Medicine">Family Medicine</option>
                        <option value="Nursing">Nursing</option>
                        <option value="Pharmacy">Pharmacy</option>
                        <option value="Paediatrics">Paediatrics</option>
                        <option value="Pysiotherapy">Pysiotherapy</option>
                        <option value="Obstetics And Gynaecology">Obstetics And Gynaecology</option>
                        <option value="Opthalmology">Opthalmology</option>
                        <option value="Records">Records</option>
                        <option value="Nutrition And Dietetics">Nutrition And Dietetics</option>
                        <option value="Laboratory">Laboratory</option>
                        <option value="Social Works">Social Works</option>
                    </select>
                    <label for="dept">Dept</label>
                </div>

                <div class="input-field col s4">
                    <input id="phone" name="phone" type="text" class="validate" required>
                    <label for="phone">Phone</label>
                </div>
                <div class="input-field col s4">
                    <input id="dob" name="dob" type="date" class="validate" required>
                    <label for="dob">DOB</label>
                </div>

            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="home_add" name="home_add" type="text" class="validate" required>
                    <label for="home_add">Home Address</label>
                </div>
                <div class="input-field col s6">
                    <input id="res_add" name="res_add" type="text" class="validate" required>
                    <label for="res_add">Residential Address</label>
                </div>
            </div>

            <button type="submit" class="btn">Create</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>