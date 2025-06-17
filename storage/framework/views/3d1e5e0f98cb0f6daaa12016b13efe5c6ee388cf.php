<?php $__env->startSection('content'); ?>
    <?php $__env->startPush('script'); ?>
        <script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
        <script src="<?php echo e(asset('app-assets/js/scripts/currency.min.js')); ?>"></script>
        <script src="<?php echo e(asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header  mt-1 mb-25">
                        <h6 class="card-title">
                            <a href="<?php echo e(route('admin.deliveries.index')); ?>"
                                class="breadcrumbs__item"><?php echo e(trans('cruds.OrderManagement.title')); ?> </a>
                            <a href="<?php echo e(route('admin.deliveries.index')); ?>"
                                class="breadcrumbs__item"><?php echo e(trans('cruds.Delivery.title')); ?> </a>
                            <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.Delivery.fields.create')); ?></a>
                    </div>
                    <hr>
                    <br>
                    <form id="formship" action="<?php echo e(route('admin.deliveries.update', $DeliveryHeader->delivery_id)); ?>"
                        method="POST" enctype="multipart/form-data">
                        <div class="card-body">

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="form-group">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label"
                                                for="segment1"><?php echo e(trans('cruds.shiping.fields.customer_name')); ?></label>
                                            
                                            <select type="text" id="customer" name="customer"
                                                class="form-control select2"
                                                value="<?php echo e($DeliveryHeader->sold_to_party_id); ?>" required>
                                                <option value="<?php echo e($DeliveryHeader->sold_to_party_id); ?>" selected>
                                                    <?php echo e($DeliveryHeader->sold_to_party_id); ?>

                                                    -<?php echo e($DeliveryHeader->customer->party_name); ?> </option>
                                            </select>
                                            <input type="hidden" value="<?php echo e($DeliveryHeader->sold_to_party_id); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label"
                                                for="segment1"><?php echo e(trans('cruds.shiping.fields.customer_shipto')); ?></label>
                                            <select disabled type="text" id="customer_shipto" name="customer_shipto"
                                                class="form-control select2"
                                                value="<?php echo e($DeliveryHeader->ship_to_party_id); ?>" required>
                                                <option selected value="<?php echo e($DeliveryHeader->ship_to_party_id); ?>">
                                                    <?php echo e($DeliveryHeader->party_site->site_code); ?>/
                                                    <?php echo e($DeliveryHeader->party_site->address1); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="segment1">Attribute</label>
                                            <input type="text" class="form-control" name="text" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="segment1"><?php echo e(trans('cruds.shiping.fields.surat_jalan')); ?></label>
                                            <input readonly type="text" id="invoice_no" name="invoice_no"
                                                class="form-control" value="<?php echo e($DeliveryHeader->dock_code); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label"
                                                for="segment1"><?php echo e(trans('cruds.shiping.fields.order_letter_no')); ?></label>
                                            <input readonly="readonly" id="delivery_name" name="delivery_name"
                                                class="form-control text-end" value="<?php echo e($DeliveryHeader->delivery_id); ?>">
                                            <input type="hidden" id="id" name="id"
                                                value="<?php echo e($DeliveryHeader->id); ?>">
                                            <input type="hidden" id="delivery_id" name="delivery_id"
                                                value="<?php echo e($DeliveryHeader->delivery_id); ?>">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="segment1"><?php echo e(trans('cruds.shiping.fields.note')); ?></label>
                                            <input readonly type="text" id="note" name="note"
                                                class="form-control" value="<?php echo e($DeliveryHeader->attribute2); ?>" required>

                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label"
                                                for="segment1"><?php echo e(trans('cruds.shiping.fields.invoice_date')); ?></label>
                                            
                                            <input readonly type="text" id="datepicker-1" name="invoice_date"
                                                value="<?= date('d-M-Y', strtotime($DeliveryHeader->on_or_about_date)) ?>"
                                                class="form-control datepicker text-end" autocomplete="off" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label"
                                                for="segment1"><?php echo e(trans('cruds.shiping.fields.status')); ?></label>
                                            
                                            <select disabled type="text" id="status" name="status"
                                                class="form-control select2" value="<?php echo e($DeliveryHeader->status_code); ?>"
                                                required>
                                                <option value="<?php echo e($DeliveryHeader->status_code); ?>}">
                                                    <?php echo e($DeliveryHeader->trx_name); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-sales-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-sales" type="button" role="tab"
                                            aria-controls="nav-sales" aria-selected="true">
                                            <span class="bs-stepper-box">
                                                <i data-feather="shopping-bag" class="font-medium-3"></i>
                                            </span>
                                            Item
                                        </button>
                                        
                                        <!-- <button class="nav-link" id="nav-priceList-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-priceList" type="button" role="tab"
                                            aria-controls="nav-priceList" aria-selected="false">
                                            <span class="bs-stepper-box">
                                                <i data-feather="file-text" class="font-medium-3"></i>
                                            </span>
                                            Roll
                                        </button> -->
                                    </div>
                                </nav>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="nav-tabContent">
                                    
                                    <div class="tab-pane fade show active" id="nav-sales" role="tabpanel"
                                        aria-labelledby="nav-sales-tab">
                                        <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                            <table
                                                class="table table-bordered table-striped table-hover datatable-Transaction datatable">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 0%">

                                                        </th>
                                                        <th>
                                                            NO
                                                        </th>
                                                        <th style="width: 10%"><?php echo e(trans('cruds.shiping.table.sn')); ?></th>
                                                        <th><?php echo e(trans('cruds.Delivery.table.line')); ?></th>
                                                        <th><?php echo e(trans('cruds.shiping.table.custpo')); ?></th>
                                                        <th><?php echo e(trans('cruds.shiping.table.item_no')); ?></th>
                                                        <th><?php echo e(trans('cruds.shiping.table.item_desc')); ?></th>
                                                        <th><?php echo e(trans('cruds.Delivery.table.qty')); ?></th>
                                                        <!-- <th><?php echo e(trans('cruds.shiping.table.uom')); ?></th> -->
                                                        <th style="width: 0%"><?php echo e(trans('cruds.Delivery.table.inv')); ?></th>
                                                        <?php if($DeliveryHeader->lvl == 7): ?>
                                                        <?php else: ?>
                                                            <th></th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $DeliveryDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $deliveryDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            
                                                            <td></td>
                                                            <td style="width: 0%">
                                                                <h6>
                                                                    <?php echo e($no++); ?>

                                                                </h6>
                                                            </td>
                                                            <td style='font-size:11px'>
                                                                <h6>
                                                                    <?php echo e($deliveryDetail->source_header_number ?? ''); ?>

                                                                </h6>
                                                            </td>
                                                            <td style="width: 0%">
                                                                <h6>
                                                                    <?php echo e((float) $deliveryDetail->source_line_id ?? ''); ?>

                                                                </h6>
                                                            </td>
                                                            <td>

                                                                <?php echo e($deliveryDetail->cust_po_number ?? ''); ?>


                                                            </td>
                                                            <td>
                                                                <h6><?php echo e($deliveryDetail->ItemMaster->item_code ?? ''); ?></h6>
                                                                <input type="hidden" value="<?php echo e($deliveryDetail->id); ?>"
                                                                    name="id[]" class="detilchbx"
                                                                    data-id="<?php echo e($deliveryDetail->id); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($deliveryDetail->delivery_detail_id); ?>"
                                                                    name="delivery_detail_id[]" class="detilchbx"
                                                                    data-id="<?php echo e($deliveryDetail->delivery_detail_id); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($deliveryDetail->inventory_item_id); ?>"
                                                                    name="inventory_item_id[]" class="detilchbx"
                                                                    data-id="<?php echo e($deliveryDetail->inventory_item_id); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($deliveryDetail->requested_quantity); ?>"
                                                                    name="requested_quantity[]" class="detilchbx"
                                                                    data-id="<?php echo e($deliveryDetail->requested_quantity); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($deliveryDetail->roll_qty); ?>"
                                                                    name="roll_qty[]" class="detilchbx"
                                                                    data-id="<?php echo e($deliveryDetail->roll_qty); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($deliveryDetail->requested_quantity_uom); ?>"
                                                                    name="requested_quantity_uom[]" class="detilchbx"
                                                                    data-id="<?php echo e($deliveryDetail->requested_quantity_uom); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($deliveryDetail->subinventory); ?>"
                                                                    name="subinventory[]" class="detilchbx"
                                                                    data-id="<?php echo e($deliveryDetail->subinventory); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($deliveryDetail->source_line_id); ?>"
                                                                    name="source_line_id[]" class="detilchbx"
                                                                    data-id="<?php echo e($deliveryDetail->source_line_id); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($deliveryDetail->attribute1); ?>"
                                                                    name="attribute1[]" class="detilchbx"
                                                                    data-id="<?php echo e($deliveryDetail->attribute1); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($deliveryDetail->source_header_id); ?>"
                                                                    name="source_header_id[]" class="detilchbx"
                                                                    data-id="<?php echo e($deliveryDetail->source_header_id); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($DeliveryHeader->created_by); ?>"
                                                                    name="created_by" class="detilchbx"
                                                                    data-id="<?php echo e($DeliveryHeader->created_by); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($DeliveryHeader->on_or_about_date); ?>"
                                                                    name="on_or_about_date" class="detilchbx"
                                                                    data-id="<?php echo e($DeliveryHeader->on_or_about_date); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($DeliveryHeader->currency_code); ?>"
                                                                    name="currency_code" class="detilchbx"
                                                                    data-id="<?php echo e($DeliveryHeader->currency_code); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($DeliveryHeader->packing_slip_number); ?>"
                                                                    name="packing_slip_number" class="detilchbx"
                                                                    data-id="<?php echo e($DeliveryHeader->packing_slip_number); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($DeliveryHeader->attribute_category); ?>"
                                                                    name="attribute_category" class="detilchbx"
                                                                    data-id="<?php echo e($DeliveryHeader->attribute_category); ?>">
                                                                <input type="hidden"
                                                                    value="<?php echo e($DeliveryHeader->dock_code); ?>"
                                                                    name="dock_code" class="detilchbx"
                                                                    data-id="<?php echo e($DeliveryHeader->dock_code); ?>">
                                                            </td>

                                                            <td>
                                                                <h6>
                                                                    <?php echo e($deliveryDetail->item_description ?? ''); ?>

                                                                </h6>
                                                            </td>

                                                            <td style="width: 0%">
                                                                <h6>
                                                                    <?php echo e((float) $deliveryDetail->requested_quantity ?? ''); ?>

                                                                </h6>
                                                            </td>

                                                            <!-- <td style="width: 0%">
                                                                <h6>
                                                                    <?php echo e($deliveryDetail->requested_quantity_uom ?? ''); ?>

                                                                </h6>
                                                            </td> -->
                                                            <td>
                                                                <?php if($deliveryDetail->subinventory == null): ?>
                                                                    <h6>

                                                                    </h6>
                                                                <?php else: ?>
                                                                    <h6>
                                                                        <?php echo e($deliveryDetail->subinventory ?? ''); ?>

                                                                    </h6>
                                                                <?php endif; ?>

                                                            </td>

                                                            <?php if($DeliveryHeader->lvl == 7): ?>
                                                            <?php else: ?>
                                                                <td style="width: 0%">
                                                                    
                                                                    
                                                                    <input type="hidden" id="iddetil" name="iddetil[]"
                                                                        value="<?php echo e($deliveryDetail->id); ?>">
                                                                    
                                                                    

                                                                    <button type='button'
                                                                        class="btn btn-sm btn-mod btn-primary getDetail"
                                                                        id="getDetail" value="<?php echo e($deliveryDetail->id); ?>"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modaladdinv"
                                                                        value="<?php echo e($deliveryDetail->id); ?>"
                                                                        data-id="<?php echo e($deliveryDetail->id); ?>"
                                                                        data-head_id="<?php echo e($deliveryDetail->delivery_detail_id); ?>"
                                                                        data-panjang="<?php echo e($deliveryDetail->intattribute1); ?>"
                                                                        data-lebar="<?php echo e($deliveryDetail->intattribute2); ?>"
                                                                        data-gsm="<?php echo e($deliveryDetail->intattribute3); ?>"
                                                                        data-xnet_weight="<?php echo e($deliveryDetail->net_weight); ?>"
                                                                        data-subinventory_from="<?php echo e($deliveryDetail->subinventory); ?>"
                                                                        data-shipping_inventory="<?php echo e($deliveryDetail->subinventory); ?>"
                                                                        data-source_header="<?php echo e($deliveryDetail->source_header_id); ?>"
                                                                        data-source_line="<?php echo e($deliveryDetail->source_line_id); ?>"
                                                                        data-inventory_item="<?php echo e($deliveryDetail->inventory_item_id); ?>">
                                                                        +
                                                                    </button>
                                                                    

                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-priceList" role="tabpanel"
                                        aria-labelledby="nav-priceList-tab">
                                        <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                            
                                            <table id="table-roll"
                                                class=" table table-bordered table-striped table-hover datatable-Transaction w-100">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Roll Code</th>
                                                        <th scope="col">GSM</th>
                                                        <th scope="col">Width</th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col">Created At</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-1">

                                <a href="" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#modaladdterm"><i
                                        data-feather='file-text'></i><?php echo e(trans('cruds.Delivery.fields.term')); ?></a>
                                
                                <?php if($DeliveryHeader->lvl == 7 || $DeliveryHeader->lvl == 6): ?>
                                    <button class="btn btn-sm btn-warning" type="button"
                                        data-bs-toggle="modal"data-bs-target="#shipconfm"><?php echo e(trans('cruds.Delivery.fields.shipconfirm')); ?></button>
                                <?php endif; ?>


                                
                            </div>
                        </div>
                </div>
                <!--Modal Ship Confirm-->
                <div class="modal fade" id="shipconfm" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title text-white"><?php echo e(trans('cruds.Delivery.fields.shipconfirm')); ?></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="container">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="radio1" name="radio"
                                            value="confirm" checked>
                                        <label class="form-check-label">
                                            <?php echo e(trans('cruds.Delivery.fields.ship')); ?>

                                        </label>
                                    </div>
                                    <br>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="radio2" name="radio"
                                            value="delete">
                                        <label class="form-check-label">
                                            <?php echo e(trans('cruds.Delivery.fields.back')); ?>

                                        </label>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label"></label>
                                        <label class="col-sm-4 control-label"
                                            for="header_id"><?php echo e(trans('cruds.Delivery.fields.actual')); ?></label>
                                        <div class="col-sm-4">
                                            <input required autocomplete="off" type="text" id="fp-default"
                                                name="actualdate" class="form-control flatpickr-basic flatpickr-input">
                                        </div>

                                    </div>
                                    <br>
                                    <div class="d-flex justify-content-between">
                                        <div></div>
                                        <button type="submit" name='action' value="shipconfirmanddelete"
                                            class="btn btn-primary pull-right"><i class="fa fa-plus"></i> OK</button>
                                    </div>
                                    <div class="row">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>

            <!--Modal Term Delivery-->
            <div class="modal fade" id="modaladdterm" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title text-white"><?php echo e(trans('cruds.Delivery.fields.deliveryterm')); ?></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="<?php echo e(route('admin.deliveriesterms.update', $DeliveryHeader->delivery_id)); ?>"
                                method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="form-group">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label"
                                                    for="segment1"><?php echo e(trans('cruds.Delivery.fields.shihpmethodcode')); ?></label>
                                                <?php if($DeliveryHeader->lvl == 6): ?>
                                                    <input placeholder="Input Ship Method Code..." type="text"
                                                        id="ship_method_code" name="ship_method_code"
                                                        class="form-control"
                                                        value="<?php echo e($DeliveryHeader->ship_method_code); ?>" required>
                                                    <input type="hidden" id="id" name="id"
                                                        class="form-control" value="<?php echo e($DeliveryHeader->id); ?>" required>
                                                    
                                                    <input type="hidden" id="created_by" name="created_by"
                                                        class="form-control" value="<?php echo e($DeliveryHeader->created_by); ?>"
                                                        required>
                                                    <input type="hidden" id="updated_by" name="updated_by"
                                                        class="form-control"
                                                        value="<?php echo e($DeliveryHeader->last_updated_by); ?>" required>
                                                <?php else: ?>
                                                    <input readonly placeholder="Input Ship Method Code..." type="text"
                                                        id="ship_method_code" name="ship_method_code"
                                                        class="form-control"
                                                        value="<?php echo e($DeliveryHeader->ship_method_code); ?>" required>
                                                    <input type="hidden" id="created_by" name="created_by"
                                                        class="form-control" value="<?php echo e($DeliveryHeader->created_by); ?>"
                                                        required>
                                                    <input type="hidden" id="updated_by" name="updated_by"
                                                        class="form-control"
                                                        value="<?php echo e($DeliveryHeader->last_updated_by); ?>" required>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label"
                                                    for="segment1"><?php echo e(trans('cruds.Delivery.fields.fobcode')); ?></label>
                                                <?php if($DeliveryHeader->lvl == 6): ?>
                                                    <input placeholder="Input Fob Code..." type="text" id="fob_code"
                                                        name="fob_code" class="form-control"
                                                        value="<?php echo e($DeliveryHeader->fob_code); ?>" required>
                                                <?php else: ?>
                                                    <input readonly placeholder="Input Fob Code..." type="text"
                                                        id="fob_code" name="fob_code" class="form-control"
                                                        value="<?php echo e($DeliveryHeader->fob_code); ?>" required>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <?php if($DeliveryHeader->lvl == 6): ?>
                                        <button type="submit" class="btn btn-primary pull-right"><i
                                                class="fa fa-plus"></i><?php echo e(trans('cruds.Delivery.fields.addterm')); ?></button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal Add Weight Delivery-->
            <div class="modal fade" id="modaladdinv" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title text-white"><?php echo e(trans('cruds.Delivery.fields.addweight')); ?></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Modal body -->
                        <hr>
                        <div class="modal-body">
                            <form id="formship"
                                action="<?php echo e(route('admin.deliveriesdetail.update', $deliveryDetail->id, $deliveryDetail->delivery_detail_id)); ?>"
                                method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="form-group">
                                    <div class="form-group row">
                                        <!-- <div class="col-md-4">
                                            <div class="mb-1">
                                                <label class="form-label"
                                                    for="segment1"><?php echo e(trans('cruds.Delivery.fields.gsm')); ?></label>
                                                <input autocomplete="off" value="<?php echo e($deliveryDetail->subinventory); ?>"
                                                    placeholder="Input Gsm..." type="number" name="gsm"
                                                    class="form-control" required>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-4">
                                            <div class="mb-1">
                                                <label class="form-label"
                                                    for="segment1"><?php echo e(trans('cruds.Delivery.fields.pjg')); ?></label>
                                                <input autocomplete="off" placeholder="Input Length..." type="number"
                                                    name="panjang" class="form-control" required>
                                                <input type="hidden" id="id" name="id"
                                                    class="form-control">
                                                <input type="hidden" name="head_id" class="form-control">
                                                <input type="hidden" name="source_header" class="form-control">
                                                <input type="hidden" name="source_line" class="form-control">
                                                <input type="hidden" name="inventory_item" class="form-control">
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-4">
                                            <div class="mb-1">
                                                <label class="form-label"
                                                    for="segment1"><?php echo e(trans('cruds.Delivery.fields.lbr')); ?></label>
                                                <input autocomplete="off" placeholder="Input Width..." type="number"
                                                    name="lebar" class="form-control" required>
                                            </div>
                                        </div> -->
                                    </div>
                                    <!-- <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="segment1">Counter </label>
                                                <input autocomplete="off" placeholder="Input Weight..." type="text"
                                                    name="xnet_weight" id='RollCounter' class="form-control" required>
                                                <input type="hidden" id="id" name="id"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label"
                                                    for="segment1"><?php echo e(trans('cruds.shiping.fields.gross_weight')); ?></label>
                                                <input autocomplete="off" value="" id="QtyCounter"
                                                    placeholder="Input Weight..." type="text" name="roll_qty"
                                                    class="form-control QtyCounter" required>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="mb-1">
                                                <label class="form-label"
                                                    for="segment1"><?php echo e(trans('cruds.Delivery.fields.sub')); ?></label>
                                                


                                                <select type="text" id="subinventoryfrom_1"
                                                    name="shipping_inventory"class="form-control select2"
                                                    value="<?php echo e($deliveryDetail->subinventory); ?>" required>
                                                    <?php $__currentLoopData = $Subinventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            value="<?php echo e($row->sub_inventory_name); ?>"<?php echo e($deliveryDetail->subinventory == $row->id ? 'selected' : ''); ?>>
                                                            <?php echo e($row->sub_inventory_name); ?>-<?php echo e($row->description); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-50">
                                    <?php if($DeliveryHeader->lvl == 6): ?>
                                        <button class="btn btn-warning resetbtn" type="button"><i
                                                data-feather='refresh-ccw'></i>
                                            <?php echo e(trans('cruds.Delivery.button.reset')); ?></button>
                                        <button class="btn btn-primary btn-submit" id="add_all" type="submit"><i
                                                data-feather='save'></i> <?php echo e(trans('global.save')); ?></button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        function shipconfirm(id) {
            var check = confirm("Are you sure you want to CONFIRM this SHIPMENT?");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            console.log(check);

            if (check == true) {
                console.log(check);
                $.ajax({
                    url: "<?php echo e(route('admin.deliveries.destroy', $DeliveryHeader->delivery_id)); ?>",
                    type: "GET",
                    data: {
                        id: id,
                    },
                    success: function(result) {
                        location.reload();
                        alert('success');
                    },
                    error: function(result) {
                        alert('error');
                        location.reload();
                    }
                });
            }
        }
        $(document).ready(function() {
            var table = $('#dvedit').DataTable({

            });
            ///////////// RESET BUTTON//////////////
            $(".resetbtn").click(function() {
                $("#formship").trigger("reset");
            });


            $(".getDetail").click(function() {
                var id
                $.ajax({
                    url: '<?php echo e(url('search/rollCounter')); ?>',
                    type: 'GET',
                    data: {
                        id: $(this).attr('data-id'),
                    },
                    success: function(roll) {
                        document.getElementById('RollCounter').value = roll[0]['roll'];
                        document.getElementById('QtyCounter').value = roll[0]['qty'];
                    }

                })

            });
            ///////////// RESET BUTTON//////////////

        });
    </script>
    <script>
        $(document).ready(function() {
            var delivery_name = $("#delivery_name").val();

            var table = $('#table-roll').DataTable({
                "bServerSide":true,
                "bDestroy": true,
                ajax: {
                    url: "/search/roll",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(d) {
                        d.delivery_name = $("#delivery_name").val();
                        console.log(delivery_name);
                        return d
                    }

                },
                responsive: false,
                scroll: true,
                searching: true,
                dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                        <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>',
                displayLength: 10,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
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
                }, , ],
                columnDefs: [{
                        "targets": 0,
                        "render": function(data, type, row, meta) {
                            return row.container_item_id;
                        }
                    },
                    {
                        "targets": 1,
                        width: "0%",
                        "render": function(data, type, row, meta) {
                            return row.attribute1;
                        }
                    },
                    {
                        "targets": 2,
                        width: "0%",
                        "render": function(data, type, row, meta) {
                            return row.attribute3;
                        }
                    },
                    {
                        "targets": 3,
                        className: "text-center",
                        "render": function(data, type, row, meta) {
                            return row.attribute_number1;
                        }
                    },
                    {
                        "targets": 4,
                        "render": function(data, type, row, meta) {
                            return row.created_at;
                        }
                    },
                    {
                        "targets": 5,
                        className: "text-center",
                        "render": function(data, type, row, meta) {
                            // return row.preferred_flag;
                            if(row.preferred_flag==1){
                                return '<a class="badge bg-primary text-white">Confirm</a>';
                            }else{
                                return '<a class="badge bg-danger text-white">Unconfirm</a>';
                            }

                        }
                    },
                   

                ],
                language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                }
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/deliveries/create.blade.php ENDPATH**/ ?>