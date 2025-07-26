
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
  <?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_create')): ?>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <h6 class="card-title">
            <a href="" class="breadcrumbs__item">Account Payable </a>
            <a href="<?php echo e(route("admin.ap-payment.index")); ?>" class="breadcrumbs__item"> Payment </a>
        </h6>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_create')): ?>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="<?php echo e(route("admin.ap-payment.create")); ?>">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                    <?php echo e(trans('global.add')); ?> Payable
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="artable" class=" table table-striped w-100" data-source="data-source">
                <thead>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.aPayable.fields.accdate')); ?>

                        </th>
                        <th class="text-end">
                            <?php echo e(trans('cruds.aPayable.fields.inv')); ?>

                        </th>
                        <th class="text-end">
                            <?php echo e(trans('cruds.aPayable.fields.amount')); ?>

                        </th>
                        <th class="text-end">
                            <?php echo e(trans('cruds.aPayable.fields.paymentnum')); ?>

                        </th>
                        <th class="text-end">
                            <?php echo e(trans('cruds.aPayable.fields.voucher')); ?>

                        </th>
                        <th class="text-center">
                            <?php echo e(trans('cruds.aPayable.fields.invpay')); ?>

                        </th>
                        <th class="text-center">
                            <?php echo e(trans('cruds.aPayable.fields.vendor')); ?>

                        </th>
                        <th class="text-center">
                            <?php echo e(trans('cruds.aPayable.fields.curr')); ?>

                        </th>
                        <th class="text-end">
                            <?php echo e(trans('cruds.aPayable.fields.flag')); ?>

                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
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
            var table = $('#artable').DataTable({
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
                    url: "/search/ap_payments",
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
                            return row.accounting_date;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },
                    {
                        "targets": 1,
                        "render": function(data, type, row, meta){
                            return row.invoice_id;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },
                    {
                        "targets": 2,
                        "render": function(data, type, row, meta){
                            return row.amount;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },{
                        "targets": 3,
                        "render": function(data, type, row, meta){
                            return row.payment_num;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },{
                        "targets": 4,
                        "render": function(data, type, row, meta){
                            return row.voucher;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },{
                        "targets": 5,
                        "render": function(data, type, row, meta){
                            return row.invoice_payment_type;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },{
                        "targets": 6,
                        "render": function(data, type, row, meta){
                            return row.invoice_vendor_site_id;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },
                    {
                        "targets": 7,
                        "render": function(data, type, row, meta){
                            return row.currency;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
                        }
                    },
                    {
                        "targets": 8,
                        "render": function(data, type, row, meta){
                            return row.posted_flag;
                        },
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center'); // Setel teks ke tengah
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro\resources\views/admin/apPayment/index.blade.php ENDPATH**/ ?>