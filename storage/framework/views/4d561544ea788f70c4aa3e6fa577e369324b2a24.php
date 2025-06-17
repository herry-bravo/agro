
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header  mt-1 mb-70">
                    <h6 class="card-title">
                        <a href="<?php echo e(route("admin.orders.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.po')); ?> </a>
                        <a href="<?php echo e(route("admin.orders.index")); ?>" class="breadcrumbs__item">Purchase Order List </a>
                        <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.purchaseOrder.fields.edit')); ?> </a>
                    </h6>
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="<?php echo e(route('admin.orders.update', [$purchaseorder->id])); ?>">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                        stroke-linejoin="round" class="feather feather-check-circle me-50 font-small-4">
                                        <path d="M22 12A10 10 0 1 1 12 2a10 10 0 0 1 10 10z"></path>
                                        <polyline points="9 12 12 15 16 10"></polyline>
                                    </svg>
                                </span>

                                Confirm
                            </a>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <form action="<?php echo e(route("admin.orders.update",[$purchaseorder->id])); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.quotation.fields.number')); ?></label>
                                    <input type="text" class="form-control" value="<?php echo e($purchaseorder->segment1); ?>" id="order_number" readonly name="segment1" autocomplete="off" maxlength="10" required>
                                    <input type="hidden" id="id" name="id" value="<?php echo e($purchaseorder->id); ?>">
                                    <input type="hidden" name="header_id" value="<?php echo e($purchaseorder->po_head_id); ?>" id="header_id">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site"><?php echo e(trans('cruds.quotation.fields.supplier')); ?></label>
                                    <input type="text" readonly class="form-control search_supplier_name" value="<?php echo e($purchaseorder->Vendor->vendor_name); ?>" placeholder="Type here ..." name="supplier_name" autocomplete="off" required>
                                    <span class="help-block search_supplier_name_empty" style="display: none;">No Results Found ...</span>
                                    <input type="hidden" class="search_vendor_id" name="vendor_id" value='<?php echo e($purchaseorder->Vendor->vendor_id); ?>'>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Currency</label>
                                    <input type="text"readonly class="form-control search_currency" value="<?php echo e($purchaseorder->currency_code); ?>" name="currency_code" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Taxes</label>
                                    <input type="text"readonly class="form-control" value="<?php echo e($purchaseorder->taxes->tax_code); ?>" name="taxes" autocomplete="off" readonly>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <input type="hidden" id="created_by" name="created_by" value="<?php echo e($purchaseorder->created_by); ?>">
                            <input type="hidden" id="type_lookup_code" value='1' name="type_lookup_code">
                            <input type="hidden" id="organization_id" value='<?php echo e($purchaseorder->organization_id); ?>' name="organization_id">
                            <input type="hidden" id="bill_to_location" name="bill_to_location" value="BL-982221229">
                            <input type="hidden" id="rate_date" value="<?php echo e(date('d-M-Y H:i:s')); ?>" name="rate_date">
                            <div class="col-md-4 col-12">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="number"> Supplier Site</label>
                                    
                                    <input type="text" readonly class="form-control supplier_site_id" value="<?php echo e($purchaseorder->supplierSite->address1??''); ?>" placeholder="Type here ..." name="site_name" autocomplete="off" required>
                                    <span class="help-block supplier_site_id_empty" style="display: none;">No Results Found ...</span>
                                    <input type="hidden" class="search_vendor_site_id" name="vendor_site_id" value='<?php echo e($purchaseorder->supplierSite->site_code ??''); ?>'>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Delivery To</label>
                                    <input type="text" readonly class="form-control search_address1 " value="<?php echo e($purchaseorder->Site->address1); ?>" placeholder="Type here ..." name="address1" autocomplete="off" required>
                                    <span class="help-block search_address1_empty" style="display: none;">No Results Found ...</span>
                                    <input type="hidden" class="search_ship_to_location" name="ship_to_location" value="<?php echo e($purchaseorder->Site->site_code); ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Payment Method</label>
                                    <input type="text"readonly class="form-control" value="<?php echo e($purchaseorder->terms->terms_name); ?>" name="payment_method" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Creation Date</label>
                                    <input readonly type="text" id="datepicker-1_" name="created_at" class="form-control form-control flatpickr-basic flatpickr-input" value=" <?php echo e($purchaseorder->created_at->format('d-M-Y H:i:s')); ?>" required>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                
                            </div>
                            <!-- <div class="col-md-1">
                                <div class="mb-25">
                                    <a href="#" class="nav-link ">
                                        <img src="<?php echo e(asset('app-assets/fonts/feather/edit.svg')); ?>" width="25" height="25" />
                                        <p>
                                            <span>Bill</span>
                                        </p>
                                    </a>
                                </div>
                            </div> -->
                            <div class="col-md-1">
                                <div class="mb-">
                                    <a href="<?php echo e(route('admin.rcv.create', ['header_id' => $purchaseorder->po_head_id])); ?>" class="nav-link ">
                                    <!-- <a href="" class="nav-link " id="IDrcvDet" data-bs-toggle="modal" data-bs-target="#rcv_modal"> -->
                                        <img src="<?php echo e(asset('app-assets/fonts/feather/truck.svg')); ?>" width="25" height="25" />
                                        <p>
                                            <span>Receipt</span>
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                                        
                        <div class="row">
                            <div class="box box-default">
                                <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                    <table class="table table-fixed  table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Purchase Item</th>
                                                <!-- <th>Category</th> -->
                                                <th>UOM</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Need By Date</th>
                                                <th>Total</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="purchase_container">
                                            <?php $grand_total=0 ?>
                                            <?php if($purchaseOrderDet->isEmpty()): ?>

                                            <?php endif; ?>
                                            <?php $__currentLoopData = $purchaseOrderDet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <tr class="tr_input">
                                                <td width="30%">
                                                    <input type="text" class="form-control search_purchase_item" placeholder="Type here ..." name="item_code[]" id="searchitem_<?php echo e($key+1); ?>" autocomplete="off" required value="<?php echo e($raw->ItemMaster->item_code ?? ''); ?> - <?php echo e($raw->item_description ?? ''); ?>"><span class="help-block " style="display: none;" id="search_item_code_empty_1" required>No Results Found ...</span>
                                                    <input type="hidden" class="search_inventory_item_id" id="id_<?php echo e($key+1); ?>'" value="<?php echo e($raw->inventory_item_id ?? ''); ?>" name="inventory_item_id[]" autocomplete="off">
                                                    <input type="hidden" class="form-control" value="<?php echo e($raw->item_description ??''); ?>" id="description_<?php echo e($key+1); ?>" name="description_item[]" autocomplete="off">
                                                    <input type="hidden" class="form-control" value="<?php echo e($raw->line_id ?? ''); ?>" id="line_id_<?php echo e($key+1); ?>" name="line_id[]" autocomplete="off">
                                                    <input type="hidden" class="form-control" value="<?php echo e($raw->id); ?>" id="po_line_id_<?php echo e($key+1); ?>" name="po_line_id[]" autocomplete="off">
                                                    <input type="hidden" id="updated_by" name="updated_by" value="<?php echo e(auth()->user()->id); ?>">
                                                </td>
                                                <!-- <td width="15%">
                                                    <input type="text" class="form-control search_subcategory_code" placeholder="Type here ..." value="<?php echo e($raw->attribute2); ?>" name="category[]" id="category_1" autocomplete="off" required>
                                                    <input type="hidden" class="form-control  id_cc" placeholder="Type here ..." name="id_cc" autocomplete="off" required>
                                                </td> -->
                                                <td width="10%">
                                                    <input type="text" class="form-control" name="po_uom_code[]" id="uom_<?php echo e($key+1); ?>" value="<?php echo e($raw->po_uom_code); ?>" autocomplete="off" readonly>
                                                </td>
                                                <td width="10%">
                                                    <?php if($raw->po_quantity<=$raw->quantity_receive): ?>
                                                        <input type="text" class="form-control purchase_quantity text-end" value="<?php echo e($raw->po_quantity); ?>" name="purchase_quantity[]" id="qty_1" min="0" autocomplete="off" readonly required>
                                                        <?php else: ?>
                                                        <input type="text" class="form-control purchase_quantity text-end" value="<?php echo e($raw->po_quantity); ?>" name="purchase_quantity[]" id="qty_1" min="0" autocomplete="off"readonly required>
                                                        <?php endif; ?>
                                                </td>
                                                <td width="10%">
                                                    <input readonly type="text" class="form-control purchase_cost text-end" value="<?php echo e(number_format(($raw->unit_price ?? $raw->base_model_price ),2,',','.')); ?>" name="purchase_cost[]" id="price_<?php echo e($key+1); ?>" onblur="cal()" autocomplete="off">
                                                </td>
                                                <td width="10%">
                                                    <input readonly type="date" name="need_by_date[]" value="<?php echo e($raw->need_by_date); ?>" class="form-control">
                                                </td>
                                                <td width="15%">
                                                    <input type="text" class="form-control stock_total text-end" name="sub_total[]" value="<?php echo e(number_format(($raw->attribute2), 2, ',', '.')); ?>" id="total_1"="" readonly="">
                                                </td>
                                                <!-- <td>
                                                    <?php if($raw->line_status !=1 && $raw->quantity_receive !=0 ): ?>
                                                    <button type="button" class="btn btn-ligth btn-sm" style="position: inherit;">X</button>
                                                    <?php else: ?>
                                                    <?php if($loop): ?> <form></form> <?php endif; ?>
                                                    <form type="hidden" action="<?php echo e(route('admin.orderDet.destroy',$raw->id)); ?>" enctype="multipart/form-data" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                        <button type="submit" class="btn btn-ligth btn-sm" --disabled- style="position: inherit;">X</button>
                                                    </form>
                                                    <?php endif; ?>
                                                </td> -->
                                            </tr>
                                            <?php $grand_total += $raw->po_quantity * $raw->unit_price ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>
                                        <tfoot>
                                            <!-- <tr>
                                                <td colspan="3">
                                                    <button type="button" class="btn btn-light btn-sm add_purchase_product"><i data-feather='plus'></i> Add More</button>
                                                </td>
                                                <td></td>
                                            </tr> -->
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Miscellaneous expense</label><br>
                                    <input type="text" class="form-control " name="attribute2" value="<?php echo e($purchaseorder->attribute2); ?>" min="0">
                                </div>
                            </div> -->
                            <!-- <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Tax ( % )</label><br>
                                    <?php
                                    $rate=0;
                                    ?>
                                    <?php
                                    if (isset($raw->tax->tax_rate)){
                                    $rate=$raw->tax->tax_rate;
                                    }
                                    ?>
                                    <select name="tax_id" id="tax_id" class="form-control" required>
                                        <option value="<?php echo e($raw->tax_name?? ''); ?>"><?php echo e($raw->tax_name?? ''); ?></option>
                                        <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($raw->tax_name)): ?>
                                        <?php if($raw->tax_name!=$rw->tax_code): ?>
                                        <option value="<?php echo e($rw->tax_code); ?>"><?php echo e($rw->tax_name); ?></option>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(empty($raw->tax_name)): ?>
                                        <option value="<?php echo e($rw->tax_code); ?>"><?php echo e($rw->tax_name); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>
                            </div> -->
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tax ( Amount )</label><br>
                                    <input type="text" class="form-control purchase_tax_amount" name="tax_amount" readonly value="<?php echo e(number_format($tax=$grand_total*$rate,2,',','.')); ?>">
                                </div>
                            </div> -->
                            <div class=" col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Purchase Total</label>
                                    <input type="text" class="form-control purchase_total" value="<?php echo e(number_format($purchaseorder->attribute1, 2, ',', '.')); ?> " readonly="" name="purchase_total">
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="box box-default">
                                <div class="box-body">
                                    <div class="row mt-1 mb-2">
                                        <!-- <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="form-label">Notes</label>

                                                <input type="text" class="form-control" value="<?php echo e($purchaseorder->notes ??''); ?>" name="notes" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="form-label">ATP Reply</label>
                                                <input type="button" class="form-control grand_total btn  btn-secondary" data-bs-toggle="modal" data-bs-target="#atpModal" name="atpId" id="atpId " value="Set ATP" readonly="">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="form-label">Terms</label>
                                                <input type="button" class="form-control purchase_payment btn btn-info" data-bs-toggle="modal" data-bs-target="#demoModal" value="Set Terms" name="payment" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="form-label">Shipment By</label>
                                                <select name="ship_via_code" id="status" class="form-control">
                                                    <option value='Land'>Land</option>
                                                    <option value='Air'>Air</option>
                                                    <option value='Sea'>Sea</option>
                                                </select>
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="form-label">Approval Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value='<?php echo e($purchaseorder->status??''); ?>'><?php echo e($purchaseorder->TrxStatuses->trx_name ??''); ?></option>
                                                    <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if( $purchaseorder->status != $status->trx_code) { ?>
                                                    <option value="<?php echo e($status->trx_code); ?>"><?php echo e($status->trx_name); ?></option>
                                                    <?php } ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-sm-1">
                                            <div class="form-group">

                                                <label class="form-label">Action</label>
                                                <input type="submit" class="form-control purchase_payment btn btn-primary" value="<?php echo e(trans('global.save')); ?>" name="payment" autocomplete="off">
                                            </div>
                                        </div> -->
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="modal fade" id="demoModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header  bg-primary">
                                        <h4 class="modal-title text-white " id="exampleModalLongTitle">Terms</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="row mt-25">
                                                <div class="col-md-4 col-12">
                                                    <div class="mb-25">
                                                        <label class="col-sm-0 form-label" for="number">Payment</label>
                                                        <select name="term_id" id="term_id" class="form-control select2" required>
                                                            <option value="<?php echo e($purchaseorder->term_id); ?>"><?php echo e($purchaseorder->terms->terms_name??''); ?></option>
                                                            <?php $__currentLoopData = $term; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if( $row->term_category =="PAYMENT" && $purchaseorder->term_id!=$row->term_code) { ?>
                                                            <option value="<?php echo e($row->term_code); ?>"><?php echo e($row->terms_name); ?></option>
                                                            <?php }?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-25">
                                                        <label class="col-sm-0 form-label" for="site">Freight</label>
                                                        <select name="freight" id="freight" class="form-control select2" required>
                                                            <option value="<?php echo e($purchaseorder->freight); ?>"><?php echo e($purchaseorder->freight); ?></option>
                                                            <?php $__currentLoopData = $term; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if( $row->term_category =="FREIGHT" && $purchaseorder->freight!=$row->term_code) { ?>
                                                            <option value="<?php echo e($row->term_code); ?>"><?php echo e($row->terms_name); ?></option>
                                                            <?php }?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select></br>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <div class="mb-25">
                                                        <label class="col-sm-0 form-label" for="number">Origin</label>
                                                        <select name="attribute3" id="attribute3" class="form-control select2">
                                                            <option value="<?php echo e($purchaseorder->attribute3); ?>"><?php echo e($purchaseorder->attribute3); ?></option>
                                                            <?php $__currentLoopData = $term; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if( $row->term_category =="ORIGIN" && $purchaseorder->attribute3!=$row->term_code ) { ?>
                                                            <option value="<?php echo e($row->term_code); ?>"><?php echo e($row->terms_name); ?></option>
                                                            <?php }?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mt-1 col-12">
                                                    <div class="form-floating mb-0">
                                                        <textarea class="form-control mb-1" rows="3" id="textarea-counter" name="description"><?php echo e($purchaseorder->description ??''); ?></textarea>
                                                        <label class="col-sm-0 form-label">Remarks</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mt-0 col-12">
                                                    <div class="mb-25">
                                                        <label class="col-sm-0 form-label" for="number">Instructions</label>
                                                        <select name="istructions" class="form-control select2">
                                                            <?php if(isset($purchaseorder->attribute_number1)): ?>
                                                            <option value="<?php echo e($purchaseorder->attribute_number1 ?? 0); ?>">Bank Number & Invoice </option>
                                                            <option value="0">Blank</option>
                                                            <?php else: ?>
                                                            <option value=""></option>
                                                            <option value="1111">Bank Number & Invoice
                                                                <?php endif; ?>
                                                            </option>


                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Modal Example Start-->
                        <!-- /.box-body -->
                        
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <?php echo $__env->make('admin.purchase.rcv-src', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
        <?php echo $__env->make('admin.purchase.atp-reply', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/purchase/edit.blade.php ENDPATH**/ ?>