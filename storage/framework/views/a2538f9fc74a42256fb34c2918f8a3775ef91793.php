<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/currency.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header mt-1 mb-50">
        <h6 class="card-title">
            <a href="<?php echo e(route("admin.currencies.index")); ?>" class="breadcrumbs__item">Currency </a>
            <a href="#" class="breadcrumbs__item"> <?php echo e(trans('cruds.currency.fields.create')); ?></a>
        </h6>
    </div>
    <hr>
    <div class="card-body">
        <form action="<?php echo e(route("admin.currencies.store")); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="name"><?php echo e(trans('cruds.currency.fields.name')); ?>*</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo e(old('name', isset($currency) ? $currency->name : '')); ?>" required>
                <?php if($errors->has('name')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('name')); ?>

                </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.currency.fields.name_helper')); ?>

                </p>
            </div>
            <div class="form-group">
                <label for="currency_code"><?php echo e(trans('cruds.currency.fields.code')); ?>*</label>
                <input type="text" id="currency_code" name="currency_code" class="form-control" value="<?php echo e(old('currency_code', isset($currency) ? $currency->currency_code : '')); ?>" required>
                <?php if($errors->has('currency_code')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('currency_code')); ?>

                </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.currency.fields.code_helper')); ?>

                </p>
            </div>
            <div class="form-group <?php echo e($errors->has('main_currency') ? 'has-error' : ''); ?>">
                <label for="main_currency"><?php echo e(trans('cruds.currency.fields.main_currency')); ?></label>
                <input name="main_currency" type="hidden" value="0">
                <input value="1" type="checkbox" id="main_currency" name="main_currency" <?php echo e(old('main_currency', 0) == 1 ? 'checked' : ''); ?>>
                <?php if($errors->has('main_currency')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('main_currency')); ?>

                </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.currency.fields.main_currency_helper')); ?>

                </p>
            </div>
            <div class="mb-1">
                <input class="btn btn-danger" type="submit" value="<?php echo e(trans('global.save')); ?>">
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/currencies/create.blade.php ENDPATH**/ ?>