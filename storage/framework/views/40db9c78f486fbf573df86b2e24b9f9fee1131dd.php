
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-validation.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>

<a href="<?php echo e(route("admin.permissions.index")); ?>" class="breadcrumbs__item">User Management</a>
<a href="<?php echo e(route("admin.permissions.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('global.permission')); ?></a>
<a href="" class="breadcrumbs__item active">Create</a>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-2"><?php echo e(trans('global.create')); ?> <?php echo e(trans('cruds.permission.title_singular')); ?></h4>
    </div>

    <div class="card-body">
        <form action="<?php echo e(route("admin.permissions.store")); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
                <label for="title"><?php echo e(trans('cruds.permission.fields.title')); ?>*</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo e(old('title', isset($permission) ? $permission->title : '')); ?>" required>
                <?php if($errors->has('title')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('title')); ?>

                </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.permission.fields.title_helper')); ?>

                </p>
            </div>
            <div>
                <input class="btn btn-sm btn-primary" type="submit" value="<?php echo e(trans('global.save')); ?>">
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/permissions/create.blade.php ENDPATH**/ ?>