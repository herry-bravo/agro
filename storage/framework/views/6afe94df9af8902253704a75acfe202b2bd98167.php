
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_create')): ?>
<?php endif; ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header  ">
                    <h6 class="card-title">
                        <a href="<?php echo e(route("admin.orders.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.po')); ?> </a>
                        <a href="<?php echo e(route("admin.orders.index")); ?>" class="breadcrumbs__item">Purchase Order List </a>
                    </h6>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchaseOrder_access')): ?>
                            <a class="btn btn-primary" href="<?php echo e(route("admin.orders.create")); ?>">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg></span>
                                <?php echo e(trans('cruds.purchaseOrder.title_singular')); ?> </a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-purchase" class="table table-bordered table-striped w-100 dataTable no-footer" data-source="data-source">
                            <thead>
                                <tr>
                                    <th style="text-align: left;">
                                        <input type="checkbox" class='form-check-input dt-checkboxes' id="head-cb">
                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.order.fields.order_number')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.purchaseOrder.fields.customer_code')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.order.fields.customer_name')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.quotation.fields.currency')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.purchaseorder.fields.rate_date')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.purchaseorder.fields.buyer')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.purchaseorder.fields.status')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('cruds.order.fields.created_at')); ?>

                                    </th>
                                    <th>
                                        #
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

            var table = $('#table-purchase').DataTable({
                "bServerSide": true
                , ajax: {
                    url: '<?php echo e(url("search/po-report")); ?>'
                    , type: "POST"
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , data: function(d) {
                        return d
                    }
                }
                , responsive: true
                , scrollY: true
                , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
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
                            content = ` <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_show')): ?> <a target="_blank" class="badge btn-sm btn-primary" href="orders/${row.po_head_id}">
                            <?php echo e(trans('global.view')); ?>

                        </a> <?php endif; ?>   <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_edit')): ?><a class="badge btn-sm btn-info" href="orders/${row.po_head_id}/edit">
                            <?php echo e(trans('global.open')); ?>

                        </a> <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_delete')): ?><a  class="badge btn-delete btn-accent btn-danger m-btn--pill btn-sm m-btn m-btn--custom" data-index="${row.id}"><?php echo e(trans('global.delete')); ?></a> <?php endif; ?>
                       `;
                            return content;
                        }
                        , targets: [9]
                    }
                ]
                , drawCallback: function(e, response) {
                    $(".btn-delete").click(function(event) {
                        var index = $(this).data('index');
                        var token = $("meta[name='csrf-token']").attr("content");
                        swal.fire({
                                title: "Delete " + index + " ?"
                                , type: "question"
                                , showCancelButton: true
                                , focusCancel: true
                                , dangerMode: true
                                , closeOnClickOutside: false
                            })
                            .then((confirm) => {
                                if (confirm.value) {
                                    $.ajax({
                                            url: '<?php echo e(url("admin/orders")); ?>/' + index
                                            , method: "DELETE"
                                            , dataType: "JSON"
                                            , headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                            , data: {
                                                "id": index
                                            , }
                                        , })
                                        .done(function(resp) {
                                            console.log(resp);
                                            if (resp.success) {
                                                swal.fire("Info", resp.message, "success");
                                                table.ajax.reload();
                                            } else {
                                                swal.fire("Warning", resp.message, "warning");
                                            }
                                        })
                                        .fail(function() {
                                            swal.fire("Warning", 'Unable to process request at this moment', "warning");
                                        });
                                } else {
                                    event.preventDefault();
                                    return false;
                                }
                            });
                    });
                }
                , columns: [{
                        data: 'id'
                        , className: "text-center"
                    }
                    , {
                        data: 'order_number'
                    }, {
                        data: 'vendor_id'
                    }, {
                        data: 'vendor_name'
                    }, {
                        data: 'currency'
                    }, {
                        data: 'rate_date'
                    }, {
                        data: 'agent_id'
                        , className: "text-end"
                    }, {
                        data: 'status'
                        , className: "text-end"
                    }, {
                        data: 'created_at'
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
            })
        });

    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro\resources\views/admin/purchase/index.blade.php ENDPATH**/ ?>