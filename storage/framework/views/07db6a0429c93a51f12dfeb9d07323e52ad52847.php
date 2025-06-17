<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_create')): ?>
<?php endif; ?>
<div class="card">
    <div class="card-header p-1">

        <h6 class="card-title">
            <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.aReceivable.title')); ?> </a>
            <a href="<?php echo e(route("admin.credit-note.index")); ?>" class="breadcrumbs__item"> <?php echo e(trans('cruds.aReceivable.cal')); ?> </a>
        </h6>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_create')): ?>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="<?php echo e(route("admin.arCalendar.create")); ?>">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></span>
                     <?php echo e(trans('cruds.aReceivable.cal')); ?></a>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Order">
                <thead>
                    <tr>
						<th style="text-align: left;">
							<input type="checkbox" class='form-check-input dt-checkboxes text-end' id="head-cb">
						</th>
                        <th >
                        <?php echo e(trans('cruds.aReceivable.ar_calendar.id')); ?>

                        </th>
						<th>
                            <?php echo e(trans('cruds.aReceivable.ar_calendar.num')); ?>

                        </th>
						<th>
                            <?php echo e(trans('cruds.aReceivable.ar_calendar.name')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.aReceivable.ar_calendar.year')); ?>

                        </th>
						<th>
                            <?php echo e(trans('cruds.aReceivable.ar_calendar.from')); ?>

                        </th>
						<th>
                            <?php echo e(trans('cruds.aReceivable.ar_calendar.to')); ?>

                        </th>
						<th>
                            <?php echo e(trans('cruds.aReceivable.ar_calendar.status')); ?>

                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $cal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-entry-id="<?php echo e($raw->id); ?>">
                            <td></td>
                            <td>
                                <?php echo e($raw->id ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($raw->num ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($raw->setname ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($raw->year ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($raw->startdate ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($raw->enddate ?? ''); ?>

                            </td>
                            <td class="text-center">
                                <?php if($raw->confirmationstatus==14): ?>
                                    <a class="badge bg-primary text-white"><?php echo e($raw->trx_code->trx_name); ?></a>
                                <?php elseif($raw->confirmationstatus==12): ?>
                                    <a class="badge bg-secondary text-white"><?php echo e($raw->trx_code->trx_name); ?></a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_show')): ?>
                                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.arCalendar.show', $raw->id)); ?>">
                                        <?php echo e(trans('global.view')); ?>

                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_edit')): ?>
                                    <a class="btn btn-warning btn-sm waves-effect waves-float waves-light" href="<?php echo e(route('admin.arCalendar.edit', $raw->id)); ?>">
                                        <?php echo e(trans('global.edit')); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/arCalendar/index.blade.php ENDPATH**/ ?>