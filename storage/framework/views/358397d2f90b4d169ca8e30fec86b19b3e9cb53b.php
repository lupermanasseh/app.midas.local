 
<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">EDIT NOK DETAILS</p>
            <span><a href="/userDetails/<?php echo e($nok->user->id); ?>"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="Back To User Deatils">arrow_back</i></a></span>
            <span><a href="/user/all"><i class="small material-icons tooltipped" data-position="bottom" data-tooltip="All Users">group</i></a></span>
        </div>
    </div>
    <div class="row">

        <form class="col s12" method="POST" action="/updateNok/<?php echo e($nok->id); ?>">
            <?php echo e(csrf_field()); ?>


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
                    <input id="first_name" name="first_name" value="<?php echo e($nok->first_name); ?>" type="text" class="validate" required>
                    <label for="first_name">Surname</label>
                </div>

                <div class="input-field col s4">
                    <input id="last_name" name="last_name" value="<?php echo e($nok->first_name); ?>" type="text" class="validate" required>
                    <label for="last_name">Last name</label>
                </div>
                <div class="input-field col s4">
                    <input id="other_name" name="other_name" value="<?php echo e($nok->other_name); ?>" type="text">
                    <label for="other_name">Other name</label>
                </div>

            </div>

            <div class="row">

                <div class="input-field col s6">
                    <input id="email" name="email" value="<?php echo e($nok->email); ?>" type="text" class="validate">
                    <label for="email">Email</label>
                </div>

                <div class="input-field col s6">
                    <input id="phone" name="phone" value="<?php echo e($nok->phone); ?>" type="text" class="validate" required>
                    <label for="phone">Phone</label>
                </div>

            </div>

            <button type="submit" class="btn">Update NOK</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>