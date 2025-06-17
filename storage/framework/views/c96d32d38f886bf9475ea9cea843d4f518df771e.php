
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<style>
    .card-body {
        padding-bottom: 0em;
    }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/currency.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo e(route('admin.faktur.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">
                            <a href="<?php echo e(route("admin.salesorder.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.OrderManagement.title')); ?> </a>
                            <a href="<?php echo e(route("admin.salesorder.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.OrderManagement.faktur')); ?> </a>
                            <a href="" class="breadcrumbs__item">Create </a>
                        </h6>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row mb-25">
                            <div class="col-md-12">
                                <div class="row mb-25">
                                    <div class="col-md-4">
                                        <label class="form-label" for="order_number">Faktur Code</label>
                                        <input type="number" hidden id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                                        <input type="text" id="faktur_code" name="faktur_code" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-50 mt-1">
                            <div></div>
                            <button class="btn btn-primary btn-submit" type="submit"><i data-feather='save'></i>
                            <?php echo e(trans('global.save')); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/faktur/create.blade.php ENDPATH**/ ?>