
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-validation.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h6 class="card-title mt-1 mb-1">
            <a href="" class="breadcrumbs__item">User Management </a>
            <a href="<?php echo e(route("admin.roles.index")); ?>" class="breadcrumbs__item">  <?php echo e(trans('cruds.role.title')); ?></a>
        </h6>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_create')): ?>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="<?php echo e(route("admin.roles.create")); ?>">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></span>
                    <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.role.title')); ?>

                </a>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                <thead>
                    <tr>
                        <th width="3%">

                        </th>
                        <th width="auto">
                            <?php echo e(trans('cruds.role.fields.id')); ?>

                        </th>
                        <th width="auto">
                            <?php echo e(trans('cruds.role.fields.title')); ?>

                        </th>
                        <th width="auto">
                            <?php echo e(trans('cruds.role.fields.permissions')); ?>

                        </th>
                        <th width="15%">
                            <?php echo e(trans('global.action')); ?>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-entry-id="<?php echo e($role->id); ?>">
                            <td>

                            </td>
                            <td>
                                <?php echo e($role->id ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($role->title ?? ''); ?>

                            </td>
                            <td>
                                <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge bg-primary"><?php echo e($item->title); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_show')): ?>
                                    <a class="btn btn-sm btn-primary inline" href="<?php echo e(route('admin.roles.show', $role->id)); ?>">
                                        <?php echo e(trans('global.view')); ?>

                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_edit')): ?>
                                    <a class="btn btn-sm btn-warning" href="<?php echo e(route('admin.roles.edit', $role->id)); ?>">
                                        <?php echo e(trans('global.edit')); ?>

                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_delete')): ?>
                                    <form action="<?php echo e(route('admin.roles.destroy', $role->id)); ?>" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                        <input type="submit" class="btn btn-sm btn-danger hapusdata" value="<?php echo e(trans('global.delete')); ?>">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/roles/index.blade.php ENDPATH**/ ?>