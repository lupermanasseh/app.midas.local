<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">Membership Register</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <table class="highlight" id="users-table">
                <thead>
                    <tr>
                        <th>REG ID</th>
                        <th>LAST NAME</th>
                        <th>FIRST NAME</th>
                        <th>MEMBERSHIP TYPE</th>
                        <th>IPPIS</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                
            </table>
            
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    $(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?php echo route('users.data'); ?>',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'last_name', name: 'last_name' },
            { data: 'first_name', name: 'first_name' },
            { data: 'membership_type', name: 'membership_type' },
            { data: 'payment_number', name: 'payment_number' },
            { data: 'status', name: 'status' }
        ]
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>