<?php $__env->startSection('content'); ?>
<?php $__env->startSection('breadcrumbs'); ?>

        <a href="<?php echo e(route("admin.accountCode.index")); ?>" class="breadcrumbs__item">Settings</a>
        <a href="<?php echo e(route("admin.accountCode.index")); ?>" class="breadcrumbs__item">Chart Of Account</a>
        <a href="" class="breadcrumbs__item active">Create</a>

<?php $__env->stopSection(); ?>
<!-- Main content -->
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
<div class="row">
<div class="col-12">
    <div class="card">
				<div class="card-header">
                    <h4 class="card-title mb-2">COA</h4>
                </div>
                <hr>
    <div class="card-body">
    <form action="<?php echo e(route("admin.accountCode.store")); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="account_payable"><?php echo e(trans('cruds.coa.fields.parent')); ?></label>
                            <select name="parent_code" id="parent_code" class="form-control select2"  required>
                                    <?php $__currentLoopData = $accountCode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($row->parent_code); ?>"  <?php echo e(old('parent_code') ? 'selected' : ''); ?>>	<?php echo e($row->parent_code); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="account_code"><?php echo e(trans('cruds.coa.fields.code')); ?></label>
                            <input type="text" name="account_code" id="account_code" class="form-control"  maxlength="8" required/>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="description"><?php echo e(trans('cruds.coa.fields.description')); ?></label>
                            <input type="text" name="description" id="description" class="form-control" required/>
                        </div>
            </div>
			<div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="type"><?php echo e(trans('cruds.coa.fields.type')); ?></label>
                            <select name="type" id="type" class="form-control select2"  required>
                                <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($row->type); ?>"  <?php echo e(old('parent_code') ? 'selected' : ''); ?>>	<?php echo e($row->type); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="lvl"><?php echo e(trans('cruds.coa.fields.level')); ?></label>
                           <select name="level" id="level" class="form-control select2"  required>
                                <option hidden disabled selected></option>
                                        <option value="1" >1</option>
                                        <option value="2" >2</option>
                                        <option value="3" >3</option>
                                        <option value="4" >4</option>
                                        <option value="5" >5</option>
                            </select>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="account_inventory"><?php echo e(trans('cruds.coa.fields.group')); ?></label>
                            <select name="account_group" id="account_group" class="form-control select2"  required>
                                <option hidden disabled selected></option>
                                <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($row->account_group); ?>" ><?php echo e($row->account_group); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <input type="hidden" name="org_id" value="<?php echo e(Auth::user()->org_id); ?>">
            </div>
           <div class="d-flex justify-content-between">
            <button type="reset" class="btn btn-warning pull-left btn-submit"><i data-feather='save'></i> <?php echo e(trans('global.save')); ?></button>
            <button type="submit" class="btn btn-success pull-left btn-submit"><i data-feather='save'></i> <?php echo e(trans('global.save')); ?></button>
			</div>
        </form>
        </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/acc/create.blade.php ENDPATH**/ ?>