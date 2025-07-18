
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<a href="./" class="breadcrumbs__item">Inventory</a>

<a href="#" class="breadcrumbs__item">Subinventory Transfer</a>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header mt-2 mb-50">

                    <h6 class="card-title">
                        <a href="<?php echo e(route("admin.mtl-transfer.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.physic.fields.inv')); ?> </a>
                        <a href="<?php echo e(route("admin.mtl-transfer.index")); ?>" class="breadcrumbs__item">Subinventory Transfer </a>
                        <a href="<?php echo e(route("admin.mtl-transfer.create")); ?>" class="breadcrumbs__item">Create </a>
                    </h6>
                </div>
                <hr>
                <div class="card-body">
                    <form action="<?php echo e(route("admin.mtl-transfer.store")); ?>" method="POST" enctype="multipart/form-data" onsubmit="disableButton()">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> <?php echo e(trans('cruds.inventory.fields.item_number')); ?></th>
                                            <th>Category</th>
                                            <th> <?php echo e(trans('cruds.inventory.fields.subinventory')); ?></th>
                                            <th> <?php echo e(trans('cruds.trx.fields.subinventory_to')); ?></th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">UOM</th>
                                            <th class="text-center">Reference</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="transfer_container">
                                        <tr class="tr_input">
                                            <td width="30%">
                                                <input type="text" class="form-control search_item_code" placeholder="Type here ..." name="item_code[]" id="searchitem_1" autocomplete="off" required><span class="help-block search_item_code_empty_1" style="display: none;" required>No Results Found ...</span>
                                                <input type="hidden" class="search_inventory_item_id" id="id_1" name="inventory_item_id[]" autocomplete="off">
                                                <input type="hidden" class="form-control" value="" id="description_1" name="description_item[]" autocomplete="off">
                                            </td>
                                            <td width="10%">
                                                <input type="text" class="form-control search_subcategory_code_" value="" name="category[]" id="subcategory_1" required autocomplete="off">
                                            </td>
                                            <td width="14%">
                                                <input type="text" class="form-control search_subinventory" value="" name="subinventory_from[]" id="subinventoryfrom_1" required autocomplete="off">
                                                <input type="hidden" class="form-control subinvfrom_1" name="subinvfrom[]" id="subinvfrom_1" autocomplete="off">
                                            </td>
                                            <td width="14%">
                                                <input type="text" class="form-control search_subinventoryto" name="subinventory_to[]" id="subinventoryto_1" required autocomplete="off">
                                                <input type="hidden" class="form-control subinvto_1" name="subinvto[]" id="subinvto_1" autocomplete="off">
                                            </td>
                                            <td width="11%">
                                                <input type="text" class="form-control  text-end" name="quantity[]" id="quantity_1" autocomplete="off">
                                            </td>
                                            <td width="8%">
                                                <input type="text" class="form-control text-center" name="uom[]" id="uom_1" autocomplete="off" readonly required>
                                            </td>

                                            <td width="13%">
                                                <input type="text" class="form-control search_ref_aju" value="<?php echo e($reference ?? ''); ?>" name="reference[]" id="reference_1" autocomplete="off">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-ligth btn-sm " style="position: inherit;">X</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">
                                                <button type="button" class="btn btn-light btn-sm add_transfer"><i data-feather='plus'></i> Add More</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table></br>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Transaction Date</label><br>
                                    <input type="text" class="form-control " name="transaction_date" readonly value="<?php echo e(Carbon\Carbon::parse($request->transaction_date)->format('d-M-Y H:i:s')); ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Transaction Type</label><br>
                                    <input type="text" class="form-control purchase_tax_percent" value="<?php echo e($trx->trx_actions); ?>" name="transaction_type">
                                    <input type="hidden" class="form-control purchase_tax_percent" value="<?php echo e($trx->trx_code); ?>" name="transaction_code">
                                    <input type="hidden" name="form_token" value="<?php echo e(uniqid()); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label></label><br>
                                    <input type="text" class="form-control purchase_tax_amount" name="tax_amount">
                                </div>
                            </div>
                            <div class=" col-md-4">
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control purchase_total" value="" readonly="" name="purchase_total"> </br>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        </br>
                        <div class="d-flex justify-content-between mb-50">
                            <button type="reset" class="btn  btn-warning pull-left">Reset</button>

                            <button type="submit" class="btn btn-primary"><i data-feather='plus'></i>Save</button>
                        </div>
                </div>
                </form>
            </div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>

<script>
    function disableButton() {
        document.querySelector('button[type="submit"]').disabled = true;
    }

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/mtlTransfer/create.blade.php ENDPATH**/ ?>