
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
            <a href="<?php echo e(route('admin.subInventory.index')); ?>" class="breadcrumbs__item">Inventory
            </a>
            <a href="<?php echo e(route('admin.subInventory.index')); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.subInventory.title_singular')); ?> <?php echo e(trans('global.list')); ?> </a>
        </h6>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="<?php echo e(route('admin.subInventory.create')); ?>">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                    <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.subInventory.title_singular')); ?>

                </a>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tblSubInventory" class="table datatable table-responsive-lg ">
                <thead>
                    <tr>
                        <th class="text-center">
                            #
                        </th>
                        <th>
                            <?php echo e(trans('cruds.subInventory.fields.sub_inventory_name')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.subInventory.fields.description')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.subInventory.fields.locator_type')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.subInventory.fields.attribute_category')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.subInventory.fields.sub_inventory_group')); ?>

                        </th>
                        <th class="text-center">Option
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
        var table = $('#tblSubInventory').DataTable({
            "bServerSide": true
            , ajax: {
                url: '<?php echo e(url("search/subinv-data")); ?>'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    return d
                }
            }
            , responsive: false
            , scrollY: true
            , searching: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
            , displayLength: 20
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
                        content = `
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('price_list_edit')): ?>
                        <a class=" badge btn  btn-sm btn-info" href="subInventory/${row.id}/edit">
                            <?php echo e(trans('global.open')); ?>

                        </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_delete')): ?><button type="button" class=" badge btn btn-delete btn-accent btn-danger m-btn--pill btn-sm m-btn m-btn--custom" data-index="${row.id}"><?php echo e(trans('global.delete')); ?></button>
                         <?php endif; ?>
                       `;
                        return content;
                    }
                    , targets: [6]
                }
            ]
            , columns: [{
                    data: 'id'
                    , className: "text-center"
                }
                , {
                    data: 'sub_inventory_name'
                }
                , {
                    data: 'description'
                }, {
                    data: 'locator_type'
                }, {
                    data: 'attribute_category'
                }, {
                    data: 'sub_inventory_group'
                    , class: 'text-start'
                }, {
                    data: ''
                    , class: 'text-center'
                }
            ]
        })
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/subinventory/index.blade.php ENDPATH**/ ?>