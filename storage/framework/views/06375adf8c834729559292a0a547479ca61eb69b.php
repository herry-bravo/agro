
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_create')): ?>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <h6 class="card-title ">
            <a href="<?php echo e(route("admin.physic.index")); ?>" class="breadcrumbs__item">Inventory </a>
            <a href="<?php echo e(route("admin.physic.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.physic.fields.adj')); ?> </a>
        </h6>

        <div class="d-flex justify-content-center">
            <div class="bd-highlight " style="margin-top: 5%;font-weight: bold;">
                Action : &nbsp
            </div>
            <div class="bd-highlight">
                <button type='submmit' class="form-control btn btn-warning arrow-right-circle btn-sm " id="allselect" disabled> Apply</button>
            </div>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_create')): ?>
        <div class="row">
            <div class="col-lg-12">
                <fieldset>
                    <div class="input-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: 1%;">
                            <i data-feather='plus'></i> <?php echo e(trans('global.create')); ?>

                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="<?php echo e(route("admin.physic.create")); ?>">
                                <?php echo e(trans('cruds.physic.manual')); ?>

                            </a>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modaladd">
                                <?php echo e(trans('cruds.physic.excel')); ?>

                            </a>
                            <div role="separator" class="dropdown-divider"></div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <form action="<?php echo e(route('admin.physic.autoApply')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <table id="table_007" class="table datatable-Order w-100">
            <thead>
                <tr>
                    <th>
                        &nbsp; &nbsp; &nbsp;<input type="checkbox" class='form-check-input dt-checkboxes' id="head-cb">
                    </th>
                    <th>
                        <?php echo e(trans('cruds.physic.fields.location')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.physic.fields.item')); ?>

                    </th>

                    <th>
                        <?php echo e(trans('cruds.physic.fields.qty')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.physic.fields.uom')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.physic.fields.qtycounted')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.physic.fields.difference')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.physic.fields.created_at')); ?>

                    </th>
                    <th><?php echo e(trans('global.status')); ?></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </form>
</div>
</div>
</div>

<div class="modal fade" id="modaladd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-primary">
                <h4 class="modal-title text-white" id="exampleModalLongTitle"><?php echo e(trans('cruds.autocreate.title')); ?> </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('admin.physic.importExcel')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="mt-1">
                                    <label class="col-sm-0 mb-1 control-label" for="number"><?php echo e(trans('cruds.physic.excel')); ?> :</label><br>
                                    <input type="file" name="file">
                                    <input type="hidden" name="attribute_date1" value="<?php echo e(date('Y-m-d')); ?>">
                                    <input type="hidden" name="created_by" value="<?php echo e(auth()->user()->id?? ''); ?>">
                                    <input type="hidden" name="created_at" value="<?php echo e(date('Y-m-d H:i:s')); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="Submit" class="btn btn-primary" name='action' value="existing">Create</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('script'); ?>
    <script>
        var editor;
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.txtedit').hide();

            const table = $('#table_007').DataTable({
                "bServerSide": true
                , ajax: {
                    url: '<?php echo e(url("search/onhand-report")); ?>'
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
                        <"d-flex justify-content-between mx-0 mt-50 row"\
                        <"col-sm-12 col-md-5"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>\
                        >t>'
                , displayLength: 25
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
                        extend: 'colvis'
                        , text: feather.icons['eye'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Colvis'
                        , className: ''
                    }
                ]
                , columnDefs: [{
                        render: function(data, type, row, index) {
                            content = `  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('item_edit')): ?>
                        <a   data-id="${row.id}" id="apply" style="font-size:11px;"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                                                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                            </svg> Apply</a>
                        <?php endif; ?>`;
                            return content;
                        }
                        , targets: [8]
                    }
                    , {
                        render: function(data, type, row, index) {
                            content = ` <input type="text"  class="form-control txtedit text-end" data-id="${row.id}" id="${row.id}" value="${row.physical_inventory}" style="border-bottom: none;font-size: 11px;" >`;
                            return content;
                        }
                        , targets: [5]
                    }
                    , {
                        render: function(data, type, row, index) {
                            content = `<input type="checkbox" class="form-check-input dt-checkboxes"  onfocus="this.blur()" disabled  name="lines[]" value="${row.id}" id="checkbox" />`;
                            return content;
                        }
                        , targets: [0]
                    }
                    , {
                        render: function(data, type, row, index) {
                            content = `<span id="different${row.id}">${row.different}</span>
                                    <input type="hidden"  class="form-control  text-end" data-id="${row.id}" id="different${row.id}" value="${row.different}"   onfocus="this.blur()" readonly="readonly" style="border-bottom: none; background-color: white;font-size: 11px;" >
                                    <input type="hidden"  class="form-control  text-end" data-id="${row.id}" id="value" value="${row.transaction_quantity}"  >
                        `;
                            return content;
                        }
                        , targets: [6]
                    }
                    , {
                        render: function(data, type, row, index) {
                            return type === 'display' && data.length > 20 ?
                                '<span id="outer" title="' + data + '">' + data.substr(0, 40) + '</span><span id="show"> ...</span>' :
                                data;
                        }
                        , targets: [2]
                    }
                ]
                , columns: [{
                        data: ''
                        , className: "text-center"
                    }
                    , {
                        data: 'subinventory'
                    }, {
                        data: 'item_code_desc'
                    }, {
                        data: 'transaction_quantity'
                        , className: "text-end"
                    }, {
                        data: 'primary_uom_code'
                        , className: "text-center"
                    }, {
                        data: ''
                    }, {
                        data: ''
                        , className: "text-end"
                    }, {
                        data: 'transaction_date'
                        , className: "text-end"
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

            // $('#table_007').on( 'click', '.txtedit', function (e) {
            //     var edit_id = $(this).data('id');
            //          if (document.getElementById($(this).data('id')).value =='') {
            //           document.getElementById($(this).data('id')).value = '00.0';
            //            }
            //     });

            $('#table_007').on('focusout', '.txtedit', function(e) {

                if (document.getElementById($(this).data('id')).value == '') {
                    document.getElementById($(this).data('id')).value = '';
                } else {
                    var id = $(this).data('id');
                    var value = document.getElementById($(this).data('id')).value;

                    $.ajax({
                        url: '<?php echo e(url("search/phyupdate")); ?>'
                        , type: 'POST'
                        , data: {
                            value: value
                            , id: id
                        , }
                        , success: function(result) {
                            $('#different' + id).html(result.data);
                        }
                    })

                }
            });

            $('#table_007').on('keyup', '.txtedit', function(e) {
                if (e.which === 9)
                    document.getElementById('checkbox').blur();
                //console.log(id);
            });

            $('#table_007').on('click', '#apply', function(e) {
                var value = document.getElementById($(this).data('id')).value;
                var id = $(this).data('id');
                if (value != '') {
                    $.ajax({
                        url: '<?php echo e(url("search/updatebyid")); ?>'
                        , type: 'POST'
                        , data: {
                            value: value
                            , id: id
                        , }
                        , success: function(result) {
                            document.getElementById('different' + id).value = '';
                            $('#table_007').DataTable().ajax.reload();
                        }
                    })
                }
            });


        });

    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/physicalInventory/index.blade.php ENDPATH**/ ?>