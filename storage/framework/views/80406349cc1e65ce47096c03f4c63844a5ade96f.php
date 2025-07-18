<?php $__env->startSection('content'); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<div class="card">
    <div class="card-header pt-1 mb-1">
        <h6 class="card-title">
            <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.gl.title')); ?></a>
            <a href="<?php echo e(route("admin.gl.index")); ?>" class="breadcrumbs__item"> Journal Entries </a>
        </h6>
    </div>
    <div class="card-body">
        <table id="gltable" class="table table-striped w-100 " data-source="data-source">
            <thead>
                <tr>

                    <th>
                        Periode
                    </th>
                    <th>
                        &nbsp; &nbsp; &nbsp; &nbsp; company&nbsp; &nbsp; &nbsp;
                    </th>
                    <th>
                        &nbsp; &nbsp; &nbsp; journal &nbsp; &nbsp; &nbsp;
                    </th>
                    <th>
                        Journal entries
                    </th>

                    <th>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Account &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    </th>
                    <th>
                        Desc

                    </th>
                    <th>
                        label

                    </th>
                    <th class="text-end">
                        Debit

                    </th>
                    <th class="text-end">
                        Credit

                    </th>
                    <th>
                        &nbsp; &nbsp; &nbsp; Effective Date &nbsp; &nbsp; &nbsp;

                    </th>
                    <th>
                        Ledger ID
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
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
        var table = $('#gltable').DataTable({
            "bDestroy": true
            , "lengthMenu": [
                [10, 25, ]
                , [10, 25]
            ]
            , responsive: false
            , scrollY: true
            , searching: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                        <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
            , language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;'
                    , next: '&nbsp;'
                }
            }
            , "ajax": {
                url: "/search/journalEntries"
                , type: "GET"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            , },

            buttons: [{
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
                    "targets": 0
                    , "render": function(data, type, row, meta) {
                        return row.period;
                    }
                }
                , {
                    "targets": 1
                    , "render": function(data, type, row, meta) {
                        return row.company;
                    }
                }
                , {
                    "targets": 2
                    , "render": function(data, type, row, meta) {
                        return row.journal;
                    }
                }
                , {
                    "targets": 3
                    , "render": function(data, type, row, meta) {
                        return row.journal_entries;
                    }
                }
                , {
                    "targets": 4
                    , "render": function(data, type, row, meta) {
                        return row.account;
                    }
                },

                {
                    "targets": 5
                    , "render": function(data, type, row, meta) {
                        return row.partner;
                    }
                }
                , {
                    "targets": 6
                    , "render": function(data, type, row, meta) {
                        return row.description;
                    }
                }
                , {
                    "targets": 7
                    , className: "text-end"
                    , "render": function(data, type, row, meta) {
                        return row.dr;
                    }
                }
                , {
                    "targets": 8
                    , className: "text-end"
                    , "render": function(data, type, row, meta) {
                        return row.cr;
                    }
                }
                , {
                    "targets": 9
                    , className: "text-center"
                    , render: function(data, type, row, index) {
                        return row.effective_date;

                    }
                }
                , {
                    "targets": 10
                    , className: "text-center"
                    , render: function(data, type, row, index) {
                        return row.ledger;

                    }
                }
            , ]
            , fixedColumns: true
            , searching: true
            , displayLength: 20
        , });
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/glmanual/entriesIndex.blade.php ENDPATH**/ ?>