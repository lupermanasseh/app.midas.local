<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s5">
            <h5 class="teal-text">User Next Of Kin</h5>
        </div>
        <form class="col s12" method="POST" action="/nokStore">
            <?php echo e(csrf_field()); ?>

            <div class="row">

                <div class="input-field col s6">
                    <input id="user_id" name="user_id" value="<?php echo e($id); ?>" type="hidden" class="validate" required>
                </div>

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
                    <select id="relationship" name="relationship">
                        <option value="Spouse">Spouse</option>
                        <option value="Child">Child</option>
                        <option value="Brother">Brother</option>
                        <option value="Sister">Sister</option>
                        <option value="Niece">Niece</option>
                        <option value="Cousine">Cousine</option>
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                    </select>
                    <label>Relationship</label>
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

                <div class="input-field col s6">
                    <input id="email" name="email" type="text" class="validate">
                    <label for="email">Email</label>
                </div>

                <div class="input-field col s6">
                    <input id="phone" name="phone" type="text" class="validate" required>
                    <label for="phone">Phone</label>
                </div>

            </div>



            <button type="submit" class="btn">Save</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>