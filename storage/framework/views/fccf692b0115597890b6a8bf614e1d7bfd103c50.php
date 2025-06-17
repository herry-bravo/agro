
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-validation.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-wizard.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/vendors/js/forms/wizard/bs-stepper.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/forms/form-wizard.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.OrderManagement.title')); ?> </a>
                        <a href="<?php echo e(route("admin.customer.index")); ?>" class="breadcrumbs__item"> <?php echo e(trans('cruds.customer.title')); ?> </a>
                    </h6>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer_create')): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="<?php echo e(route("admin.customer.create")); ?>">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg></span>
                                <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.customer.title')); ?>

                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Transaction">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.customer.fields.cust_party_code')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.customer.fields.purpose_date')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.customer.fields.party_name')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.customer.fields.city')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.customer.fields.province')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.customer.fields.country')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.customer.fields.phone')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.customer.fields.currency_code')); ?>

                                    </th>
                                    <th class="text-center" style="width: 15%">
                                        <?php echo e(trans('global.action')); ?>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr data-entry-id="<?php echo e($row->id); ?>">
                                    <td>

                                    </td>
                                    <td>
                                        <?php echo e($row->cust_party_code ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e(Carbon\Carbon::parse($row->purpose_date)->format('d/M/Y') ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->party_name ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->city ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->province ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->country ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->phone ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->currency->currency_code ?? ''); ?>

                                    </td>
                                    <td class="text-center">
                                        

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer_edit')): ?>
                                        <a class=" badge btn btn-sm btn-warning" href="<?php echo e(route('admin.customer.edit', $row->id)); ?>">
                                            <?php echo e(trans('global.edit')); ?>

                                        </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer_delete')): ?>
                                        <form action="<?php echo e(route('admin.customer.destroy', $row->id)); ?>" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                            <button type="submit" class=" badge btn btn-sm btn-danger hapusdata" value="" style="vertical-align:super;"> <?php echo e(trans('global.delete')); ?></button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/customer/index.blade.php ENDPATH**/ ?>