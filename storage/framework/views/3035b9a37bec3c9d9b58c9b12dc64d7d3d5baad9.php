
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
        <a href="" class="breadcrumbs__item">Unit Of Measurement</a>
        <a href="" class="breadcrumbs__item">Create UOM</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Modern Horizontal Wizard -->
<section class="modern-horizontal-wizard">
    <form action="<?php echo e(route("admin.uom.store")); ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
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
                        <h5 class="mb-0">Add Unit Of Measurement</h5><br>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="form-label"><?php echo e(trans('cruds.uom.fields.uom_code')); ?></label>
                            <input type="text" name="uom_code" class="form-control" required/>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label"><?php echo e(trans('cruds.uom.fields.uom_name')); ?></label>
                            <input type="text" name="uom_name" class="form-control" required/>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label"><?php echo e(trans('cruds.uom.fields.description')); ?></label>
                            <input type="text" name="description" class="form-control" required/>
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



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/uom/createTabs.blade.php ENDPATH**/ ?>