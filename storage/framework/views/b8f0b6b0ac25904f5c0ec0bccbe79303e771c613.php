<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">USER DETAILS</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/user/all"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="All Users">group</i></a></span>
            <span><a href="/New"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Create User">person_add</i></a></span>
        </div>
    </div>

    <div class="row user-profiles">
        <div class="col s12 m3 l3 profile">
            
            <p class="profile__heading text-grey darken-3">Personal Details</p>

            <img src="<?php echo e($profile->photo); ?>" alt="" class="profile__photo">
            <span><a href="/photo/<?php echo e($profile->id); ?>" class="pink-text darken-2">Edit Photo</a></span>


            


            <span class="profile__user-name"><?php echo e($profile->title); ?></span>
            <span class="profile__user-name"><?php echo e($profile->first_name); ?> <?php echo e($profile->last_name); ?></span>
            <div class="profile__user-box">
                <span class="black-text sub-profile">Birth Date</span>
                <span class="profile__user-date grey-text lighten-2"><?php echo e($profile->dob->toFormattedDateString()); ?></span>
                <span class="black-text sub-profile">Joined Since</span>
                <span
                    class="profile__join-date grey-text lighten-2"><?php echo e($profile->created_at->toFormattedDateString()); ?></span>
                <span class="black-text sub-profile">Sex</span>
                <span class="profile__user-status grey-text lighten-2"><?php echo e($profile->sex); ?></span>
            </div>


            <span><a href="/editProfile/<?php echo e($profile->id); ?>" class="pink-text darken-2">Edit</a></span>
            <?php if($profile->status == 'Active'): ?>
            <span><a href="/deactivateUser/<?php echo e($profile->id); ?>" class="pink-text darken-2">Deactivate</a></span>
            <?php else: ?>
            <span><a href="/activateUser/<?php echo e($profile->id); ?>" class="pink-text darken-2">Activate</a></span>
            <?php endif; ?>
            <p><a href="/user/page/<?php echo e($profile->id); ?>" class="btn pink darken-4">Products</a></p>

        </div>
        <div class="col s12 m9 l9 profile-detail">
            <?php if($profile): ?>
            <div>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Staff #</th>
                            <th>Payment #</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo e($profile->staff_no); ?></td>
                            <td><?php echo e($profile->payment_number); ?></td>
                            <td><?php echo e($profile->phone); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Job Cadre</th>
                            <th>Employ Type</th>
                            <th>Email</th>
                            <th>Marital Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo e($profile->job_cadre); ?></td>
                            <td><?php echo e($profile->employ_type); ?></td>
                            <td><?php echo e($profile->email); ?></td>
                            <td><?php echo e($profile->marital_status); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>Dept</th>
                            <th>Home</th>
                            <th>Residence</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo e($profile->dept); ?></td>
                            <td><?php echo e($profile->home_add); ?></td>
                            <td><?php echo e($profile->res_add); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <p>No Record Added Yet</p>
            <?php endif; ?>

        </div>

    </div>

    <div class="row user-profiles">
        <?php if($profile->nok): ?>
        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">Next of Kin</p>
            <p><i class="small material-icons pink-text darken-4">wc</i></p>
            <span class="profile__user-name"><?php echo e($profile->nok->title); ?></span>
            <span class="profile__user-name"><?php echo e($profile->nok->first_name); ?> <?php echo e($profile->nok->last_name); ?></span>
            <div class="profile__user-box">
                <span class="black-text sub-profile">Sex</span>
                <span class="profile__user-status grey-text lighten-2"><?php echo e($profile->nok->gender); ?></span>
            </div>
            <span><a href="/editNok/<?php echo e($profile->nok->id); ?>" class="pink-text darken-2">Edit</a></span>
        </div>
        <div class="col s12 m9 l9 profile-detail">
            <?php if($profile): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Relationship</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo e($profile->nok->relationship); ?></td>
                        <td><?php echo e($profile->nok->email); ?></td>
                        <td><?php echo e($profile->nok->phone); ?></td>
                    </tr>
                </tbody>
            </table>
            <?php else: ?>
            <p>No Record Added Yet</p>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <div class="add-more-box">
            <h5>NEXT OF KIN</h5>
            <a href="/Nok/<?php echo e($profile->id); ?>" class="add-more"><i class="small material-icons">add</i></a>
        </div>
        <?php endif; ?>
    </div>

    <div class="row user-profiles">
        <?php if($profile->bank): ?>
        <div class="col s12 m3 l3 profile">
            <p class="profile__heading text-grey darken-3">Bank</p>
            <p><i class="small material-icons pink-text lighten-4">looks</i></p>
            <span class="profile__user-name"><?php echo e($profile->bank->bank_name); ?></span>
            <span class="profile__user-name"><?php echo e($profile->bank->acct_number); ?></span>
            <span><a href="/editBank/<?php echo e($profile->bank->id); ?>" class="pink-text darken-2">Edit</a></span>
        </div>
        <div class="col s12 m9 l9  profile-detail">
            <?php if($profile): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        
                        
                        <th>Acct Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                        
                        <td><?php echo e($profile->last_name); ?> <?php echo e($profile->first_name); ?> <?php echo e($profile->other_name); ?></td>
                    </tr>
                </tbody>
            </table> <?php else: ?> <p>No
                Record Added Yet</p>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <div class="add-more-box">
            <h5>BANK DETAILS</h5>
            <a href="/bank/<?php echo e($profile->id); ?>" class="add-more"><i class="small material-icons">add</i></a>
        </div>
        <?php endif; ?>
    </div>

    

    <div class="row user-profiles">
        <?php if($SavingReview->count()>=1): ?>
        
        <div class="col s12  profile-detail">
            <p class="profile__heading text-grey darken-3">Monthly Saving Reviews</p>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>DATE ADDED</th>
                        <th>AMOUNT</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $SavingReview; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reviewItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($reviewItem->created_at->toDateString()); ?></td>
                        <td><?php echo e(number_format($reviewItem->current_amount,2,'.',',')); ?></td>
                        <td><?php echo e($reviewItem->status); ?></td>
                        <td>
                            <?php if($reviewItem->status=='Inactive'): ?>
                            <a href="#" class="btn red darken-3"><?php echo e($reviewItem->status); ?></a>
                            <?php else: ?>
                            <a href="/saving/inactive/<?php echo e($reviewItem->id); ?>" class="btn grey darken-3">Deactivate</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <p><a href="/saving/review/<?php echo e($profile->id); ?>" class="btn green darken-4">Review</a></p>
            
        </div>
        <?php else: ?>
        <div class="add-more-box">
            <h5>MONTHLY SAVING AMOUNT</h5>
            <a href="/saving/review/<?php echo e($profile->id); ?>" class="add-more"><i class="small material-icons">add</i></a>
        </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>