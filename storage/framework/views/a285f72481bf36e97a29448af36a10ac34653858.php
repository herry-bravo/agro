
<?php $__env->startSection('content'); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<div class="card">
    <div class="card-header  mt-1 mb-1">

        <h6 class="card-title">
            <a href="<?php echo e(route("admin.inventory.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.physic.fields.inv')); ?> </a>
            <a href="<?php echo e(route("admin.inventory.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.inventory.title_singular')); ?> </a>
        </h6>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('price_list_create')): ?>
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#salesOrderModal">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                        <?php echo e(trans('global.add')); ?> Adjustment
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <table id="report_onhand" class=" table display  w-100" class="display">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        <?php echo e(trans('cruds.inventory.fields.item_number')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.inventory.fields.description')); ?>

                    </th>
                    <th>
                        Vendor Name
                    </th>
                    <th class="text-center">
                        <?php echo e(trans('cruds.inventory.fields.category')); ?>

                    </th>
                    <th class="text-center">
                        <?php echo e(trans('cruds.inventory.fields.subinventory')); ?>

                    </th>
                    <th class="text-center">
                        <?php echo e(trans('cruds.inventory.fields.location')); ?>

                    </th>
                    <th class="text-center">
                        UOM
                    </th>
                    <th class="text-center">
                        Cost
                    </th>

                    <th class="text-end">
                        <?php echo e(trans('cruds.inventory.fields.qty')); ?>

                    </th>
                    <th class="text-end">
                        In
                    </th>
                    <th class="text-end">
                        Out
                    </th>
                    <th class="text-end">
                        Stock Price
                    </th>
                    <th class="text-center">
                        <?php echo e(trans('cruds.inventory.fields.updated_at')); ?>

                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total</th>
                    <th colspan="4" id="total_order" class="text-end"></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="modal fade" id="salesOrderModal" tabindex="-1" aria-labelledby="salesOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="salesOrderModalLabel">Add Adjustment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="<?php echo e(route('admin.inventory.store')); ?>" method="POST" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>
                <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="gudang" class="form-label">Warehouse</label>
                        <select name="warehouse" id="warehouse" class="form-control select2" required>
                            <option hidden disabled selected></option>
                            <?php $__currentLoopData = $subinv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($row->sub_inventory_name); ?>"> <?php echo e($row->sub_inventory_name); ?> - <?php echo e($row->description); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="gudang" class="form-label">Item</label>
                        <select name="item_code" id="item_code" class="form-control select2" required>
                            <option hidden disabled selected></option>
                            <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($row->inventory_item_id); ?>"> <?php echo e($row->item_code); ?> - <?php echo e($row->description); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantities" id="quantities" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
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
        vendor = $("#vendor_id").val();
        min = $("#min").val();
        max = $("#max").val();
        rev = $("#rev").val();

        const table = $('#report_onhand').DataTable({
            "bServerSide": true
            , ajax: {
                url: '<?php echo e(url("search/onhand-report")); ?>'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    d.vendor = $('#vendor_id').val();
                    d.min = $("#min").val();
                    d.max = $("#max").val();
                    d.rev = $("#rev").val();
                    return d
                }
            }
            , responsive: false
            , scrollX: true
            , searching: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
            , displayLength: 20
            , "lengthMenu": [
                [10, 25, 50, -1]
                , [10, 25, 50, "All"]
            ]
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
                }
                // , {
                //     text: feather.icons['filter'].toSvg({
                //         class: 'font-small-4 me-50 '
                //     }) + 'Filter'
                //     , className: 'btn-warning'
                //     , action: function(e, node, config) {
                //         $('#modalFilter').modal('show')
                //     }
                // , }
            ]
            , columnDefs: [{

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                    , targets: [0]
                }, {
                    render: function(data, type, row, index) {
                        return type === 'display' && data.length > 50 ?
                            '<span id="outer" title="' + data + '">' + data.substr(0, 60) + '</span><span id="show"> ...</span>' :
                            data;
                    }
                    , targets: [2]
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
                    data: 'vendor_name'
                }, {
                    data: 'category'
                }, {
                    data: 'subinventory_code'
                }, {
                    data: 'fix_loc'
                }, {
                    data: 'primary_uom_code'
                    , className: "text-center"
                }, 
                {
                    data: 'cost'
                    , className: "text-center"
                }, {
                    data: 'transaction_quantity'
                    , className: "text-end"
                }, {
                    data: 'sales_quantity'
                    , className: "text-end"
                }, {
                    data: 'delivered_quantity'
                    , className: "text-end"
                },{
                    data: 'stock_price'
                    , className: "text-end"
                }, {
                    data: 'transaction_date'
                    , className: "text-end"
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

                $(api.column(5).footer()).html(length.toLocaleString() + ' Active Items');
            }
        })
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/inventory/index.blade.php ENDPATH**/ ?>