<?php $__env->startSection('content'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_create')): ?>
    <?php endif; ?>
<div class="card">
    <div class="card-header">

        <h6 class="card-title">
            <a href="" class="breadcrumbs__item">Setting </a>
            <a href="<?php echo e(route("admin.bankaccount.index")); ?>" class="breadcrumbs__item">  <?php echo e(trans('cruds.bankaccount.title')); ?> </a>
        </h6>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_create')): ?>
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary" href="<?php echo e(route('admin.bankaccount.create')); ?>">
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg></span>
                            <?php echo e(trans('cruds.bankaccount.fields.add')); ?> <?php echo e(trans('cruds.bankaccount.title')); ?></a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="bankaccounttable" class="table table-striped table-hover datatable datatable-Order">
                <thead>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.bankaccount.fields.acombinations')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.bankaccount.fields.rparties')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.bankaccount.fields.category')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.bankaccount.fields.acc')); ?>

                        </th>

                        <th style="width: 1%" >
                            <?php echo e(trans('cruds.bankaccount.fields.arflag')); ?>

                        </th>
                        <th style="width: 1%" >
                            <?php echo e(trans('cruds.bankaccount.fields.apflag')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.bankaccount.fields.date')); ?>

                        </th>
                        <th >
                            <?php echo e(trans('cruds.bankaccount.fields.action')); ?>

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
            var table = $('#bankaccounttable').DataTable({
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
                    url: "/search/bankacc",
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
                            return row.bank_acct_use_id;
                        }
                    },
                    {
                        "targets": 1,
                        "render": function(data, type, row, meta){
                            return row.org_party_id;
                        }
                    },
                    {
                        "targets": 2,
                        "render": function(data, type, row, meta){
                            return row.attribute_category;
                        }
                    },
                    {
                        "targets": 3,
                        "render": function(data, type, row, meta){
                            return row.attribute1;
                        }
                    },
                    {
                        "targets": 4,
                        className: "text-center",
                        "render": function(data, type, row, index){
                            if(row.ar_use_enable_flag==1){
                                content = `<a class="badge bg-primary text-white">Yes</a>`;
                            }else{
                                content = `<a class="badge bg-danger text-white">No</a>`;

                            }
                            return content;
                        }
                    },
                    {
                        "targets": 5,
                        "render": function(data, type, row, index){
                            if(row.ap_use_enable_flag==1){
                                content = `<a class="badge bg-primary text-white">Yes</a>`;
                            }else{
                                content = `<a class="badge bg-danger text-white">No</a>`;
                            }
                            return content;
                        }
                    },
                    {
                        "targets": 6,
                        "render": function(data, type, row, meta){
                            return row.created_at;
                        }
                    },

                    {
                        "targets": 7,
                        className: "text-center",
                        render: function(data, type, row, index) {
                        content = `
                        <a class="btn btn-sm btn-warning" href="bankaccount/${row.id}/edit">
                            <?php echo e(trans('global.edit')); ?>

                        </a>`;

                        return content;
                    }
                    , }

                ],
                fixedColumns: true,
                searching: true
                , displayLength:10,
                    });
                });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/bankaccount/index.blade.php ENDPATH**/ ?>