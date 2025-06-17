<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header" >

        <h6 class="card-title">
            <a href="" class="breadcrumbs__item">Settings </a>
            <a href="<?php echo e(route("admin.journalTypes.index")); ?>" class="breadcrumbs__item">  <?php echo e(trans('cruds.journal.title_singular')); ?></a>
        </h6>

        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="<?php echo e(route("admin.journalTypes.create")); ?>">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                    <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.journal.title_singular')); ?>

                </a>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            #
                        </th>
                        <th>
                            Journal Name
                        </th>
                        <th>
                            Category
                        </th>
                        <th>
                          Type
                        </th>
                        <th>
                           Short Code
                        </th>
                        <th>
                           Default Account
                        </th>
                        <th class="text-center">
                           Creation Date
                        </th>
                        <th class="text-center">
                            <?php echo e(trans('cruds.itemMaster.fields.action')); ?>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr data-entry-id="<?php echo e($row->id); ?>">
                        <td>

                        </td>
                        <td>
                            <?php echo e($loop->iteration); ?>

                        </td>
                        <td>
                            <?php echo e($row->description ?? ''); ?>

                        </td>
                        <td>
                            <?php echo e($row->category_name ?? ''); ?>

                        </td>
                        <td class='acc_cent'>
                            <?php echo e($row->account_type ?? ''); ?>

                        </td>
                        <td class='acc_cent'>
                            <?php echo e($row->category_code ?? ''); ?>

                        </td>
                        <td class='acc_cent'>
                            <?php echo e($row->attribute1 ?? ''); ?> - <?php echo e($row->acc->description ?? ''); ?>


                        </td>
                        <td class="text-center">
                            <?php echo e($row->created_at->Format('d-M-Y') ?? ''); ?>

                        </td>
                        <td class="text-center">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('item_show')): ?>
                            <a class="btn btn-primary btn-sm  waves-effect waves-float waves-light" href="<?php echo e(route('admin.journalTypes.show',$row->id)); ?>">
                                <?php echo e(trans('global.view')); ?>

                            </a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('item_edit')): ?>

                            <a class="btn btn-warning btn-sm waves-effect waves-float waves-light" href="<?php echo e(route('admin.journalTypes.edit',$row->id)); ?>">
                                <?php echo e(trans('global.edit')); ?>

                            </a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('item_delete')): ?>
                            <!--  <form action="<?php echo e(route('admin.journalTypes.destroy',$row->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                        <input type="submit" class="dt-button buttons-html5 btn-danger" value="<?php echo e(trans('global.delete')); ?>">
                                    </form>  -->
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
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_delete')): ?>
        let deleteButtonTrans = '<?php echo e(trans('
        global.datatables.delete ')); ?>'
        let deleteButton = {
            text: deleteButtonTrans
            , url: "<?php echo e(route('admin.category.massDestroy')); ?>"
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
                [1, 'asc']
            ]
            , pageLength: 10
        , });
        $('.datatable-Role:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
    $(document).ready(function() {
        $('#Datatables').DataTable({
            "scrollX": true
        });
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/journalTypes/index.blade.php ENDPATH**/ ?>