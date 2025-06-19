
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-validation.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header ">
                    <h6 class="card-title">
                        <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.OrderManagement.title')); ?> </a>
                        <a href="<?php echo e(route("admin.shipment.index")); ?>" class="breadcrumbs__item"> <?php echo e(trans('cruds.shiping.title_singular')); ?> </a>
                    </h6>
                    <div class="row">
                        <div class="col-lg-12">
                            <fieldset>
                                <div class="input-group">
                                <!-- <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaladd">
                                            <?php echo e(trans('cruds.shiping.button.add_new')); ?>

                                        </a> -->
                                    <!-- <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaladd">
                                            <?php echo e(trans('cruds.shiping.button.add_new')); ?>

                                        </a>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modaladditem">
                                            <?php echo e(trans('cruds.shiping.button.add_item')); ?>

                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                    </div> -->
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="shipmentTable" class=" table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th><?php echo e(trans('cruds.shiping.modaltable.iddev')); ?></th>
                                <th><?php echo e(trans('cruds.shiping.modaltable.sonumb')); ?></th>
                                <th><?php echo e(trans('cruds.shiping.modaltable.ponumb')); ?></th>
                                <th><?php echo e(trans('cruds.shiping.modaltable.sales_order')); ?></th>
                                <th><?php echo e(trans('cruds.shiping.modaltable.cs')); ?></th>
                                <th><?php echo e(trans('cruds.shiping.modaltable.suratjalan')); ?></th>
                                <th><?php echo e(trans('cruds.shiping.modaltable.note')); ?></th>
                                
                                <th>Qty</th>
                                
                                <th>Shipment Date</th>
                                <th><?php echo e(trans('cruds.shiping.modaltable.next_step')); ?></th>
                                <th class="text-start">
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo e(trans('global.action')); ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                
                <div class="modal fade" id="modaladd" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title text-white"><?php echo e(trans('cruds.shiping.modaltable.addnewitemheader')); ?></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body ">
                                <div class="card">
                                    <div class="card-body">
                                        <form data-url="<?php echo e(url("admin.shipment.store")); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <br>
                                            <div class="form-group row">
                                                <label class="col-sm-1 control-label" for="header_id"><?php echo e(trans('cruds.shiping.modal.billto')); ?></label>
                                                <div class="col-sm-5">
                                                    <input autocomplete="off" type="text" id="inputhead" name="inputhead" class="form-control inputhead" value="" placeholder="Search Customer...">
                                                </div>
                                                <label class="col-sm-1 control-label" for="line_id"><?php echo e(trans('cruds.shiping.modal.shipto')); ?></label>
                                                <div class="col-sm-5">
                                                    <input autocomplete="off" type="text" id="lineid" name="lineid" class="form-control inputhead" value="" placeholder="Search Shipto...">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group row">
                                                <label class="col-sm-1 control-label" for="supplier"><?php echo e(trans('cruds.shiping.modal.order_from')); ?></label>
                                                <div class="col-sm-5">
                                                    <input autocomplete="off" type="text" id="orderfrom" name="orderfrom" class="form-control inputhead" value="" placeholder="Search Order From...">
                                                </div>
                                                <label class="col-sm-1 control-label" for="site"><?php echo e(trans('cruds.shiping.modal.order_to')); ?></label>
                                                <div class="col-sm-5">
                                                    <input autocomplete="off" type="text" id="orderto" name="orderto" class="form-control inputhead" value="" placeholder="Search Order to...">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="d-flex justify-content-between">
                                                <div> </div>
                                                <button id="btnFiterSubmitSearchzz" class="btn btn-primary pull-right" type="button"><i data-feather='search'></i> <?php echo e(trans('cruds.shiping.button.search')); ?> Item</button>
                                            </div>
                                            <br>
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <div class="box-body" style="height: 420px">
                                                        <table id="filterdatadetail" class="table table-striped w-100 datatable-Transaction">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        <input class="form-check-input item_check text-start" id="filtercheck" type="checkbox" value="" />
                                                                    </th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.sales_order')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.ln')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.cs')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.item')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.qty')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.cpo')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.line_status')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.next_step')); ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="3">
                                                                        <button type="submit" name='action' value="add_item_first" id="add_all" class="btn btn-outline-success pull-right" style="font-size: 12px;"><i data-feather='plus'></i><?php echo e(trans('cruds.shiping.modaltable.additem')); ?></button>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="modal fade" id="modaladditem" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title text-white"><?php echo e(trans('cruds.shiping.modaltable.additemheader')); ?></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body ">
                                <div class="card">
                                    <div class="card-body">
                                        <form data-url="<?php echo e(url("admin.shipment.store")); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <br>
                                            <div class="form-group row">
                                                <label class="col-sm-1 control-label" for="header_id"><?php echo e(trans('cruds.shiping.modal.billto')); ?></label>
                                                <div class="col-sm-5">
                                                    <input autocomplete="off" type="text" id="party_name" name="party_name" class="form-control" value="" placeholder="Search Customer...">
                                                </div>
                                                <label class="col-sm-1 control-label" for="line_id"><?php echo e(trans('cruds.shiping.modal.shipto')); ?></label>
                                                <div class="col-sm-5">
                                                    <input autocomplete="off" type="text" id="site_code" name="site_code" class="form-control" value="" placeholder="Search Shipto...">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group row">
                                                <label class="col-sm-1 control-label" for="supplier"><?php echo e(trans('cruds.shiping.modal.order_from')); ?></label>
                                                <div class="col-sm-5">
                                                    <input autocomplete="off" type="text" id="order_numberfrom" name="order_numberfrom" class="form-control" value="" placeholder="Search Order From...">
                                                </div>
                                                <label class="col-sm-1 control-label" for="site"><?php echo e(trans('cruds.shiping.modal.order_to')); ?></label>
                                                <div class="col-sm-5">
                                                    <input autocomplete="off" type="text" id="order_numberto" name="order_numberto" class="form-control" value="" placeholder="Search Order to...">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="d-flex justify-content-between">
                                                <div> </div>
                                                <button id="btnFiterSubmitSearchSecondzz" class="btn btn-primary pull-right" type="button"><i data-feather='search'></i> <?php echo e(trans('cruds.shiping.button.search')); ?> Item</button>
                                            </div>
                                            <br>
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <div class="box-body" style="height: 500px">
                                                        <table id="itemshipment" class="table table-striped w-100 table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        <input class="form-check-input sub_chk" id="masterckcbx" type="checkbox" style="width:1%px;" value="" />
                                                                    </th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.sales_order')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.ln')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.cs')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.item')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.qty')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.cpo')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.line_status')); ?></th>
                                                                    <th><?php echo e(trans('cruds.shiping.modaltable.next_step')); ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <select type="text" id="idhead" name="idhead" class="form-control select2">
                                                                            <?php $__currentLoopData = $DeliveryHeader; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if($row->lvl==6): ?>
                                                                            <option name="idhead" value="<?php echo e($row->id); ?>"><?php echo e($row->id); ?> </option>
                                                                            <?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </td>
                                                                    <td colspan="3">
                                                                        <button class="btn btn-outline-success pull-right" name='action' value="add_item_second" type="submit"><i data-feather='plus'></i> <?php echo e(trans('cruds.shiping.modaltable.additem')); ?></button>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        , }
    });

    $(document).ready(function() {
        var table = $('#shipmentTable').DataTable({
            "bDestroy": true
            , "lengthMenu": [
                [10, 25, 'All']
                , [10, 25, 'All']
            ],

            searching: true
            , displayLength: 15
            , responsive: false
            , scrollX: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
            , buttons: [{
                    text: feather.icons['printer'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Print'
                    , className: 'print'
                    , attr: {
                        id: 'print'
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
            , ajax: {
                url: '<?php echo e(url("search/shipment-data")); ?>'
                , type: "GET"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    return d
                }
            , }
            , drawCallback: function(e, response) {

                $(".print").click(function(event) {
                    $(".cb-sales:checked").each(function() {
                        if ($(".cb-sales:checked").length == 1) {
                            var id = $(this).attr('data-id');
                            console.log(id);
                            window.open(
                                "deliveryOrders/" + id + ""
                                , '_blank'
                            );
                        } else {
                            alert('Please select one row !!')
                        }

                    })
                })

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
                                        url: '<?php echo e(url("admin/deliveries")); ?>/' + index
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
                })
            }
            , columnDefs: [{
                    "targets": 0
                    , render: function(data, type, row, index) {
                        if (row.roll_status == 1) {
                            var info = `<input type="checkbox" class="form-check-input cb-sales dt-checkboxes" data-id="${row.delivery_id}"  name="id[]" id="checkBox" value="${row.delivery_id}"> `;
                        } else {
                            var info = ``;
                        }
                        return info;
                    }
                }
                , {
                    "targets": 1
                    , "render": function(data, type, row, meta) {
                        return row.delivery_id;
                    }
                }
                , {
                    "targets": 2
                    , "render": function(data, type, row, meta) {
                        return row.order_number;
                    }
                }
                , {
                    "targets": 3
                    , "render": function(data, type, row, meta) {
                        return row.customer_po;
                    }
                }
                , {
                    "targets": 4
                    , "render": function(data, type, row, meta) {
                        return row.customer_code;
                    }
                }
                , {
                    "targets": 5
                    , "render": function(data, type, row, meta) {
                        return row.customer_name;
                    }
                }
                , {
                    "targets": 6
                    , "class": "text-center"
                    , "render": function(data, type, row, meta) {
                        return row.delivery_note;
                    }
                }
                , {
                    "targets": 7
                    , "render": function(data, type, row, meta) {
                        return row.note;
                    }
                },
                // {
                //     "targets": 8,
                //     "render": function(data, type, row, meta){
                //         return row.currency;
                //     }
                // },
                {
                    "targets": 8
                    , "class": "text-end"
                    , "render": function(data, type, row, meta) {
                        return row.qty_total;
                    }
                },
                // {
                //     "targets": 10,
                //     "render": function(data, type, row, meta){
                //         return row.amount;
                //     }
                // },
                {
                    "targets": 9
                    , "class": "text-end"
                    , "render": function(data, type, row, meta) {
                        return row.date;
                    }
                }
                , {
                    "targets": 10
                    , "render": function(data, type, row, meta) {
                        return row.status;
                    }
                }
                , {
                    "targets": 11
                    , "class": "text-center"
                    , render: function(data, type, row, index) {
                        content = `
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('price_list_edit')): ?>
                            <a class="badge btn  btn-sm btn-warning" href="shipment/${row.delivery_id}/edit">
                                <?php echo e(trans('global.open')); ?>

                            </a>
                            <?php endif; ?>`;
                        del = `
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_delete')): ?>
                                    <button type="button" class=" badge btn btn-delete btn-accent btn-danger m-btn--pill btn-sm m-btn m-btn--custom" data-index="${row.id}"><?php echo e(trans('global.delete')); ?></button>
                            <?php endif; ?>`;

                        return content + del;
                    }
                }
            , ]
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/shipments/index.blade.php ENDPATH**/ ?>