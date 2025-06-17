
<?php $__env->startSection('breadcrumbs'); ?>

<a href="<?php echo e(route("admin.vendor.index")); ?>" class="breadcrumbs__item">Purchase Order</a>
<a href="<?php echo e(route("admin.vendor.index")); ?>" class="breadcrumbs__item">Supplier</a>
<a href="" class="breadcrumbs__item active">View</a>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="<?php echo e(route("admin.vendor.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.po')); ?> </a>
                        <a href="<?php echo e(route("admin.vendor.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.vendor.title_singular')); ?> </a>
                        <a href="<?php echo e(route("admin.vendor.index")); ?>" class="breadcrumbs__item">Show </a>
                    </h6>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.vendor.fields.vendor_code')); ?>

                                    </th>
                                    <td>
                                        <?php echo e($vendor->vendor_id); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.vendor.fields.vendor_name')); ?>

                                    </th>
                                    <td>
                                        <?php echo e($vendor->vendor_name); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.vendor.fields.address1')); ?>

                                    </th>
                                    <td>
                                        <?php echo e($vendor->address1); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.vendor.fields.address2')); ?>

                                    </th>
                                    <td>
                                        <?php echo e($vendor->address2); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.vendor.fields.city')); ?>

                                    </th>
                                    <td>
                                        <?php echo e($vendor->city); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.vendor.fields.province')); ?>

                                    </th>
                                    <td>
                                        <?php echo e($vendor->province); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.vendor.fields.country')); ?>

                                    </th>
                                    <td>
                                        <?php echo e($vendor->country); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.vendor.fields.phone')); ?>

                                    </th>
                                    <td>
                                        <?php echo e($vendor->phone); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.vendor.fields.email')); ?>

                                    </th>
                                    <td>
                                        <?php echo e($vendor->email); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.vendor.fields.tax')); ?>

                                    </th>
                                    <td>
                                        <?php if(($vendor->tax_code ) == 1): ?>
                                            Tax 10%
                                        <?php else: ?>
                                            Non Tax
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.vendor.fields.bank')); ?>

                                    </th>
                                    <td>
                                        <?php echo e($vendor->bank); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.vendor.fields.bank_number')); ?>

                                    </th>
                                    <td>
                                        <?php echo e($vendor->bank_number); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <?php echo e(trans('cruds.vendor.fields.terms')); ?>

                                    </th>
                                    <td>
                                        <?php echo e($vendor->terms); ?>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a style="margin-top:20px;" class="btn btn-default" href="<?php echo e(url()->previous()); ?>">
                            <?php echo e(trans('global.back_to_list')); ?>

                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/vendor/show.blade.php ENDPATH**/ ?>