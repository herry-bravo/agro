
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
<a href="<?php echo e(route("admin.vendor.index")); ?>" class="breadcrumbs__item">Purchase Order</a>
<a href="<?php echo e(route("admin.vendor.index")); ?>" class="breadcrumbs__item">Supplier </a>
<a href="" class="breadcrumbs__item active">Edit</a>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Modern Horizontal Wizard -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title ">
                    <a href="<?php echo e(route("admin.purchase-requisition.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.po')); ?> </a>
                    <a href="<?php echo e(route("admin.purchase-requisition.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.requisition.title_singular')); ?> </a>
                    <a href="#" class="breadcrumbs__item"><?php echo e(trans('cruds.requisition.fields.edit')); ?></a>
                </h6>
            </div>
            <hr>
            <div class="card-body">
                <form action="<?php echo e(route("admin.vendor.update", [$vendor->id])); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>">
                        <input type="hidden" id="status" name="status" value="1">
                        <div class="bs-stepper wizard-modern modern-wizard-example">

                        </div>
                        <div class="bs-stepper-content">
                            <div class="content">
                                <div class="content-header">
                                    <?php echo e(trans('global.show')); ?> <?php echo e(trans('cruds.vendor.title')); ?>

                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.vendor.fields.vendor_code')); ?></label>
                                        <input type="text" class="form-control" name="vendor_id" value="<?php echo e($vendor->vendor_id); ?>" required="required" maxlength="8" minlength="8">
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.vendor.fields.vendor_name')); ?></label>
                                        <input type="text" class="form-control" name="vendor_name" value="<?php echo e($vendor->vendor_name); ?>" maxlength="100" required>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="mb-1 col-md-6">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.vendor.fields.address1')); ?></label>
                                        <input type="text" class="form-control" name="address1" value="<?php echo e($vendor->address1); ?>" maxlength="75" required>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.vendor.fields.address2')); ?></label>
                                        <input type="text" class="form-control" name="address2" value="<?php echo e($vendor->address2); ?>" maxlength="50">
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="mb-1 col-md-4">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.vendor.fields.city')); ?></label>
                                        <input type="text" class="form-control" name="city" value="<?php echo e($vendor->city); ?>">
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.vendor.fields.province')); ?></label>
                                        <input type="text" class="form-control" name="province" value="<?php echo e($vendor->province); ?>">
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.vendor.fields.country')); ?></label>
                                        <input type="text" class="form-control" name="country" value="<?php echo e($vendor->country); ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-4">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.vendor.fields.tax')); ?></label>
                                        <select type="text" id="currency" name="tax_code" class="form-control" value="<?php echo e(old('currency', isset($currency) ? $quotation->currency : '')); ?>" required>
                                            <option value="<?php echo e($vendor->tax_code); ?>"><?php echo e($vendor->tax->tax_name); ?></option>
                                            <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($vendor->tax_code!=$raw->tax_code): ?>
                                            <option value="<?php echo e($raw->tax_code); ?>"><?php echo e($raw->tax_name); ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.vendor.fields.currency')); ?></label>
                                        <select type="text" id="currency" name="currency" class="form-control" required>
                                            <?php $__currentLoopData = $curr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($curr->currency_code !=$vendor->currency ): ?>
                                            <option value="<?php echo e($curr->currency_code); ?>"><?php echo e($curr->currency_code); ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.vendor.fields.terms')); ?></label>
                                        <select type="text" id="terms" name="terms" class="form-control" value="<?php echo e(old('terms', isset($terms) ? $vendor->terms : '')); ?>" required>
                                            <?php if(($vendor->tems) == 1): ?>
                                            <option value="3" selected>30 After Receive Invoice</option>
                                            <option value="2">Every 15 Next Month</option>
                                            <option value="1">Cash</option>
                                            <?php elseif(($vendor->terms) == 2): ?>
                                            <option value="3">30 After Receive Invoice</option>
                                            <option value="2" selected>Every 15 Next Month</option>
                                            <option value="1">Cash</option>
                                            <?php else: ?>
                                            <option value="3">30 After Receive Invoice</option>
                                            <option value="2">Every 15 Next Month</option>
                                            <option value="1" selected>Cash</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="mb-1 col-md-3">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.vendor.fields.phone')); ?></label>
                                        <input type="text" name="phone" value="<?php echo e($vendor->phone); ?>" class='form-control' required="required" maxlength="12" minlength="10" />
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.vendor.fields.email')); ?></label>
                                        <input type="text" name="email" value="<?php echo e($vendor->email); ?>" class='form-control' />
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="col-sm-3 form-label"><?php echo e(trans('cruds.vendor.fields.bank_number')); ?></label>
                                        <input type="text" name="bank_number" value="<?php echo e($vendor->bank_number); ?>" class='form-control' maxlength="16" minlength="10" />
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="col-sm-3 form-label"><?php echo e(trans('cruds.vendor.fields.tax_number')); ?></label>
                                        <input type="text" name="tax_number" value="<?php echo e($vendor->tax_number); ?>" class='form-control' maxlength="16" minlength="10" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-success"><i data-feather='save'></i> <?php echo e(trans('global.save')); ?></button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/vendor/edit.blade.php ENDPATH**/ ?>