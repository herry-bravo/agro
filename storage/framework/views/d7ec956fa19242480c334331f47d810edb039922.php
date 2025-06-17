
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-validation.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-wizard.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/vendors/js/forms/wizard/bs-stepper.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/forms/form-wizard.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>

<a href="<?php echo e(route("admin.site.index")); ?>" class="breadcrumbs__item">Settings</a>
<a href="<?php echo e(route("admin.site.index")); ?>" class="breadcrumbs__item">Site</a>
<a href="" class="breadcrumbs__item active">Edit</a>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Modern Horizontal Wizard -->
<section class="modern-horizontal-wizard">
    <form action="<?php echo e(route("admin.site.update", [$site->id])); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="bs-stepper wizard-modern modern-wizard-example">
            <div class="bs-stepper-header">
                <div class="step" data-target="#step3" role="tab" id="step3-trigger">
                    <button type="button" class="step-trigger">
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Add Site</h5><br>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6"><label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.site.fields.type')); ?></label>
                            <select name="site_type" id="type_code" class="form-control select2" required>
                                <?php if(($site->site_type) == 'Billto'): ?>
                                <option value="Billto" selected>Bill To</option>
                                <option value="Shipto">Ship To</option>
                                <option value="Deliveryto">Delivery To</option>
                                <?php elseif(($site->site_type) == 'Shipto'): ?>
                                <option value="Shipto" selected>Ship To</option>
                                <option value="Deliveryto">Delivery To</option>
                                <option value="Billto">Bill To</option>
                                <?php else: ?>
                                <option value="Deliveryto" selected>Delivery To</option>
                                <option value="Billto">Bill To</option>
                                <option value="Shipto">Ship To</option>
                                <?php endif; ?>
                            </select>
                            <?php if($errors->has('type_code')): ?>
                            <p class="help-block">
                                <?php echo e($errors->first('type_code')); ?>

                            </p>
                            <?php endif; ?>
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.vendor.fields.vendor_code')); ?></label>
                            <input type="text" class="form-control" name="site_code" value="<?php echo e($site->site_code); ?>" placeholder="Party Site Code" required="required" maxlength="12" minlength="8">
                        </div>
                    </div>


                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.site.fields.name')); ?></label>
                            <input type="text" class="form-control" name="address1" value="<?php echo e($site->address1); ?>">
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.site.fields.address2')); ?></label>
                            <input type="text" class="form-control" name="address2" value="<?php echo e($site->address2); ?>">
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.site.fields.address3')); ?></label>
                            <input type="text" class="form-control" name="address3" value="<?php echo e($site->address3); ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.site.fields.city')); ?></label>
                            <input type="text" class="form-control" name="city" value="<?php echo e($site->city); ?>">
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.site.fields.province')); ?></label>
                            <input type="text" class="form-control" name="province" value="<?php echo e($site->province); ?>">
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.site.fields.country')); ?></label>
                            <input type="text" class="form-control" name="country" value="<?php echo e($site->country); ?>">
                        </div>
                    </div>


                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.site.fields.phone')); ?></label>
                            <input type="text" name="phone" class='form-control' value="<?php echo e($site->phone); ?>" required="required" maxlength="12" minlength="10" />
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.site.fields.email')); ?></label>
                            <input type="text" name="email" class='form-control' value="<?php echo e($site->email); ?>" />
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-3"><?php echo e(trans('cruds.site.fields.bank_number')); ?></label>
                            <input type="text" name="bank_number" class='form-control' value="<?php echo e($site->bank_number); ?>" maxlength="16" minlength="10" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success"><i data-feather='save'></i> <?php echo e(trans('global.save')); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/site/edit.blade.php ENDPATH**/ ?>