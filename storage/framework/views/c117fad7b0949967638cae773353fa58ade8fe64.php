
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-validation.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="card">
        <div class="card-header">
            <h6 class="card-title mt-1 mb-1">
                <a href="" class="breadcrumbs__item">User Management </a>
                <a href="<?php echo e(route("admin.permissions.index")); ?>" class="breadcrumbs__item">  <?php echo e(trans('cruds.permission.title_singular')); ?></a>
            </h6>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_create')): ?>
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary" href="<?php echo e(route("admin.permissions.create")); ?>">
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg></span>
                        <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.permission.title_singular')); ?>

                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Transaction w-100">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                <?php echo e(trans('cruds.permission.fields.id')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.permission.fields.title')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.permission.fields.created_at')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.permission.fields.updated_at')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.permission.fields.deleted_at')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.order.fields.status')); ?>

                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-entry-id="<?php echo e($permission->id); ?>">
                            <td>

                            </td>
                            <td>
                                <?php echo e($permission->id ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($permission->title ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($permission->created_at ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($permission->updated_at ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($permission->deleted_at ?? ''); ?>

                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_show')): ?>
                                <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.permissions.show', $permission->id)); ?>">
                                    <?php echo e(trans('global.view')); ?>

                                </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_edit')): ?>
                                <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.permissions.edit', $permission->id)); ?>">
                                    <?php echo e(trans('global.edit')); ?>

                                </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_delete')): ?>
                                <form action="<?php echo e(route('admin.permissions.destroy', $permission->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <input type="submit" class="btn btn-xs btn-danger" value="<?php echo e(trans('global.delete')); ?>">
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
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/permissions/index.blade.php ENDPATH**/ ?>