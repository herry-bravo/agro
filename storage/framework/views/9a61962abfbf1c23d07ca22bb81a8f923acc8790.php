
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('breadcrumbs'); ?>

        <a href="<?php echo e(route("admin.users.index")); ?>" class="breadcrumbs__item">User <?php echo e(trans('global.management')); ?></a>
        <a href="<?php echo e(route("admin.users.index")); ?>" class="breadcrumbs__item">Users</a>
        <a href="" class="breadcrumbs__item active">Create</a>

<?php $__env->stopSection(); ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-2">
            <?php echo e(trans('global.create')); ?> <?php echo e(trans('cruds.user.title_singular')); ?>

            </h4>

    </div>

    <div class="card-body">
        <form action="<?php echo e(route("admin.users.store")); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                <label for="name"><?php echo e(trans('cruds.user.fields.name')); ?>*</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo e(old('name', isset($user) ? $user->name : '')); ?>" required>
                <?php if($errors->has('name')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('name')); ?>

                    </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.user.fields.name_helper')); ?>

                </p>
            </div>
            <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                <label for="email"><?php echo e(trans('cruds.user.fields.email')); ?>*</label>
                <input type="email" id="email" name="email" class="form-control" value="-" required>
                <?php if($errors->has('email')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('email')); ?>

                    </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.user.fields.email_helper')); ?>

                </p>
            </div>
            <div class="form-group">
                <label ><?php echo e(trans('cruds.user.fields.userID')); ?>*</label>
                <input type="text" id="userID" name="userID" class="form-control" value="<?php echo e(old('name', isset($user) ? $user->userID : '')); ?>" required>
            </div>
            <div class="form-group">
                <label ><?php echo e(trans('cruds.user.fields.user_status')); ?>*</label>
                <select id="user_status" name="user_status" class="form-control select2">
                    <option hidden disabled selected></option>
                    <option value="1" <?php echo e(old('name', isset($user) ? $user->user_status : 1)); ?>>User</option>
                    <option value="2">Kepala Bagian WH Sparepart</option>
                    <option value="3">Manager</option>
                    <option value="4">General Manager</option>
                </select>
            </div>
            <div class="form-group">
                <label ><?php echo e(trans('cruds.user.fields.user_mng')); ?>*</label>
                <select name="user_manager" id="agent_id" class="form-control select2">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option hidden disabled selected></option>
                        <option value="<?php echo e($user->id); ?>" <?php echo e(old('name', isset($user) ? $user->user_manager : '')); ?>><?php echo e($user->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
                <label for="password"><?php echo e(trans('cruds.user.fields.password')); ?></label>
                <input type="password" id="password" name="password" class="form-control" required>
                <?php if($errors->has('password')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('password')); ?>

                    </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.user.fields.password_helper')); ?>

                </p>
            </div>
            <div class="form-group <?php echo e($errors->has('roles') ? 'has-error' : ''); ?>">
                <label for="roles"><?php echo e(trans('cruds.user.fields.roles')); ?>*
                    <span class="btn btn-primary  btn-sm select-all"><?php echo e(trans('global.select_all')); ?></span>
                    <span class="btn btn-warning  btn-sm deselect-all"><?php echo e(trans('global.deselect_all')); ?></span></label>
            </div>
            <div class="mt-1">
                <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" required>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $roles): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e((in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : ''); ?>><?php echo e($roles); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('roles')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('roles')); ?>

                    </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.user.fields.roles_helper')); ?>

                </p>
            </div>
            <div class="mt-1">
                <select name="org_id" id="org_id" class="form-control select2"  required>
                        <option value="222" <?php echo e((in_array($id, old('roles', [])) || isset($user) && $user->org_id) ? 'selected' : ''); ?>>222</option>
                        <option value="182" <?php echo e((in_array($id, old('roles', [])) || isset($user) && $user->org_id) ? 'selected' : ''); ?>>182</option>
                </select>
                <?php if($errors->has('roles')): ?>
                    <p class="help-block">
                        <?php echo e($errors->first('roles')); ?>

                    </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.user.fields.roles_helper')); ?>

                </p>
            </div>
            <div>
                <button class="btn btn-primary btn-submit waves-effect waves-float waves-light" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Save</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/users/create.blade.php ENDPATH**/ ?>