
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <nav class="breadcrumbs">
        <a href="<?php echo e(route("admin.roles.index")); ?>" class="breadcrumbs__item">User Management</a>
        <a href="<?php echo e(route("admin.roles.index")); ?>" class="breadcrumbs__item">Roles</a>
        <a href="" class="breadcrumbs__item active">Create</a>
    </nav>
<?php $__env->stopSection(); ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-2"><?php echo e(trans('global.create')); ?>  <?php echo e(trans('cruds.permission.title_singular')); ?></h4>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route("admin.roles.store")); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>"> <label for="title"><?php echo e(trans('cruds.role.fields.title')); ?>*</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo e(old('title', isset($role) ? $role->title : '')); ?>" required>
                <?php if($errors->has('title')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('title')); ?>

                    </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.role.fields.title_helper')); ?>

                </p>
            </div>
            <div class="form-group <?php echo e($errors->has('permissions') ? 'has-error' : ''); ?> ">
                <label for="permissions"><?php echo e(trans('cruds.role.fields.permissions')); ?> * :
                    <span class="btn btn-primary btn-sm select-all"><?php echo e(trans('global.select_all')); ?></span>
                    <span class="btn btn-warning btn-sm deselect-all"><?php echo e(trans('global.deselect_all')); ?></span></label>
            </div>
            <div class="mt-1">
                <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple" required>
                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e((in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : ''); ?>><?php echo e($permissions); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('permissions')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('permissions')); ?>

                    </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.role.fields.permissions_helper')); ?>

                </p>
            </div>
            
            <hr class="mt-5">
            <div class="d-flex justify-content-between">
                <a class="btn btn-warning btn-submit waves-effect waves-float waves-light" href="<?php echo e(url()->previous()); ?>">
                    <i data-feather='arrow-left'></i> <?php echo e(trans('global.back')); ?>

                </a>
                <button class="btn btn-primary btn-submit waves-effect waves-float waves-light" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Save</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/roles/create.blade.php ENDPATH**/ ?>