
<?php $__env->startSection('styles'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_create')): ?>
<?php endif; ?>
<div class="card">
    <div class="card-header">

        <h6 class="card-title">
            <a href="<?php echo e(route("admin.missTransaction.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.physic.fields.inv')); ?> </a>
            <a href="<?php echo e(route("admin.missTransaction.index")); ?>" class="breadcrumbs__item">Miscellaneous Transaction </a>
        </h6>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_create')): ?>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaladd" onclick="generateRandomNumber()" href="">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                    <?php echo e(trans('global.add')); ?> Miscellaneous
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <table id="table-miss" class=" table table-striped display" style="width:100%" data-source="data-source">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        <?php echo e(trans('cruds.trx.fields.item')); ?>

                    </th>
                    <th>
                        Product
                    </th>
                    <th>
                        Category
                    </th>
                    <th>
                        SubInventory
                    </th>
                    <th class="text-end">
                        Quantity
                    </th>
                    <th class="text-end">
                        UOM
                    </th>
                    <th class="text-start">
                        Reference
                    </th>
                    <th class="text-start">
                        Source
                    </th>
                    <th class="text-end">
                        <?php echo e(trans('cruds.trx.fields.transaction_date')); ?>

                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<form action="<?php echo e(route("admin.missTransaction.create")); ?>" method="GET" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <!-- Modal Example Start-->
    <div class="modal fade" id="modaladd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">

                        <div class="row">
                            <div class="mb-1 col-md-2">
                                <label class="control-label" for="number" required>Date</label>
                            </div>
                            <div class="mb-1 col-md-10">
                                <input type="text" id="datepicker-1" class="form-control " value="<?php echo e(date('m/d/Y')); ?>" required autocomplete="off" name="date">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-1 col-md-2">
                                <label class="control-label" for="number">Type</label>
                            </div>
                            <div class="mb-1 col-md-10">
                                <select name="trx_code" class="form-control select2" required>

                                    <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($row->trx_code); ?>"><?php echo e($row->trx_types); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-1 col-md-2">
                                <label class="control-label" for="number">Reference</label>
                            </div>
                            <div class="mb-1 col-md-10">
                                <input type="text" class="form-control search_ref_aju" name="reference" id='idtrf' value="MI-<?php echo e(date("yis")); ?>" autocomplete="off">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i data-feather='plus'></i>Transaction Lines</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    function generateRandomNumber() {
        var date = new Date();
        var year = date.getFullYear();
        var twoDigitYear = year.toString().slice(-2);
        var hours = date.getHours();
        var day = date.getDate();
        var seconds = date.getSeconds();
        var randomNumber = "MI-" + twoDigitYear + day + hours + seconds;
        document.getElementById("idtrf").value = randomNumber;
    }
    $(function() {
        $("#datepicker-1").datepicker({
            maxDate: 0
        });
    });
    $(document).ready(function() {
        //  $.fn.dataTable.ext.errMode = 'none';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#table-miss').DataTable({
            "bServerSide": true
            , ajax: {
                url: '<?php echo e(url("search/miss-report")); ?>'
                , type: "GET"
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
                    <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
            , displayLength: 15
            , "lengthMenu": [
                    [10, 25, 50, -1]
                    , [10, 25, 50, "All"]
                ]

            , columnDefs: [{

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                    , targets: [0]
                }, {
                    render: function(data, type, row, index) {
                        return type === 'display' && data.length > 40 ?
                            '<span id="outer" title="' + data + '">' + data.substr(0, 40) + '</span><span id="show"> ...</span>' :
                            data;
                    }
                    , targets: [2]
                }

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
                    , customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '10pt')


                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', '10pt');
                    }
                    , header: true
                    , title: '<i>Internal</i> Surat Jalan</br> '
                    , orientation: 'landscape'
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
                }
            , ]
            , columns: [{
                    data: 'id'
                    , className: "text-center"
                , }
                , {
                    data: 'item_code'
                    , className: "text-start"
                }, {
                    data: 'description'
                    , className: "text-start"
                }, {
                    data: 'category'
                    , className: "text-start"
                }, {
                    data: 'subinventory_code'
                    , className: "text-start"
                }, {
                    data: 'transaction_quantity'
                    , className: "text-end"
                }, {
                    data: 'type_code'
                    , className: "text-center"
                }, {
                    data: 'transaction_reference'
                    , className: "text-start"
                }, {
                    data: 'transaction_source_name'
                    , className: "text-start"
                }, {
                    data: 'transaction_date'
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

        });
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/missTransaction/index.blade.php ENDPATH**/ ?>