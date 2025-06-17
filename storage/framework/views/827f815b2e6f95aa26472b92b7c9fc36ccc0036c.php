
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-validation.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <a href="" class="breadcrumbs__item">Settings</a>
    <a href="" class="breadcrumbs__item active">Item Cost</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                <a href="<?php echo e(route('admin.currencies.index')); ?>" class="breadcrumbs__item">Inventory </a>
                <a href="<?php echo e(route('admin.currencies.index')); ?>"
                    class="breadcrumbs__item"><?php echo e(trans('cruds.currency.title')); ?> </a>
            </h6>
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary" href="<?php echo e(route('admin.currencies.create')); ?>">
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg></span>
                        <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.currency.title')); ?>

                    </a>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Currency">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                <?php echo e(trans('cruds.currency.fields.id')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.currency.fields.name')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.currency.fields.code')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.currency.fields.main_currency')); ?>

                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-entry-id="<?php echo e($currency->id); ?>">
                                <td>

                                </td>
                                <td>
                                    <?php echo e($currency->id ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($currency->currency_name ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($currency->currency_code ?? ''); ?>

                                </td>
                                <td>
                                    <a
                                        class="badge bg-dark text-white"><?php echo e($currency->currency_status == 1 ? trans('global.active') : trans('global.not_active')); ?></a>
                                </td>
                                <td class="text-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('currency_show')): ?>
                                        <a class="btn btn-sm btn-primary"
                                            href="<?php echo e(route('admin.currencies.show', $currency->id)); ?>">
                                            <?php echo e(trans('global.view')); ?>

                                        </a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('currency_edit')): ?>
                                        <a class="btn btn-sm btn-warning"
                                            href="<?php echo e(route('admin.currencies.edit', $currency->id)); ?>">
                                            <?php echo e(trans('global.edit')); ?>

                                        </a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('currency_delete')): ?>
                                        <form action="<?php echo e(route('admin.currencies.destroy', $currency->id)); ?>" method="POST"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                            <input type="submit" class="btn btn-sm btn-danger hapusdata"
                                                value="<?php echo e(trans('global.delete')); ?>">
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
<?php $__env->startSection('scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('currency_delete')): ?>
                let deleteButtonTrans = '<?php echo e(trans('
                        global.datatables.delete ')); ?>'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "<?php echo e(route('admin.currencies.massDestroy')); ?>",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert(
                                '<?php echo e(trans('
                                                        global.datatables.zero_selected ')); ?>')

                            return
                        }

                        if (confirm('<?php echo e(trans('
                                                global.areYouSure ')); ?>')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            <?php endif; ?>

            $.extend(true, $.fn.dataTable.defaults, {
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            $('.datatable-Currency:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/currencies/index.blade.php ENDPATH**/ ?>