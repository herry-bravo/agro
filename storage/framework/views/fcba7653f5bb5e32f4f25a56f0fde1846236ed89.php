
<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_create')): ?>
<?php endif; ?>
<div class="card">
    <div class="card-header mt-1 mb-1">
        <h6 class="card-title">
            <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.assetMng.field.invoice')); ?></a>
            <a href="<?php echo e(route("admin.bom.index")); ?>" class="breadcrumbs__item">  Report </a>
        </h6>
    </div>
    <div class="card-body " >

        <div class="table-responsive">
            <table id="table-sales" class=" table table-bordered table-striped w-100" >
                <thead>
                    <tr>
                        <th style="text-align: center;">
                            <input type="checkbox" class='form-check-input dt-checkboxes' id="head-cb">
                        </th>
                        <th>
                            <?php echo e(trans('cruds.order.fields.order_number')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.order.fields.customer_po2')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.Delivery.fields.acepdet')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.Delivery.table.surat_jalan')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.order.fields.customer_name')); ?>

                        </th>
                        <th class="">
                            <?php echo e(trans('cruds.OrderManagement.field.currency')); ?>

                        </th>
                        <th class="text-center">
                            <?php echo e(trans('cruds.OrderManagement.reports.total')); ?>

                        </th>
                        <th class="text-center">
                            <?php echo e(trans('cruds.OrderManagement.field.status')); ?>

                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7">Total</th>
                        <th id="total_order" class="text-end"></th>
                        <th class="text-end"></th>
                    </tr>
                </tfoot>
            </table>
        </div>


    </div>
</div>
<!-- Start Modal GRN -->
<div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-white" id="exampleModalLongTitle">Filter</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form >
                <div class="card-body">
                    <div class="row mt-1">
                        <div class="col-md-12 col-12">
                            <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.order.fields.customer_name')); ?></label>
                            <select name="customer" id="customer" class="form-control select2" required>
                                <option hidden selected></option>
                                <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($row->cust_party_code); ?>"><?php echo e($row->party_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.fields.transactiondate')); ?></label>
                                <input type="date" id="from" name="ordered_date" class="form-control"  required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="rate"><?php echo e(trans('cruds.rcv.fields.orderto')); ?></label>
                                <input type="date" id="to" name="ordered_date" class="form-control"  required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="sales_filter" class="btn btn-primary sales_filter" name="action">View</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END  Modal GRN -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->startPush('script'); ?>
<script>
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


         rev = $("#rev").val(),
         customer = $("#customer").val();
         from = $("#from").val();
         to = $("#to").val();

         var table  = $('#table-sales').DataTable({
            "bServerSide": true
            , ajax: {
                url: '<?php echo e(url("search/sales-invoice")); ?>'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    d.customer =  $("#customer").val();
                    d.rev = $("#rev").val();
                    d.from = $("#from").val();
                    d.to = $("#to").val();
                    return d
                }
            }
            , responsive: false
            , scrollX: true
            , searching: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between mx-0 row"\
                        <"d-flex justify-content-between mx-0 mt-2 row"\
                        <"col-sm-12 col-md-5"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-4 text-end"><"col-sm-12 col-md-1"p>\
                        >t>'
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
                }, {
                    text: feather.icons['filter'].toSvg({
                        class: 'font-small-4 me-50 '
                    }) + 'Filter'
                    , className: 'btn-warning'
                    , action: function(e, node, config) {
                        $('#modalFilter').modal('show')
                    }
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

                        content = `<a class="badge bg-danger text-white">${row.trx_name}</a>`;

                        return content;
                    }
                    , className: "text-center"
                    , targets: [8]
                }
            ]
            , columns: [{
                data: 'id'
                , className: "text-center"
                }
                , {
                    data: 'order_number'
                }, {
                    data: 'cust_po_number'
                }, {
                    data: 'created_at'
                    , className: "text-center"
                },{
                    data: 'dock_code'
                },{
                    data: 'customer_name'
                }, {
                    data: 'currency'
                    , className: "text-center"
                }, {
                    data: 'sub_total'
                    , className: "text-end"
                }
            ]
            ,"footerCallback": function( tfoot, data, start, end, display ) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                // Total over all pages
                total = api
                    .column(7)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(7, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(7).footer()).html('Rp. ' + pageTotal.toLocaleString());
                $(api.column(8).footer()).html(' / Rp. ' + total.toLocaleString());
            }
        });

        $(document).on('click', '.sales_filter', function() {

            var rev = $("#rev").val();
            var customer = $("#customer").val();
            var from = $("#from").val();
            var to = $("#to").val();
            console.log(from, to);

            $('#modalFilter').modal('hide');
            $('#table-sales').DataTable().ajax.reload()
        });
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/sales/invoice.blade.php ENDPATH**/ ?>