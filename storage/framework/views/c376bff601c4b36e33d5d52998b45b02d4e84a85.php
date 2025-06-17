<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_create')): ?>
<?php endif; ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="<?php echo e(route("admin.return.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.po')); ?> </a>
                        <a href="<?php echo e(route("admin.return.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.return.title_singular')); ?></a>
                    </h6>
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="<?php echo e(route("admin.return.create")); ?>">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg></span>
                                <?php echo e(trans('cruds.return.title_singular')); ?></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable datatable-Order">
                            <thead>
                                <tr>

                                    <th>
                                        <?php echo e(trans('cruds.return.fields.transactiontype')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.return.fields.orderno')); ?>

                                    </th>
                                    <th style="text-align: center;">
                                        <?php echo e(trans('cruds.return.fields.grnno')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.return.fields.product')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.return.fields.qty')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.return.fields.price')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.return.fields.returnedqty')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.return.fields.transactiondate')); ?>

                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $return; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr data-entry-id="<?php echo e($raw->id); ?>">
                                    <td style="display:none">
                                        <?php echo e($raw->id ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($raw->RcvHeader->transaction_type ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($raw->PurchaseOrder->segment1 ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($raw->RcvHeader->receipt_num ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($raw->itemMaster->item_code ?? ''); ?> <?php echo e($raw->item_description ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($raw->PurchaseOrderDet->po_quantity ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($raw->PurchaseOrderDet->unit_price ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($raw->quantity_returned ?? ''); ?>

                                    </td>
                                    <td>
                                        <?php echo e($raw->RcvHeader->gl_date ?? ''); ?>

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
<?php $__env->startSection('scripts'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
<script>
    $(function() {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_delete')): ?>
        let deleteButtonTrans = '<?php echo e(trans('
        global.datatables.delete ')); ?>'
        let deleteButton = {
            text: deleteButtonTrans
            , url: "<?php echo e(route('admin.orders.massDestroy')); ?>"
            , className: 'btn-danger'
            , action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('<?php echo e(trans('
                        global.datatables.zero_selected ')); ?>')

                    return
                }

                if (confirm('<?php echo e(trans('
                        global.areYouSure ')); ?>')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            }
                            , method: 'POST'
                            , url: config.url
                            , data: {
                                ids: ids
                                , _method: 'DELETE'
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
            ]
            , pageLength: 10
        , });
        $('.datatable-Order:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/return/index.blade.php ENDPATH**/ ?>