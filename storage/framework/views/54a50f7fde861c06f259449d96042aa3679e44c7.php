<?php $__env->startSection('content'); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<a href="#" class="breadcrumbs__item"><?php echo e(trans('cruds.currency.fields.inv')); ?></a>
<a href="<?php echo e(route("admin.currencies.index")); ?>" class="breadcrumbs__item"> <?php echo e(trans('cruds.currency.item')); ?></a>
<a href="" class="breadcrumbs__item"> <?php echo e(trans('cruds.currency.fields.show')); ?></a>
<?php $__env->stopSection(); ?>
<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.show')); ?> <?php echo e(trans('cruds.currency.title')); ?>

    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.currency.fields.id')); ?>

                        </th>
                        <td>
                            <?php echo e($currency->id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.currency.fields.name')); ?>

                        </th>
                        <td>
                            <?php echo e($currency->name); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.currency.fields.code')); ?>

                        </th>
                        <td>
                            <?php echo e($currency->code); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.currency.fields.main_currency')); ?>

                        </th>
                        <td>
                            <input type="checkbox" disabled <?php echo e($currency->main_currency ? "checked" : ""); ?>>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="<?php echo e(url()->previous()); ?>">
                <?php echo e(trans('global.back_to_list')); ?>

            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/currencies/show.blade.php ENDPATH**/ ?>