<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_create')): ?>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <h6 class="card-title">
            <a href="<?php echo e(route("admin.purchase-requisition.index")); ?>" class="breadcrumbs__item">Purchase Requisition </a>
        </h6>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('requisition_create')): ?>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="<?php echo e(route("admin.purchase-requisition.create")); ?>">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                    <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.requisition.title_singular')); ?> </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table  table-striped datatable " id="report-pr">
                <thead>
                    <tr style="text-align: center;">
                        <th width="10">
                            No
                        </th>

                        <th>
                            <?php echo e(trans('cruds.requisition.fields.number')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.requisition.fields.requested')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.requisition.fields.created_at')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.requisition.fields.status')); ?>

                        </th>
                        <th class="text-center">
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

        const table = $('#report-pr').DataTable({
            "bServerSide": true
            , ajax: {
                url: '<?php echo e(url("search/pr-report")); ?>'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    return d
                }
            }
            , responsive: true
            , searching: true
            , scrollY: true
            , dom: '<"card-header border-bottom"\
                                                                                    <"head-label">\
                                                                                    <"dt-action-buttons text-end">\
                                                                                >\
                                                                                <"d-flex justify-content-between row mt-1"\
                                                                                    <"col-sm-12 col-md-8"Bl>\
                                                                                    <"col-sm-12 col-md-2"f>\
                                                                                    <"col-sm-12 col-md-2"p>\
                                                                                ti>'
            , displayLength: 7
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
                        if (row.authorized_status === '13') {
                            return content = `<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('requisition_show')): ?>
                                    <a class="btn btn-primary btn-sm" href="purchase-requisition/${row.id}">
                                        <?php echo e(trans('global.view')); ?>

                                    </a>
                                    <?php endif; ?>`;
                        } else {
                            if (row.intattribute1 === null && row.app_lvl === '0' && row.created_by == row.login) {
                                edit = `
                                <button type="submit" data-index="${row.id}" data-mgr="${row.usrmgr}" class="btn btn-sm  btn-update btn-info"><?php echo e(trans('global.submitto')); ?> ${row.user_manager}
                                </button>`;
                            } else if (row.userstatus == 5) {
                                edit = `<a class="btn btn-sm btn-secondary" href="purchase-requisition/${row.id}/edit">
                                <?php echo e(trans('global.actions')); ?>

                                  </a>`;
                            } else if (row.intattribute1 === null && row.created_by == row.login) {
                                edit = `<a class="btn btn-sm btn-secondary" href="purchase-requisition/${row.id}/edit">
                                <?php echo e(trans('global.actions')); ?>

                                  </a>`;
                            } else {
                                edit = ``;
                            }
                            if ((row.usrmgr === row.login && row.app_lvl === row.userstatus) || (row.app_lvl === row.userstatus && row.userstatus >= '2')) {
                                app = ` <form action="purchase-requisition/${row.id}/edit" method="GET" style="display: inline-block;">
                                    <input type="hidden" name="action" value="mgr">
                                    <button type="submit" class="btn btn-sm btn-info"><?php echo e(trans('global.approve')); ?>

                                    </button>
                                </form>`;
                            } else {
                                app = ``;
                            }
                            if (row.intattribute1 === null && row.app_lvl === '0' && row.created_by == row.login) {
                                deleted = ` <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('requisition_delete')): ?>
                                    <button type="button" class="btn btn-delete btn-accent btn-danger m-btn--pill btn-sm m-btn m-btn--custom" data-index="${row.id}"><?php echo e(trans('global.delete')); ?></button>
                                    <?php endif; ?>`;
                            } else {
                                deleted = ``;
                            }
                            content = `<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('requisition_show')): ?>
                                    <a class="btn btn-primary btn-sm" href="purchase-requisition/${row.id}">
                                        <?php echo e(trans('global.view')); ?>

                                    </a>
                                    <?php endif; ?>`;
                            return content + edit + app + deleted;
                        }
                    }
                    , targets: [5]
                }
            ]
            , drawCallback: function(e, response) {
                $(".btn-update").click(function(event) {
                    var id = $(this).data('index');
                    var token = $("meta[name='csrf-token']").attr("content");
                    swal.fire({
                        title: "Submit " + id + " ?"
                        , type: "question"
                        , showCancelButton: true
                        , focusCancel: true
                        , dangerMode: true
                        , closeOnClickOutside: false
                    }).then((confirm) => {
                        if (confirm.value) {
                            $.ajax({
                                    url: '<?php echo e(url("admin/app")); ?>/' + id
                                    , method: "PATCH"
                                    , dataType: "JSON"
                                    , headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                    , data: {
                                        "id": id
                                        , "app_lvl": 1
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
                                        url: '<?php echo e(url("admin/purchase-requisition")); ?>/' + index
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
            , columns: [{
                    data: 'id'
                    , className: "text-center"
                }
                , {
                    data: 'pr_number'
                    , className: "text-center"

                }, {
                    data: 'user'
                    , className: "text-center"
                }, {
                    data: 'created_at'
                    , className: "text-center"
                }, {
                    data: 'status'
                    , className: "text-center"

                }
                , {
                    data: '',

                    className: "text-center"
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/purchaseRequisition/index.blade.php ENDPATH**/ ?>