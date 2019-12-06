<?php $__env->startSection('main-content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col s12 subject-header">
            <p class="teal-text">ALL CATEGORIES</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 subject-header">
            <span><a href="/product/category/add"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Create Category">playlist_add</i></a></span>

            <span><a href="/product/create"><i class="small material-icons tooltipped" data-position="bottom"
                        data-tooltip="Create Items">add</i></a></span>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <?php if(count($categories)>=1): ?>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><a href="/category/items/<?php echo e($category->id); ?>"><?php echo e($category->name); ?></a></td>
                        <td><?php echo e($category->description); ?></td>
                        <td><a href="/product/category/edit/<?php echo e($category->id); ?>"><i class="material-icons">create</i></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No product category added yet</p>
            <span><a href="/product/category/add" class="btn red lighten-2"><i class="material-icons">add</i></a></span>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>