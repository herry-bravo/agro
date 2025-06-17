<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="<?php echo e(route("admin.orders.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.po')); ?> </a>
                        <a href="<?php echo e(route("admin.orders.index")); ?>" class="breadcrumbs__item">Purchase Order List </a>
                        <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.purchaseOrder.fields.create')); ?> </a>
                    </h6>
            </div>
            <hr>
                <div class="card-body">
                    <form action="<?php echo e(route("admin.orders.store")); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal create_purchase">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-25">
                                    <label class="col-sm-0  form-label" for="number"><?php echo e(trans('cruds.quotation.fields.number')); ?></label>
                                    <input type="text" class="form-control" readonly name="segment1" autocomplete="off" maxlength="10" value="<?php echo e($po_number); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site"><?php echo e(trans('cruds.quotation.fields.supplier')); ?></label>
                                    <input type="text" class="form-control search_supplier_name" placeholder="Type here ..." placeholder="" name="supplier_name" autocomplete="off" required>
                                    <span class="help-block search_supplier_name_empty" style="display: none;">No Results Found ...</span>
                                    <input type="hidden" class="search_vendor_id" name="vendor_id">
                                    
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Vendor Site</label>
                                    <input type="text" class="form-control supplier_site_id" value="" placeholder="Type here ..." name="site_name" autocomplete="off" required>
                                    <span class="help-block supplier_site_id_empty" style="display: none;">No Results Found ...</span>
                                    <input type="hidden" class="search_vendor_site_id" name="vendor_site_id" value="">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Currency</label>
                                    <input type="text" class="form-control search_currency" name="currency_code" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Taxes</label>
                                    <select name="select_tax" id="select_tax" class="form-control select2">
                                        <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->tax_rate); ?>" <?php echo e(old('price_list_name') ? 'selected' : ''); ?>> <?php echo e($row->tax_name); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>">
                            <input type="hidden" id="type_lookup_code" value='1' name="type_lookup_code">
                            <input type="hidden" id="organization_id" value='222' name="organization_id">
                            <input type="hidden" id="rate_date" value="<?php echo e(date('d-M-Y H:i:s')); ?>" name="rate_date">
                            <div class="col-md-3">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="number">Seller</label>
                                    <select name="agent_id" id="agent_id" class="form-control select2" required>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($id); ?>" <?php echo e((in_array($id, old('users', [])) || isset($role) && $users->contains($id)) ? 'selected' : ''); ?>><?php echo e($users->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Delivery To</label>
                                    <input type="text" class="form-control search_address1 " placeholder="" name="address1" autocomplete="off" required>
                                    <span class="help-block search_address1_empty" style="display: none;">No Results Found ...</span>
                                    <input type="hidden" class="search_ship_to_location" name="ship_to_location">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Payment Methode</label>
                                    <select name="payment_method" id="payment_method" class="form-control select2">
                                        <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->id); ?>" <?php echo e(old('price_list_name') ? 'selected' : ''); ?>> <?php echo e($row->terms_name); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-2">
                                    <label class="col-sm-0 form-label" for="site">Creation Date</label>
                                    <input type="text" id="created_at" readonly name="created_at" class="form-control" value="<?php echo e(date('d-M-Y H:i:s')); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="mb-2">
                                    <label class="form-check-label mb-50" for="customSwitch10">Action</label>
                                    <div class="form-check form-switch form-check-primary">
                                        <input type="checkbox" class="form-check-input" name="checked" id="customSwitch10" checked="">
                                        <label class="form-check-label" for="customSwitch10">
                                            <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg></span>
                                            <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg></span>
                                        </label>
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="box box-default">
                                <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Purchase Item</th>
                                                <th>UOM</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Need By Date</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="purchase_container">
                                            <tr class="tr_input">
                                                <td width="30%">
                                                    <input type="text" class="form-control search_purchase_item" placeholder="Type here ..." name="item_code[]" id="searchitem_1" autocomplete="off" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span>
                                                    <input type="hidden" class="search_inventory_item_id" id="id_1" name="inventory_item_id[]" autocomplete="off">
                                                    <input type="hidden" class="form-control" value="" id="description_1" name="description_item[]" autocomplete="off">
                                                </td>
                                                <td width="10%">
                                                    <input type="text" class="form-control search_uom_conversion" name="po_uom_code[]" id="uom_1" autocomplete="off">
                                                    <span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                                </td>
                                                <td width="10%">
                                                    <input type="text" class="form-control purchase_quantity" name="purchase_quantity[]" id="qty_1" autocomplete="off" required>
                                                </td>
                                                <td width="8%">
                                                    <input type="text" class="form-control purchase_cost" name="purchase_cost[]" id="price_1" onblur="cal()" autocomplete="off" readonly>
                                                </td>
                                                <td width="10%">
                                                    <input type="date" name="need_by_date[]" class="form-control datepicker" id="need_1" autocomplete="off">
                                                </td>
                                                <td width="15%">
                                                    <input type="text" class="form-control stock_total" name="sub_total[]" id="total_1"="" readonly="">
                                                </td>
                                                <td width="5%">
                                                    <button type="button" class="btn btn-ligth btn-sm" style="position: inherit;">X</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3">
                                                    <button type="button" class="btn btn-light btn-sm add_purchase_product"><i data-feather='plus'></i> Add More</button>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table></br>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group">
                                <label>Purchase Total</label>
                                <input type="text" class="form-control purchase_total" value="<?php echo e($grand_total?? ''); ?>" readonly="" name="purchase_total">
                            </div>
                        </div>
                        <!-- <div class="row mt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Miscellaneous expense</label><br>
                                    <input type="text" class="form-control " name="attribute2" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Tax ( % )</label><br>
                                    <input type="number" class="form-control purchase_tax_percent" name="tax_percent" step="0.01" min="0" max="100" value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tax ( Amount )</label><br>
                                    <input type="text" class="form-control purchase_tax_amount" name="tax_amount" min="0" value="0">
                                </div>
                            </div>
                            <div class=" col-md-4">
                                <div class="form-group">
                                    <label>Purchase Total</label>
                                    <input type="text" class="form-control purchase_total" value="<?php echo e($grand_total?? ''); ?>" readonly="" name="purchase_total">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="box box-default">
                                <div class="box-body">
                                    <div class="row mt-1 mb-1">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type='text' class="form-control" value="<?php echo e($purchaseorder->description ??''); ?>" name="description" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Catalog</label>
                                                <input type="text" class="form-control grand_total btn  btn-secondary" name="grand_total" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label>Terms</label>
                                                <input type="button" class="form-control purchase_payment btn btn-info" data-toggle="modal" data-target="#demoModal" value="Set Terms" name="payment" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Shipment By</label>
                                                <select name="ship_via_code" id="status" class="form-control">
                                                    <option value='Land'>Land</option>
                                                    <option value='Air'>Air</option>
                                                    <option value='Sea'>Sea</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Approval Status</label>
                                                <input type="text" class="form-control grand_total " value="Submit" name="status_name" readonly="">
                                                <input type="hidden" class="form-control grand_total " name="status_name" value='1' readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        </br>
                        <!-- /.box-body -->
                        <div class="d-flex justify-content-between mb-50">
                            <button type="reset" class="btn btn-warning pull-left">Reset</button>
                            <button type="submit" class="btn btn-primary pull-right" name='action' value="manual"><i class="fa fa-plus"></i> Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            </div>
        </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/purchase/create.blade.php ENDPATH**/ ?>