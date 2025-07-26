
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<nav class="breadcrumbs">
    <a href="" class="breadcrumbs__item">Orders</a>
    <a href="" class="breadcrumbs__item active">Receive</a>
</nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <form action="<?php echo e(route('admin.rcv.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo e(csrf_field()); ?>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-2">Receive</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit"  class="btn btn-sm btn-primary pull-right" onclick="myFunction()"> <i data-feather="corner-down-right" class="font-medium-3"></i> Submit</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label class="col-sm-0  form-label" for="number"><?php echo e(trans('cruds.quotation.fields.number')); ?></label>
                                    <input type="text" class="form-control" readonly name="no_rcv" autocomplete="off" value="<?php echo e($countReset); ?>" required>
                                    <input type="hidden" class="form-control" readonly name="vendor_site_id" value="<?php echo e($order_head->vendor_site_id); ?>">
                                    <input type="hidden" name="type_lookup_code" value="<?php echo e($order_head->type_lookup_code); ?>">
                                    <input type="hidden" name="po_head" value="<?php echo e($order_head->po_head_id); ?>">
                                
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                     <label class="col-sm-0 form-label" for="site">PO Number</label>
                                    <input type="text" class="form-control" value="<?php echo e($order_head->segment1); ?>" name="po_number" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="site"><?php echo e(trans('cruds.quotation.fields.supplier')); ?></label>
                                    <input type="text"value="<?php echo e($order_head->Vendor->vendor_name); ?>" class="form-control search_supplier_name" readonly placeholder="Type here ..." placeholder="" name="supplier_name" autocomplete="off" required>
                                    <span class="help-block search_supplier_name_empty" style="display: none;">No Results Found ...</span>
                                    <input type="hidden" name="vendor_id" value="<?php echo e($order_head->vendor_id); ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                     <label class="col-sm-0 form-label" for="site">Currency</label>
                                    <input type="text" class="form-control" value="<?php echo e($order_head->currency_code); ?>" name="currency_code" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="site">Taxes</label>
                                    <input type="text" class="form-control" value="<?php echo e($order_head->taxes->tax_code); ?>" name="taxes" autocomplete="off" readonly>
                                    <input type="hidden" class="form-control" value="<?php echo e($order_head->taxes->tax_rate); ?>" name="tax_rate" autocomplete="off" readonly>
                                    <input type="hidden" class="form-control" value="<?php echo e($order_head->notes); ?>" name="note" autocomplete="off" readonly>
                                </div>
                            </div>
                           
                            
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="number">Seller</label>
                                    <input type="text" value="<?php echo e($order_head->user->name); ?>" class="form-control" name="buyer" autocomplete="off" readonly>
                                    <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>">
                                    <input type="hidden" id="type_lookup_code" value='1' name="type_lookup_code">
                                    <input type="hidden" id="organization_id" value='222' name="organization_id">
                                    <input type="hidden" id="rate_date" value="<?php echo e(date('d-M-Y H:i:s')); ?>" name="rate_date">
                                </div>
                            </div>
                             <div class="col-md-2">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="">Sub Inventory</label>
                                    <select class="form-control select2" name="warehouse" required>
                                        <option selected disabled value="">select</option>
                                        <?php $__currentLoopData = $subInventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($sub->sub_inventory_name); ?>"><?php echo e($sub->sub_inventory_name); ?> - <?php echo e($sub->description); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="site">Delivery To</label>
                                    <input readonly type="text" class="form-control search_address1 " placeholder="" value="<?php echo e($order_head->Site->address1); ?>" name="address1" autocomplete="off" required>
                                    <span class="help-block search_address1_empty" style="display: none;">No Results Found ...</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Payment Method</label>
                                    <input type="text"readonly class="form-control" value="<?php echo e($order_head->terms->terms_name); ?>" name="payment_method" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="site">Creation Date</label>
                                    <input readonly type="text" id="created_at" name="created_at" class="form-control" value=" <?php echo e($order_head->created_at->format('d-M-Y H:i:s')); ?>" required>
                                </div>
                            </div>
                          
                            
                            <br>
                            <div class="col-md-3">
                                <div class="mb-1">

                                </div>
                            </div>
                        </div>
                        <br>
                       

                        <!-- tab jurnal -->
                        <div class="card-header">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-sales-tab" data-bs-toggle="tab" data-bs-target="#nav-sales" type="button" role="tab" aria-controls="nav-sales" aria-selected="true">
                                        <span class="bs-stepper-box">
                                            <i data-feather="file-text" class="font-medium-3"></i>
                                        </span>
                                        Receive Lines
                                    </button>
                                   
                                   
                                </div>
                            </nav>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-sales" role="tabpanel" aria-labelledby="nav-sales-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                        <table class="table table-fixed  table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Purchase Item</th>
                                                <!-- <th>Category</th> -->
                                                <th>UOM</th>
                                                <th>Quantity</th>
                                                <!-- <th>Price</th> -->
                                                <th>Need By Date</th>
                                                <!-- <th>Total</th> -->
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="purchase_container">
                                            <?php $grand_total=0 ?>
                                            <?php if($orders->isEmpty()): ?>

                                            <?php endif; ?>
                                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <tr class="tr_input">
                                                <td width="30%">
                                                    <input type="text" readonly class="form-control search_purchase_item" placeholder="Type here ..." name="item_code[]" id="searchitem_<?php echo e($key+1); ?>" autocomplete="off" required value="<?php echo e($raw->ItemMaster->item_code ?? ''); ?> - <?php echo e($raw->item_description ?? ''); ?>"><span class="help-block " style="display: none;" id="search_item_code_empty_1" required>No Results Found ...</span>
                                                    <input type="hidden" class="search_inventory_item_id" id="id_<?php echo e($key+1); ?>'" value="<?php echo e($raw->inventory_item_id ?? ''); ?>" name="inventory_item_id[]" autocomplete="off">
                                                    <input type="hidden" class="form-control" value="<?php echo e($raw->item_description ??''); ?>" id="description_<?php echo e($key+1); ?>" name="description_item[]" autocomplete="off">
                                                    <input type="hidden" value="<?php echo e($raw->ItemMaster->category_code ??''); ?>" id="category<?php echo e($key+1); ?>" name="category_code[]" autocomplete="off">
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
                                                        <input type="text" class="form-control purchase_quantity text-end" name="purchase_quantity[]" id="qty_1" min="0" autocomplete="off"   required>
                                                        <input type="hidden" class="form-control purchase_quantity text-end" name="base_qty[]" id="" value="<?php echo e($raw->base_qty); ?>">
                                                        <input type="hidden" class="form-control " name="harga[]" id="" value="<?php echo e($raw->unit_price); ?>">
                                                        <input hidden readonly type="text" class="form-control purchase_cost text-end" value="<?php echo e(number_format(($raw->unit_price ?? $raw->base_model_price ),2,',','.')); ?>" name="purchase_cost[]" id="price_<?php echo e($key+1); ?>" onblur="cal()" autocomplete="off">
                                                </td>
                                                <!-- <td width="10%">
                                                </td> -->
                                                <td width="10%">
                                                    <input readonly type="date" name="need_by_date[]" value="<?php echo e($raw->need_by_date); ?>" class="form-control datepicker " id="need_1" autocomplete="off">
                                                </td>
                                                <!-- <td width="15%">
                                                    <input type="text" class="form-control stock_total text-end" name="sub_total[]" value="<?php echo e(number_format(($raw->po_quantity * $raw->unit_price), 2, ',', '.')); ?>" id="total_1"="" readonly="">
                                                </td> -->
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
                                        
                                    </table>
                                    </div>
                                </div>
                                <br>
                               
                               
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-2 mt-2">
                            <div></div>
                            <!-- <button type="submit"  class="btn btn-sm btn-primary pull-right" onclick="myFunction()"> <i data-feather="corner-down-right" class="font-medium-3"></i> Submit</button> -->
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro\resources\views/admin/rcv/create.blade.php ENDPATH**/ ?>