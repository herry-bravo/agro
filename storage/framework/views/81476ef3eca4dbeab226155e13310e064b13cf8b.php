
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
        <a href="" class="breadcrumbs__item">Settings</a>
        <a href="" class="breadcrumbs__item">UOM Conversion</a>
        <a href="" class="breadcrumbs__item">Create Converion</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Modern Horizontal Wizard -->
<section class="modern-horizontal-wizard">
    <form action="<?php echo e(route("admin.uom-conversion.store")); ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
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
                        <h5 class="mb-0">Add UOM Conversion</h5><br>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-3">
                            <label class="form-label"><?php echo e(trans('cruds.uomconversion.fields.item_code')); ?></label>
                            <input type="text" class="form-control search_item_code " placeholder="Type here ..." name="item_code[]" id="searchitem_1" autocomplete="off" required>
                            <span class="help-block search_item_code_empty glyphicon" style="display: none;"> No Results Found </span>
                            <input type="hidden" class="search_inventory_item_id" id="id_1" name="inventory_item_id">
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label"><?php echo e(trans('cruds.uomconversion.fields.uom_code')); ?></label>
                            <input type="text" readonly name="uom_code" id="uom_1" class="form-control" required/>
                            <label class="form-label">* 1 item</label>
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label"><?php echo e(trans('cruds.uomconversion.fields.con_rate')); ?></label>
                            <input type="text" name="conversion_rate" class="form-control" required/>
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label"><?php echo e(trans('cruds.uomconversion.fields.interior_code')); ?></label>
                            <select name="interior_unit_code" id="primary_uom_code" class="form-control select2" required>
                                <option hidden disabled selected></option>
                                <?php $__currentLoopData = $uom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($row->uom_code); ?>  <?php echo e(in_array($row->uom_code, old('uom_code', [])) ? 'selected' : ''); ?>"><?php echo e($row->uom_code); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
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



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/uomConversion/createTabs.blade.php ENDPATH**/ ?>