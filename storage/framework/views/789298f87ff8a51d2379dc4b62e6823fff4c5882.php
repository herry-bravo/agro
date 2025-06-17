
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">

        <h6 class="card-title">
            <a href="" class="breadcrumbs__item">Settings </a>
            <a href="<?php echo e(route("admin.site.index")); ?>" class="breadcrumbs__item">  <?php echo e(trans('cruds.site.title_singular')); ?> </a>
        </h6>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('transaction_create')): ?>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="<?php echo e(route("admin.site.create")); ?>">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                    <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.site.title_singular')); ?>

                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="table-site" class=" table table-bordered table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.vendor.fields.vendor_code')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.vendor.fields.vendor_name')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.vendor.fields.address1')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.vendor.fields.country')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.vendor.fields.phone')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.vendor.fields.email')); ?>

                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total</th>
                        <th colspan="4" id="total_order" class="text-center"></th>
                    </tr>
                </tfoot>
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
        var table = $('#table-site').DataTable({
            "bServerSide": true
            , ajax: {
                url: '<?php echo e(url("search/site-data")); ?>'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    return d
                }
            }
            , responsive: true
            ,scrollX :true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
            , displayLength: 20
            , "lengthMenu": [
                [10, 25, 50, -1]
                , [10, 25, 50, "All"]
            ]
            ,'paging': true
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
                },
                {
                    render: function (data, type, row, index) {
                        return type === 'display' && data.length > 20 ?
                            '<span id="outer" title="' + data + '">' + data.substr(0, 40) + '</span><span id="show"> ...</span>' :
                            data;
                    },
                    targets: [2,3]
                }
                , {
                    render: function(data, type, row, index) {
                        content = `<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('transaction_show')): ?>
                            <a class="badge btn-sm btn-primary waves-effect waves-float waves-light" href="site/${row.id}/show" >
                                <?php echo e(trans('global.view')); ?>

                            </a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('transaction_edit')): ?>
                            <a class="badge btn-warning btn-sm waves-effect waves-float waves-light" href="site/${row.id}/edit" >
                                <?php echo e(trans('global.edit')); ?>

                            </a>
                            <?php endif; ?>
                            `;
                        return content;
                    }
                    , targets: [7]
                }
            ]
            , columns: [{
                    data: 'id'
                    , className: "text-center"
                }
                , {
                    data: 'site_code'
                }, {
                    data: 'address1'
                }, {
                    data: 'address2'
                }, {
                    data: 'country'
                }, {
                    data: 'phone'
                }, {
                    data: 'email'
                },  {
                    data: ''
                    , className: "text-center"
                }
            ],
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
            , "footerCallback": function(tfoot, data, start, end, display) {
                var api = this.api();

                var length = table.page.info().recordsTotal;

                $(api.column(5).footer()).html(length.toLocaleString()+' Vendors');
            }

        })
    });

</script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/site/index.blade.php ENDPATH**/ ?>