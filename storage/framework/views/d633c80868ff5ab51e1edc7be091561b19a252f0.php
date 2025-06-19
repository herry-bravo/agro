
<?php $__env->startSection('styles'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo e($error); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header mt-50">
                <h6 class="card-title ">
                    <a href="<?php echo e(route("admin.physic.index")); ?>" class="breadcrumbs__item">Inventory </a>
                    <a href="<?php echo e(route("admin.physic.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.physic.title')); ?> </a>
                    <a href="<?php echo e(route("admin.physic.create")); ?>" class="breadcrumbs__item">Create </a>
                </h6>
            </div>
            <hr>
            <div class="card-body">
                <form action="<?php echo e(route('admin.physic.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.physic.fields.date')); ?></label>
                            <input type="date" id="datePicker" name="gl_date" class="form-control datepicker" value="" required>
                            <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id?? ''); ?>">
                            <input type="hidden" id="created_by" name="last_updated_by" value="<?php echo e(auth()->user()->id); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.physic.fields.subinv_from')); ?></label>
                            <select id="order" name="segment1" class="form-control select2">
                                <option selected></option>
                                <?php $__currentLoopData = $subInventory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($row->id); ?>"><?php echo e($row->sub_inventory_name); ?> - <?php echo e($row->description); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4    ">
                            <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.physic.fields.subinv_to')); ?> </label>
                            <select id="grn" name="receipt_num" class="form-control select2">
                                <option selected></option>
                                <?php $__currentLoopData = $subInventory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($row->id); ?>"><?php echo e($row->sub_inventory_name); ?> - <?php echo e($row->description); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="box box-default">
                            <div class="box-body scrollx" style="height: 450px;overflow: scroll;">
                                <table class="table table-striped tableFixHead">
                                    <thead>
                                        <th scope="col">Item</th>
                                        <th scope="col">UOM</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subinventory</th>
                                        <th scope="col">Locator</th>
                                        <th scope="col">Rev</th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="physical_container">
                                        <tr class="tr_input">
                                            
                                            <td width="30%">
                                                <input type="text" class="form-control search_item_code " placeholder="Type here ..." name="item_code[]" id="searchitem_1" autocomplete="off" required>
                                                <span class="help-block search_item_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                                <input type="hidden" class="search_inventory_item_id" id="id_1" name="inventory_item_id[]"></td>
                                            <input type="hidden" class="form-control" value="" id="description_1" name="description_item[]" autocomplete="off">
                                            <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id?? ''); ?>">
                                            <td width="10%">
                                                <input type="text" class="form-control" name="tag_uom[]" id="uom_1" autocomplete="off" readonly>
                                            </td>
                                            <td width="10%">
                                                <input type="text" class="form-control" name="tag_quantity[]" id="tag_quantity_1" autocomplete="off">
                                            </td>
                                            <td width="20%">
                                                <input type="text" class="form-control search_subinventory" value="" name="subinventory1[]" id="subinventoryfrom_1" autocomplete="off">
                                                <input type="hidden" class="form-control subinvfrom_1" name="subinventory[]" id="subinvfrom_1" autocomplete="off">
                                            </td>
                                            <td width="20%">
                                                <input type="text" name="locator_id[]" class="form-control" id="locator_1" autocomplete="off" required>
                                            </td>
                                            <td width="20%">
                                                <input type="text" name="revision[]" class="form-control " id="rev_1" autocomplete="off">
                                            </td>
                                            <td width="10px">
                                                <button type="button" class="btn btn-ligth btn-sm" style="position: inherit;">X</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">
                                                <button type="button" class="btn btn-light btn-sm add_physicalInventory btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <br>
                        </div>

                        <div class="d-flex justify-content-between mb-1">
                            <button class="btn btn-sm btn-warning" type="reset"><i data-feather='refresh-ccw'></i> Reset</button>
                            <button class="btn btn-sm btn-danger btn-submit"><i data-feather='save'></i> <?php echo e(trans('global.save')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
<script>
    $(function() {
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_delete')): ?>
        let deleteButtonTrans = '<?php echo e(trans('
        global.datatables.delete ')); ?>'
        let deleteButton = {
            text: deleteButtonTrans
            , url: "<?php echo e(route('admin.purchase-requisition.massDestroy')); ?>"
            , className: 'btn-danger'
            , action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('<?php echo e(trans('
                        global.datatables.zero_selected ')); ?>')

                    return
                }

                if (confirm('<?php echo e(trans('
                        global.areYouSure ')); ?>')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            }
                            , method: 'POST'
                            , url: config.url
                            , data: {
                                ids: ids
                                , _method: 'DELETE'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        <?php endif; ?>
    })

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/physicalInventory/create.blade.php ENDPATH**/ ?>