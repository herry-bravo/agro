<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_create')): ?>
<?php endif; ?>

<div class="card">
    <div class="card-header p-1">
        <h6 class="card-title">
            <a href="" class="breadcrumbs__item">Account Receivable </a>
            <a href="<?php echo e(route("admin.credit-note.index")); ?>" class="breadcrumbs__item"> Credit Note </a>
        </h6>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_create')): ?>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="<?php echo e(route("admin.credit-note.create")); ?>">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></span>
                     <?php echo e(trans('cruds.creditNote.title_singular')); ?></a>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover datatable datatable-Order">
                <thead>
                    <tr>
						<th style="text-align: center;">
							<input type="checkbox" class='form-check-input dt-checkboxes' id="head-cb">
						</th>
                        <th >
                        <?php echo e(trans('cruds.aReceivable.ar.id')); ?>

                        </th>
						<th>
                            <?php echo e(trans('cruds.aReceivable.ar.trx_number')); ?>

                        </th>
						<th>
                            <?php echo e(trans('cruds.aReceivable.ar.trx_date')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.aReceivable.ar.bill_to')); ?>

                        </th>
						<th>
                            <?php echo e(trans('cruds.aReceivable.ar.ship_to')); ?>

						<th>
                            <?php echo e(trans('cruds.aReceivable.ar.delivery_id')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.aReceivable.ar.surat_jalan')); ?>

                        </th>
						<th>
                            <?php echo e(trans('cruds.aReceivable.ar.delivery_method')); ?>

                        </th>
						<th>
                            <?php echo e(trans('cruds.aReceivable.ar.term_id')); ?>

                        </th>
						<th>
                            <?php echo e(trans('cruds.aReceivable.ar.currency')); ?>

                        </th>
						<th>
                            <?php echo e(trans('cruds.aReceivable.ar.status')); ?>

                        </th>
                        <th> &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $cust; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-entry-id="<?php echo e($raw->id); ?>">
                            <td>
                            </td>
                            <td>
                                <?php echo e($raw->customer_trx_id ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($raw->trx_number ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($raw->trx_date ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($raw->dalivery->customer->party_name ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($raw->dalivery->party_site->address1 ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($raw->attribute1 ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($raw->attribute2 ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($raw->delivery_method_code ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($raw->term_id ?? ''); ?>

                            </td>
                            <td class="text-center">
                                <?php echo e($raw->currency->currency_code ?? ''); ?>

                            </td>
                            <td class="text-center">
                                <?php if($raw->status_trx  == 0): ?>
                                    <a class="badge bg-secondary text-white">Draft</a>
                                <?php elseif($raw->status_trx == 1): ?>
                                    <a class="badge bg-warning text-white">Validate</a>
                                <?php elseif($raw->status_trx == 2): ?>
                                    <a class="badge bg-info text-white">Account Posted</a>
                                <?php elseif($raw->status_trx == 4): ?>
                                    <a class="badge bg-primary text-white"><?php echo e($raw->payment_attributes); ?></a>
                                <?php else: ?>
                                    <a class="badge bg-danger text-white">Cancel</a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_show')): ?>
                                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.arCalendar.show', $raw->id)); ?>">
                                        <?php echo e(trans('global.view')); ?>

                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_edit')): ?>
                                    <a class="btn btn-warning btn-sm waves-effect waves-float waves-light" href="<?php echo e(route('admin.credit-note.edit', $raw->id)); ?>">
                                        <?php echo e(trans('global.open')); ?>

                                    </a>
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

 $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.orders.massDestroy')); ?>",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('<?php echo e(trans('global.datatables.zero_selected')); ?>')

        return
      }

      if (confirm('<?php echo e(trans('global.areYouSure')); ?>')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
<?php endif; ?>

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  $('.datatable-Order:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/creditNote/index.blade.php ENDPATH**/ ?>