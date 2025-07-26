
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h6 class="card-title">
            <a href="<?php echo e(route("admin.item-master.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.physic.fields.inv')); ?> </a>
            <a href="<?php echo e(route("admin.item-master.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.itemMaster.title_singular')); ?></a>
        </h6>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_create')): ?>
        <div class="row">
            <div class="col-lg-12">
                <a href="<?php echo e(route("admin.gallery.index")); ?>" target="blank" class="btn btn-info" style="margin-top: 1%;">Gallery Items</a>
                <a class="btn btn-primary" href="<?php echo e(route("admin.item-master.create")); ?>" style="margin-top: 1%;">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                    <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.itemMaster.title_singular')); ?>

                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="card-body">

        <table data-toggle="table" id="table-item" class=" table  table-hover datatable display" style="width:100%">
            <thead>
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        <?php echo e(trans('cruds.itemMaster.fields.item_code')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.itemMaster.fields.description')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.itemMaster.fields.type')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.itemMaster.fields.Uom')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.itemMaster.fields.category')); ?>

                    </th>
                    <th>
                        Sub <?php echo e(trans('cruds.itemMaster.fields.category')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.itemMaster.fields.sub')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.itemMaster.fields.fixloc')); ?>

                    </th>
                    <th class="text-center">
                        <?php echo e(trans('cruds.itemMaster.fields.updatedat')); ?>

                    </th>
                    <th>
                        #
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5">Total</th>
                    <th colspan="3" id="total_order" class="text-end"></th>
                    <th colspan="3" class="text-end"></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('#table-item').DataTable({
            "bServerSide": true
            , ajax: {
                url: '<?php echo e(url("search/item-report")); ?>'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    // document.querySelector('input[type="search"]').value = '';
                    return d

                }
            }
            , responsive: true
            , scrollX: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
            , displayLength: 20
            , "lengthMenu": [
                [10, 25, 50, -1]
                , [10, 25, 50, "All"]
            ]
            , 'paging': true
            , buttons: [{
                    extend: 'print'
                    , text: feather.icons['printer'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Print'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'csv'
                    , text: feather.icons['file-text'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Csv'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'excel'
                    , text: feather.icons['file'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Excel'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'pdf'
                    , text: feather.icons['clipboard'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Pdf'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'copy'
                    , text: feather.icons['copy'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Copy'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'colvis'
                    , text: feather.icons['eye'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Colvis'
                    , className: ''
                , }
            , ]
            , columnDefs: [{
                    render: function(data, type, row, index) {
                        var info = table.page.info();
                        return index.row + info.start + 1;
                    }
                    , targets: [0]
                }
                , {
                    render: function(data, type, row, index) {
                        return type === 'display' && data.length > 20 ?
                            '<span id="outer" title="' + data + '">' + data.substr(0, 40) + '</span><span id="show"> ...</span>' :
                            data;
                    }
                    , targets: [2]
                }
                , {
                    render: function(data, type, row, index) {
                        content = `<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('item_edit')): ?>
                        <a class="badge btn btn-warning btn-sm waves-effect waves-float waves-light" href="item-master/${row.id}/edit">
                            <?php echo e(trans('global.edit')); ?>

                        </a>
                        <?php endif; ?>`;
                        return content;
                    }
                    , targets: [10]
                }
            ]
            , columns: [{
                    data: 'id'
                    , className: "text-center"
                }
                , {
                    data: 'item_code'
                }, {
                    data: 'description'
                }, {
                    data: 'type_code'
                }, {
                    data: 'primary_uom_code'
                }, {
                    data: 'category_code'
                }, {
                    data: 'sub_category'
                    , className: "text-center"
                }, {
                    data: 'receiving_inventory'
                    , className: "text-center"
                }, {
                    data: 'location'
                    , className: "text-center"
                }, {
                    data: 'updated_at'
                    , className: "text-center"
                }, {
                    data: ''
                    , className: "text-center"
                }
            ]
            , language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;'
                    , next: '&nbsp;'
                }
            }
            , "footerCallback": function(tfoot, data, start, end, display) {
                var api = this.api();

                var length = table.page.info().recordsTotal;

                $(api.column(10).footer()).html(length.toLocaleString() + ' Items');
            }

        })
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro\resources\views/admin/itemMaster/index.blade.php ENDPATH**/ ?>