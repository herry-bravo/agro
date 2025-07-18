
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
            <a href="" class="breadcrumbs__item">Setting </a>
            <a href="<?php echo e(route("admin.tax.index")); ?>" class="breadcrumbs__item">  <?php echo e(trans('cruds.tax.title')); ?> </a>
        </h6>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_create')): ?>
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary" href="<?php echo e(route('admin.tax.create')); ?>" style="margin-top: 8%;">
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg></span>
                        <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.tax.title')); ?>

                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="taxtable" class=" table table-striped w-100" data-source="data-source">
                <thead>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.tax.fields.taxcode')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.tax.fields.taxreg')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.tax.fields.taxname')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.tax.fields.taxrate')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.tax.fields.taxtaxes')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.tax.fields.taxtype')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.tax.fields.taxaccount')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.tax.fields.createdat')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.tax.fields.action')); ?>

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
        $('#taxtable').DataTable({
            "bServerSide": true,
            ajax: {
                url: '<?php echo e(url('search/taxlist')); ?>',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function(d) {
                    return d
                }
            }
            , responsive: true
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
                }
            , displayLength: 10,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            columnDefs: [

                {
                    "targets": 0,
                    "render": function(data, type, row, meta) {
                        return row.tax_code;
                    }
                },
                {
                    "targets": 1,
                    "render": function(data, type, row, meta) {
                        return row.tax_regimes_b;
                    }
                },
                {
                    "targets": 2,
                    "render": function(data, type, row, meta) {
                        return row.tax_name;
                    }
                },
                {
                    "targets": 3,
                    "render": function(data, type, row, meta) {
                        return row.tax_rate;
                    }
                },
                {
                    "targets": 4,
                    "render": function(data, type, row, meta) {
                        return row.tax_taxes_tl;
                    }
                },
                {
                    "targets": 5,
                    "render": function(data, type, row, meta) {
                        return row.type_tax_use;
                    }
                },
                {
                    "targets": 6,
                    "render": function(data, type, row, meta) {
                        return row.tax_account;
                    }
                },
                {
                    "targets": 7,
                    "render": function(data, type, row, meta) {
                        return row.created_at;
                    }
                },
                {
                    "targets": 8,
                    className: "text-center",
                            render: function(data, type, row, index) {
                            content = `
                            <a class="btn btn-sm btn-info" href="tax/${row.id}/edit">
                                <?php echo e(trans('global.open')); ?>

                            </a>`;

                            return content;
                        }
                },
            ],
            buttons: [{
                extend: 'print',
                text: feather.icons['printer'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Print',
                className: '',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'csv',
                text: feather.icons['file-text'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Csv',
                className: '',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'excel',
                text: feather.icons['file'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Excel',
                className: '',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'pdf',
                text: feather.icons['clipboard'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Pdf',
                className: '',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'copy',
                text: feather.icons['copy'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Copy',
                className: '',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'colvis',
                text: feather.icons['eye'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Colvis',
                className: ''
            }, {
                text: feather.icons['filter'].toSvg({
                    class: 'font-small-4 me-50 '
                }) + 'Filter',
                className: 'btn-warning',
                action: function(e, node, config) {
                    $('#modalFilter').modal('show')
                },
            }, {
                text: feather.icons['edit'].toSvg({
                    class: 'font-small-4 me-50 '
                }) + 'Set',
                className: 'btn-secondary',
                action: function(e, node, config) {
                    $('#modalSet').modal('show')
                },
            }, ]
        })
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/tax/index.blade.php ENDPATH**/ ?>