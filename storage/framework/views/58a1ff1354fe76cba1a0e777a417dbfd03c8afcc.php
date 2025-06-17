<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-validation.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
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
                        <a href="<?php echo e(route("admin.pricelist.index")); ?>" class="breadcrumbs__item"> <?php echo e(trans('cruds.pricelist.title')); ?> </a>
                    </h6>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('price_list_create')): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="<?php echo e(route("admin.pricelist.create")); ?>">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg></span>
                                <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.pricelist.title')); ?>

                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="pricelisttable" class=" table table-bordered table-striped table-hover datatable-Transaction">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.pricelist.fields.price_list_name')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.pricelist.fields.description')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.pricelist.fields.effective_date')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.pricelist.fields.currency')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.pricelist.fields.location_id')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.pricelist.fields.flag_status')); ?>

                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $pricelist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr data-entry-id="<?php echo e($row->id); ?>">
                                    <td width="auto">
                                        <input type="checkbox" name="item_ids[]" id="item_ids" value="<?php echo e($row->id); ?>" class="form-check-input sub_chk" data-id="<?php echo e($row->id); ?>">
                                    </td>
                                    <td>
                                        <?php echo e($row->customer->party_name ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->description ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e(\Carbon\Carbon::parse($row->effective_date)->format('d/M/Y') ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->curr->currency_code ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->location_id ?? ''); ?>

                                    </td>
                                    <td class="text-center">
                                        <?php if($row->flag_status==1): ?>
                                        <a class="badge bg-primary text-white">Active</a>
                                        <?php else: ?>
                                        <a class="badge bg-warning text-white">Not Active</a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('price_list_show')): ?>
                                        <a class=" badge btn btn-sm btn-primary" href="<?php echo e(route('admin.pricelist.show', $row->id)); ?>">
                                            <?php echo e(trans('global.view')); ?>

                                        </a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('price_list_edit')): ?>
                                        <a class="badge btn btn-sm btn-warning" href="<?php echo e(route('admin.pricelist.edit', $row->id )); ?>">
                                            <?php echo e(trans('global.edit')); ?>

                                        </a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('price_list_delete')): ?>
                                        <form action="<?php echo e(route('admin.pricelist.destroy', $row->id)); ?>" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                            <button type="submit" class="badge btn btn-sm btn-danger hapusdata" style="  vertical-align: super;" value=""> <?php echo e(trans('global.delete')); ?> </button>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/pricelist/index.blade.php ENDPATH**/ ?>