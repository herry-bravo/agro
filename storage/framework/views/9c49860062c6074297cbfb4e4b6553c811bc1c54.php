<?php $__env->startSection('content'); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.po')); ?> </a>
                        <a href="<?php echo e(route("admin.rcv.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.rcv.title')); ?> </a>
                    </h6>

                    <!-- <div class="row">
                        <div class="col-lg-12">
                            <fieldset>
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather='plus'></i> <?php echo e(trans('cruds.rcv.title_singular')); ?>

                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="<?php echo e(route("admin.rcvdirect")); ?>">
                                            <?php echo e(trans('cruds.rcv.fields.other')); ?>

                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route("admin.rcv.create")); ?>">
                                            <?php echo e(trans('cruds.rcv.fields.suplierreceive')); ?>

                                        </a>
                                        <a class="dropdown-item" href="<?php echo e(route('admin.rcvcustomer.create')); ?>">
                                            <?php echo e(trans('cruds.rcv.fields.customerreceive')); ?>

                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div> -->

                </div>
                <div class="card-body">
                    <table id="report-rcv" class=" table datatable-Order w-100">
                        <thead>
                            <tr>
                                <th style="text-align: left;">
                                    po number
                                </th>
                                <th style="text-align: left;">
                                    vendor
                                </th>
                                <th style="text-align: left;">
                                    rcv number
                                </th>
                                <th style="text-align: left;">
                                    warehouse
                                </th>
                                <th style="text-align: left;">
                                    currency
                                </th>
                                <th style="text-align: left;">
                                    category
                                </th>
                                <th style="text-align: left;">
                                    uom
                                </th>
                                <th style="text-align: left;">
                                    item
                                </th>
                                <th style="text-align: left;">
                                    qty
                                </th>
                                <th style="text-align: left;">
                                    date of receipt
                                </th>
                                <th style="text-align: left;">
                                    status
                                </th>
                                <th style="text-align: left;">
                                    action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Example Start-->
<form target="_blank">
    <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-white">Choose Labels Layout</Label></h4>
                    <button type="button" class="close border-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0rem 0rem;">
                    <div class="box-body">
                        <div class="card-body">
                            </br>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.itemMaster.fields.item_code')); ?></label>
                                        <input type="text" class="form-control " name="item" id="item-label" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.itemMaster.fields.attribute')); ?></label>
                                        <input type="text" id="grn" name="grn" class="form-control datepicker" value="" required>
                                        <input type="hidden" id="item_desc" name="item_desc" class="form-control datepicker" value="" required>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <label class="col-sm-0 control-label">Format </label></br>
                                <div class="col-md-10 col-12">
                                    <div class="col-sm-10">
                                        <div class="form-check format-label">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                3.8 x 7.5 cm
                                            </label>
                                        </div>
                                        <div class="form-check format-label">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                            <label class="form-check-label" for="gridRadios2">
                                                2 x 3 cm
                                            </label>
                                        </div>
                                        <div class="form-check  format-label">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
                                            <label class="form-check-label" for="gridRadios3">
                                                3.5 x 7.5 cm
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="col-sm-0 control-label" for="number">Counter</label>
                                        <input type="number" class="form-control " name="counter" id="item-label" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" formaction="rcv/show" data-bs-dismiss="modal" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END Modal Example Start-->

<!-- Start Modal GRN -->
<form action="#">
    <div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Filter</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row mt-1">
                            <div class="col-md-6 col-12">
                                <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.autocreate.fields.vendor')); ?></label>
                                <select name="vendor_id" id="vendor_id" class="form-control select">
                                    <option value="" selected></option>
                                    <?php $__currentLoopData = $vendor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($row->vendor_id); ?>"><?php echo e($row->vendor_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.fields.rev')); ?></label>
                                <input type="input" class="form-control" id="rev" name="transaction_datefrom" placeholder="GRN, Aju, Notes" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.fields.transactiondate')); ?></label>
                                    <input type="date" class="form-control search_supplier_name" id="min" name="transaction_datefrom" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="rate"><?php echo e(trans('cruds.rcv.fields.orderto')); ?></label>
                                    <input type="date" class="form-control search_supplier_name" id="max" name="transaction_dateto" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" id="btnReset" class="btn btn-warning" name="Reset">Reset</button>
                        <button type="button" id="rcv_filter" class="btn btn-primary rcv_filter" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END  Modal GRN -->

<!-- Start Modal Set -->
<form action="<?php echo e(route("admin.rcvdirect-edit")); ?>" method="GET" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="modalSet" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Filter</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row mt-1">
                            <div class="col-md-12 col-12">
                                <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.fields.grnno')); ?></label>
                                <select name="grn" id="grn" class="form-control select2" required>
                                    <option selected></option>
                                    <?php $__currentLoopData = $grn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($row->receipt_num); ?>"><?php echo e($row->receipt_num); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="  " id="rcv_filter" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END  Modal Set -->
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            , }
        });
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            var table = $('#report-rcv').DataTable({
                "bDestroy":true,
                "lengthMenu": [
                    [10, 25,'All']
                    , [10, 25,'All']
                ]
                , scrollY: true
                , searching: true
                , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                        <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
                , language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
                "ajax":{
                    url: "/search/rcv-index",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                },

                buttons: [
                    {
                        extend: 'print'
                        , text: feather.icons['printer'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Print'
                        , className: ''
                        , exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv'
                        , text: feather.icons['file-text'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Csv'
                        , className: ''
                        , exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel'
                        , text: feather.icons['file'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Excel'
                        , className: ''
                        , exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
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
                , ],
                columnDefs: [
                    {
                        "targets": 0,
                        "render": function(data, type, row, meta){
                            return row.po;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },
                    {
                        "targets": 1,
                        "render": function(data, type, row, meta){
                            return row.vendor;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },
                    {
                        "targets": 2,
                        "render": function(data, type, row, meta){
                            return row.rcv_num;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },{
                        "targets": 3,
                        "render": function(data, type, row, meta){
                            return row.wh;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },{
                        "targets": 4,
                        "render": function(data, type, row, meta){
                            return row.idr;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },{
                        "targets": 5,
                        "render": function(data, type, row, meta){
                            return row.category;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },{
                        "targets": 6,
                        "render": function(data, type, row, meta){
                            return row.uom;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },
                    {
                        "targets": 7,
                        "render": function(data, type, row, meta){
                            return row.item;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },
                    {
                        "targets": 8,
                        "render": function(data, type, row, meta){
                            return row.qty;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },
                    {
                        "targets": 9,
                        "render": function(data, type, row, meta){
                            return row.date;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },
                    {
                        "targets": 10,
                        "render": function(data, type, row, meta){
                        if (row.status == 0) {
                            return "<a class='badge bg-danger text-white'>Draft</a>";
                        } else {
                            return "<a class='badge bg-primary text-white'>Done</a>";
                        }
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                        $(td).css('text-align', 'center');
                        }
                    },
                    {
                        "targets": 11,
                        render: function(data, type, row, index) {
                            content = ` <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_show')): ?> 
                        </a> <?php endif; ?>   <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_edit')): ?><a class="badge btn-sm btn-info" href="rcv/${row.id}/edit">
                            <?php echo e(trans('global.open')); ?>

                        </a> <?php endif; ?>
                       `;
                            return content;
                        }
                    },
                   
                ],
                fixedColumns: true,
                searching: true
                , displayLength:10,
                    });
                });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/rcv/index.blade.php ENDPATH**/ ?>