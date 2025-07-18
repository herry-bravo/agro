<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header  ">
                    <h6 class="card-title">
                        <a href="<?php echo e(route("admin.deliveries.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.OrderManagement.title')); ?> </a>
                        <a href="<?php echo e(route("admin.deliveries.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.Delivery.title_singular')); ?></a>
                    </h6>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delivery_create')): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaladd" href="">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg></span>
                                <?php echo e(trans('cruds.Delivery.button.confirm')); ?>

                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <table id="table-delivery" class=" table table-bordered table-striped table-hover datatable-Transaction w-100">
                        <thead>
                            <tr>
                                <th style="text-align: center;">
                                    No
                                </th>
                                <th scope="col">
                                    <?php echo e(trans('cruds.shiping.modaltable.iddev')); ?>

                                </th>
                                <th scope="col">
                                    <?php echo e(trans('cruds.Delivery.table.cname')); ?>

                                </th>
                                <th scope="col">
                                    <?php echo e(trans('cruds.Delivery.table.shipto')); ?>

                                </th>
                                <th scope="col">
                                    <?php echo e(trans('cruds.Delivery.table.surat_jalan')); ?>

                                </th>
                                <th scope="col">
                                    <?php echo e(trans('cruds.Delivery.table.note')); ?>

                                </th>
                                <th scope="col">
                                    Requested Qty
                                </th>
                                <th scope="col">
                                    Packing Qty
                                </th>
                                <th scope="col">
                                    Packing
                                </th>
                                <th scope="col" class="text-center">
                                    <?php echo e(trans('cruds.Delivery.table.dt')); ?>

                                </th>
                                <th>
                                    <?php echo e(trans('cruds.Delivery.table.status')); ?>

                                </th>
                                <th style="width: 10%" class="text-center">
                                    <?php echo e(trans('global.action')); ?>

                                </th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <br>
                </div>
                <!--Modal Confirm Delivery-->
                <div class="modal fade" id="modaladd" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title text-white"><?php echo e(trans('cruds.Delivery.modal.confirm')); ?></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form id="formship" action="<?php echo e(route("admin.deliveries.create")); ?>" method="get" enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="mb-1">
                                                    <br>
                                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Delivery.modal.deliverynumb')); ?></label>
                                                    <input placeholder="Delivery Number" type="number" id="delivery_form" name="delivery_form" class="form-control" value="" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i><?php echo e(trans('cruds.Delivery.modal.conf')); ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
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

        const table = $('#table-delivery').DataTable({
            "bDestroy": true
            , ajax: {
                url: '<?php echo e(url("search/delivery-report")); ?>'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
            , responsive: false
            , scroll: true
            , searching: true
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

                        if (row.packing_slip_number == null) {
                            content = `<a class="badge bg-secondary text-white">Not Complete</a>`;
                        } else if (row.lvl == 11) {
                            content = `<a class="badge bg-warning text-white">${row.trx_name}</a>`;
                        } else if (row.lvl == 12) {
                            content = `<a class="badge bg-primary text-white">${row.trx_name}</a>`;
                        } else if (row.lvl == 6 || row.lvl == 7 || row.lvl == 14 || row.lvl == 8) {
                            content = `<a class="badge bg-info text-white">${row.trx_name}</a>`;
                        }

                        return content;
                    }
                    , className: "text-center"
                    , targets: [10]
                }
                , {
                    render: function(data, type, row, index) {

                        content = `<a class="badge btn btn-sm btn-primary" href="deliveries/${row.id}" >
                                    <?php echo e(trans('global.detil')); ?>

                                </a>`;

                        if (row.lvl == 8) {
                            fullfill = `<a class="badge btn btn-sm btn-warning" value="${row.id}" href="deliveries/${row.id}/edit" >
                                <?php echo e(trans('global.fulfill')); ?></a>`;
                        } else {
                            fullfill = '';
                        }
                        return content + fullfill;
                    }
                    , className: "text-center"
                    , targets: [11]
                }
            ]
            , columns: [{
                    data: 'no'
                    , className: "text-center"
                }, {
                    data: 'id'
                    , className: "text-center"
                }, {
                    data: 'customer_name'
                }, {
                    data: 'site'
                }, {
                    data: 'packing_slip_number'
                }, {
                    data: 'note'
                }
                , {
                    data: 'delivered_quantity'
                    , className: "text-end"
                }, {
                    data: 'qty'
                    , className: "text-end"
                }, {
                    data: 'roll'
                    , className: "text-end"
                }, {
                    data: 'shipment_date'
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
        })

        $(document).on('click', '.sales_filter', function() {

            var rev = $("#rev").val();
            var customer = $("#customer").val();
            console.log(rev, customer);

            $('#modalFilter').modal('hide');
            $('#table-sales').DataTable().ajax.reload()
        });
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/deliveries/index.blade.php ENDPATH**/ ?>