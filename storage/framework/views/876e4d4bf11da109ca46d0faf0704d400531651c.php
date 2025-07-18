
<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_create')): ?>
<?php endif; ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.po')); ?> </a>
                        <a href="<?php echo e(route("admin.bom.index")); ?>" class="breadcrumbs__item"> Report </a>
                    </h6>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_create')): ?>
                    <div class="row">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="purchase-report" class=" table datatable-Order  w-100">
                            <thead>
                                <tr>
                                    <th style="text-align: left;">
                                        <input type="checkbox" class='form-check-input dt-checkboxes' id="head-cb">
                                    </th>
                                    <th class="text-center">
                                        Order
                                    </th>
                                    <th class="text-center">
                                        Requisition
                                    </th>
                                    <th class="text-center">
                                        Vendor
                                    </th>
                                    <th class="text-center">
                                        <?php echo e(trans('cruds.rcv.fields.product')); ?>

                                    </th>
                                    <th class="text-center">
                                        <?php echo e(trans('cruds.quotation.fields.currency')); ?>

                                    </th>
                                    <th class="text-center">
                                        <?php echo e(trans('cruds.purchaseorder.fields.price')); ?>

                                    </th>
                                    <th class="text-center">
                                        <?php echo e(trans('cruds.rcv.fields.qty')); ?>

                                    </th>
                                    <th class="text-center">
                                        QTYRECEIPT
                                    </th>
                                    <th class="text-center">
                                        <?php echo e(trans('cruds.rcv.fields.outstandingqty')); ?>

                                    </th>

                                    <th class="text-center">
                                        <?php echo e(trans('cruds.OrderManagement.field.subtotal')); ?>(IDR)
                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.purchaseorder.fields.buyer')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.purchaseorder.fields.status')); ?>

                                    </th>
                                    <th class="text-center">
                                        <?php echo e(trans('cruds.order.fields.created_at')); ?>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="9">Total</th>
                                    <th colspan="2" id="total_order" class="text-end"></th>
                                    <th colspan="3" class="text-end"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                </div>
            </div>
            </div>
        </div>
</section>
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

        const table = $('#purchase-report').DataTable({
            "bServerSide": true
            , ajax: {
                url: '<?php echo e(url("search/purchase-report")); ?>'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    return d
                }
            }
            , responsive: false
            , scrollX: true
            , searching: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between mx-0 row"\
                        <"d-flex justify-content-between mx-0 row"\
                        <"col-sm-12 col-md-5"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-4 text-end"><"col-sm-12 col-md-1"p>\
                        >t>'
            , displayLength: 15
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
                        return type === 'display' && data.length > 20 ?
                            '<span id="outer" title="' + data + '">' + data.substr(0, 20) + '</span><span id="show"> ...</span>' :
                            data;
                    }
                    , targets: [4]
                }
                , {
                    width: 125
                    , targets: 3
                }
                , {
                    width: 200
                    , targets: 4
                }
                , {
                    width: 125
                    , targets: 5
                }
                , {
                    width: 125
                    , targets: 12
                }
            ]
            , columns: [{
                    data: 'id'
                    , className: "text-center"
                }
                , {
                    data: 'segment1'
                }, {
                    data: 'pr_num'
                }, {
                    data: 'vendor_name'
                }, {
                    data: 'itemMaster'
                }, {
                    data: 'currency_code'
                    , className: "text-center"
                }, {
                    data: 'unit_price'
                    , className: "text-end"
                }, {
                    data: 'po_quantity'
                    , className: "text-end"
                }, {
                    data: 'quantity_receive'
                    , className: "text-end"
                }, {
                    data: 'quantity_outstanding'
                    , className: "text-end"
                }, {
                    data: 'subtotal'
                    , className: "text-end"
                }, {
                    data: 'user'
                    , className: "text-center"
                }, {
                    data: 'trx_name'
                    , className: "text-center"
                }, {
                    data: 'created_at'
                    , className: "text-end"
                }
            ]
            , "footerCallback": function(tfoot, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                // Total over all pages
                total = api
                    .column(10)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(10, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(10).footer()).html('Rp. ' + pageTotal.toLocaleString());
            }
        });


    });

</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/purchase/report.blade.php ENDPATH**/ ?>