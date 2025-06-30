
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-validation.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-wizard.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" integrity="sha512-2eMmukTZtvwlfQoG8ztapwAH5fXaQBzaMqdljLopRSA0i6YKM8kBAOrSSykxu9NN9HrtD45lIqfONLII2AFL/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    #my-image,
    #use {
        display: none;
    }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/vendors/js/forms/wizard/bs-stepper.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/forms/form-wizard.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<a href="#" class="breadcrumbs__item"> <?php echo e(trans('cruds.itemMaster.inv')); ?></a>
<a href="<?php echo e(route("admin.item-master.index")); ?>" class="breadcrumbs__item"> <?php echo e(trans('cruds.itemMaster.item_master')); ?></a>
<a href="#" class="breadcrumbs__item"><?php echo e(trans('cruds.itemMaster.fields.edit')); ?></a>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Modern Horizontal Wizard -->
<section class="modern-horizontal-wizard">
    <form id="itemMasterForm" action="<?php echo e(route("admin.item-master.update", [$itemMaster->inventory_item_id])); ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="bs-stepper wizard-modern modern-wizard-example">
            <div class="bs-stepper-header">
                <div class="step" data-target="#step1" role="tab" id="step1-trigger">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Items Master Details</span>
                            <span class="bs-stepper-subtitle">Setup Items Details</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="step" data-target="#step2" role="tab" id="step2-trigger">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="info" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Details Info</span>
                            <span class="bs-stepper-subtitle">Add Details Info</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="step" data-target="#step3" role="tab" id="step3-trigger">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="link" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">COA</span>
                            <span class="bs-stepper-subtitle">Add COA Account</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <div id="step1" class="content" role="tabpanel" aria-labelledby="step1-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Item Master Details</h5>
                        <small class="text-muted">Enter Your Item Master Details.</small>
                    </div>
                    <div class="row">
                        <div class="mb-25 col-md-5">
                            <label class="form-label" for="item_code"><?php echo e(trans('cruds.itemMaster.fields.item_code')); ?></label>
                            <input type="text" name="item_code" id="item_code" class="form-control" value="<?php echo e(isset($itemMaster->item_code)?$itemMaster->item_code :''); ?>" autocomplete="off" readonly required />
                            <input type="hidden" name="id" id="id" class="form-control" value="<?php echo e(isset($itemMaster->inventory_item_id)); ?>" autocomplete="off" readonly required />
                        </div>
                        <div class="mb-25 col-md-5">
                            <label class="form-label" for="description"><?php echo e(trans('cruds.itemMaster.fields.description')); ?></label>
                            <input type="text" name="description" id="description" class="form-control" value="<?php echo e(isset($itemMaster->description)?$itemMaster->description :''); ?>" autocomplete="off" required aria-required="true" />
                        </div>
                        <div class="d-flex flex-column mb-25 col-md-2">
                            <label class="form-check-label mb-50" for="customSwitch10">Master</label>
                            <div class="form-check form-switch form-check-primary">
                                <input type="checkbox" class="form-check-input" id="customSwitch10" checked="">
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


                    <div class="row">
                        <div class="mb-25 col-md-4">
                            <label class="form-label" for="primary_uom_code"><?php echo e(trans('cruds.itemMaster.fields.uom')); ?></label>
                            <select name="primary_uom_code" id="primary_uom_code" class="form-control select2" required>
                                <option value="<?php echo e($itemMaster->primary_uom_code); ?>"><?php echo e($itemMaster->primary_uom_code); ?></option>
                            </select>
                        </div>
                        <div class="mb-25 col-md-4">
                            <label class="form-label" for="type_code"><?php echo e(trans('cruds.itemMaster.fields.type')); ?></label>
                            <select name="type_code" id="type_code" class="form-control " required>
                                <option value="<?php echo e($itemMaster->type_code); ?>"><?php echo e($itemMaster->type_code); ?></option>
                            </select>
                        </div>
                        <div class="mb-25 col-md-4">
                            <label class="form-label" for="status_id"><?php echo e(trans('cruds.itemMaster.fields.status')); ?></label>
                            <select name="status_id" id="status_id" class="form-control" required>
                                <option value="<?php echo e($itemMaster->status_id); ?>"><?php echo e($itemMaster->itemstatuses->stts_name); ?></option>
                                <?php $__currentLoopData = $itemstatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($itemMaster->status_id!=$status->stts_code): ?>
                                <option value="<?php echo e($status->stts_code); ?>"><?php echo e($status->stts_name); ?></option>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    

            <div class="row">
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="buyer_id"><?php echo e(trans('cruds.itemMaster.fields.buyer')); ?></label>
                    <select name="buyer_id" id="buyer_id" class="form-control select2" autocomplete="off">
                        <option value="<?php echo e($itemMaster->buyer_id ?? ''); ?>"><?php echo e($itemMaster->buyer->name ?? ''); ?></option>

                        <?php $__currentLoopData = $agent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poAgent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($itemMaster->buyer_id!=$poAgent->agent_id): ?>
                        <option value="<?php echo e($poAgent->agent_id); ?>"><?php echo e($poAgent->user->name); ?></option>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="make_buy_code"><?php echo e(trans('cruds.itemMaster.fields.makeOrbuy')); ?></label>
                    <select name="make_buy_code" id="type_code" class="form-control " required>
                        <option value="<?php echo e($itemMaster->make_buy_code); ?>"><?php echo e($itemMaster->makeorbuy->make_or_buy); ?></option>
                        <?php $__currentLoopData = $makeorbuy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($itemMaster->make_buy_code!=$row->make_or_buy_code): ?>
                        <option value="<?php echo e($row->make_or_buy_code); ?>"><?php echo e($row->make_or_buy); ?></option>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-25 col-md-2">
                    <label class="form-label" for="mapping_item"><?php echo e(trans('cruds.itemMaster.fields.purchaseItem')); ?></label>
                    <div class="form-check">
                        <input class="form-check-input" name="purchasing_item_flag" type="checkbox" value="1" id="inlineCheckbox1" checked="">
                        <label class="form-check-label" for="inlineCheckbox1">Purchased Item</label>
                    </div>
                </div>

                <div class="mb-25 col-md-2">
                    <label class="form-label" for="mapping_item"><?php echo e(trans('cruds.itemMaster.fields.inventory')); ?></label>
                    <div class="form-check">
                        <input class="form-check-input" name="inventory_item_flag" type="checkbox" value="1" id="inlineCheckbox1" checked="">
                        <label class="form-check-label" for="inlineCheckbox1"><?php echo e(trans('cruds.itemMaster.fields.inventory')); ?> Item</label>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="mt-2 col-12">
                    <div class="form-floating mb-0">
                        <textarea data-length="100" class="form-control char-textarea" id="textarea-counter" name="item_note" rows="1" placeholder="Counter"><?php echo e($itemMaster->item_note); ?></textarea>
                        <label for="form-label textarea-counter">Notes</label>
                    </div>
                    <small class="textarea-counter-value float-end">This Note Only For Internal Purposes, <b>Char Left : <span class="char-count">0</span> / 100 </b></small> </br>
                </div>

            </div>

            <div class="d-flex justify-content-between">
                <button class="btn btn-outline-secondary btn-prev" disabled>
                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button type="button" class="btn btn-primary btn-next">
                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                </button>
            </div>

        </div>
        <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
            <div class="content-header">
                <h5 class="mb-0">Detail Info</h5>
                <small>Enter Your Detail Info.</small>
            </div>

            <div class="row">
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="modern-first-name"><?php echo e(trans('cruds.itemMaster.fields.category')); ?></label>
                    <select name="category_code" id="category_code" class="form-control select2" required>
                        <option value="<?php echo e($itemMaster->category_code); ?>"><?php echo e($itemMaster->Category->category_name); ?> <?php echo e($itemMaster->Category->description); ?></option>
                        <?php $__currentLoopData = $Category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if( $row->category_code != $itemMaster->category_code) { ?>
                        <option value="<?php echo e($row->category_code); ?>"><?php echo e($row->category_name); ?> <?php echo e($row->description); ?></option>
                        <?php }?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-25 col-md-2">
                    <label class="form-label" for="modern-last-name"><?php echo e(trans('cruds.itemMaster.fields.subcat')); ?></label>
                    <input type="text" id="sub_category_code" name="attribute2" class="form-control sub_category_code" value="<?php echo e($itemMaster->attribute2??''); ?>" />
                </div>
                <div class="mb-25 col-md-2 form-check-primary">
                    <label class="form-check-label mb-50" for="modern-last-name"><?php echo e(trans('cruds.itemMaster.fields.asset')); ?></label>
                    <div class="form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="asset" id="inlineRadio1" value="1" checked="">
                            <label class="form-check-label" for="inlineRadio1">Asset</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="asset" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">Non Asset</label>
                        </div>
                    </div>
                </div>
                <div class="mb-25 col-md-3">
                    <a href="#imgModal" data-bs-toggle="modal" class="link-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                            <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                        </svg>
                        <?php echo e(trans('cruds.itemMaster.fields.img')); ?>

                    </a>
                </div>
            </div>


            <div class="row">
                <!-- <div class="mb-25 col-md-4">
                    <label class="form-label" for="item_weight"><?php echo e(trans('cruds.itemMaster.fields.weight')); ?></label>
                    <input type="text" name="weight" id="item_weight" class="form-control" value="<?php echo e($itemMaster->weight); ?>" />
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="item_volume"><?php echo e(trans('cruds.itemMaster.fields.height')); ?></label>
                    <input type="text" name="height" id="height" class="form-control" value="<?php echo e($itemMaster->height); ?>" />
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="item_volume"><?php echo e(trans('cruds.itemMaster.fields.volume')); ?></label>
                    <input type="text" name="volume" id="item_volume" class="form-control" value="<?php echo e($itemMaster->volume); ?>" />
                </div> -->
                <!-- <div class="mb-25 col-md-4">
                            <label class="form-label" for="lta"><?php echo e(trans('cruds.itemMaster.fields.lta')); ?></label>
                            <input type="text" name="lta" id="lta" class="form-control" required/>
                        </div> -->
            </div>

            


        <div class="row">
            <div class="mb-25 col-md-4">
                <label class="form-label" for="item_cost"><?php echo e(trans('cruds.itemMaster.fields.itemcost')); ?></label>
                <input type="text" name="item_cost" id="item_cost" value="<?php echo e($itemMaster->item_cost); ?>" class="form-control" />
            </div>
            <div class="mb-25 col-md-4">
                <label class="form-label" for="bomflag"><?php echo e(trans('cruds.itemMaster.fields.sp')); ?></label>
                <input type="text" name="min_o_qty" id="min_o_qty" class="form-control" value="<?php echo e($itemMaster->min_o_qty); ?>" autocomplete="off" />
            </div>
            <div class="mb-25 col-md-4">
                <label class="form-label" for="receiving_inventory"><?php echo e(trans('cruds.itemMaster.fields.subre')); ?></label>
                <input type="text" name="receiving" value="<?php echo e($itemMaster->receiving_inventory); ?>" id="subinventoryfrom_1" class="form-control search_subinventory " />
                <input type="hidden" class="form-control subinvfrom_1" value="<?php echo e($itemMaster->receiving_inventory); ?>" name="receiving_inventory" id="subinvfrom_1" autocomplete="off">
            </div>
        </div>

        <div class="row mb-4">
            <div class="mb-25 col-md-4">
                <label class="form-label" for="shipping_inventory"><?php echo e(trans('cruds.itemMaster.fields.subshi')); ?></label>
                <input type="text" name="shipping" id="subinventoryto_1" value="<?php echo e($itemMaster->shipping_inventory); ?>" class="form-control search_subinventoryto" />
                <input type="hidden" class="form-control subinvto_1" value="<?php echo e($itemMaster->shipping_inventory); ?>" name="shipping_inventory" id="subinvto_1" autocomplete="off">
            </div>
            <div class="mb-25 col-md-4">
                <label class="form-label" for="location"><?php echo e(trans('cruds.itemMaster.fields.location')); ?></label>
                <input type="text" name="attribute1" id="location" value="<?php echo e($itemMaster->attribute1?? ''); ?>" class="form-control" />
            </div>
            <div class="mb-25 col-md-4">
                <label class="form-label" for="item_pack_qty"><?php echo e(trans('cruds.itemMaster.fields.packingqty')); ?></label>
                <input type="text" name="packing_quantity" value="<?php echo e($itemMaster->packing_quantity); ?>" id="item_pack_qty" class="form-control" />
                
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-primary btn-prev">
                <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button type="button" class="btn btn-primary btn-next">
                <span class="align-middle d-sm-inline-block d-none">Next</span>
                <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
            </button>
        </div>
        </div>

        <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
            <div class="content-header">
                <h5 class="mb-0">Edit Links</h5>
                <small>Enter Your Social Links.</small>
            </div>
            <div class="row">
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="account_payable"><?php echo e(trans('cruds.itemMaster.fields.payable')); ?></label>
                    <input readonly type="text" id="account_payable" name="account_payable" class="form-control" value="<?php echo e($itemMaster->Category->payable_account_code); ?>">
                    
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="account_receivable"><?php echo e(trans('cruds.itemMaster.fields.receivable')); ?></label>
                    <input readonly type="text" id="account_receivable" name="account_receivable" class="form-control" value="<?php echo e($itemMaster->Category->receivable_account_code); ?>">
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="account_inventory"><?php echo e(trans('cruds.itemMaster.fields.inventory')); ?></label>
                    <input readonly type="text" id="account_inventory" name="account_inventory" class="form-control" value="<?php echo e($itemMaster->Category->inventory_account_code); ?>">
                </div>
            </div>
            <div class="row mb-4">
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="account_consumption"><?php echo e(trans('cruds.itemMaster.fields.usage')); ?></label>
                    <input readonly type="text" id="account_consumption" name="account_consumption" class="form-control" value="<?php echo e($itemMaster->Category->consumption_account_code); ?>">
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="attribute1"><?php echo e(trans('cruds.itemMaster.fields.salescc')); ?></label>
                    <input readonly type="text" id="attribute1" name="salescc" class="form-control" value="<?php echo e($itemMaster->Category->attribute1); ?>">
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="attribute2"><?php echo e(trans('cruds.itemMaster.fields.other')); ?></label>
                    <input readonly type="text" name="attribute2" id="other" class="form-control"  value="<?php echo e($itemMaster->Category->attribute2); ?>" disabled />
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary btn-prev">
                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button type="button" onclick="document.getElementById('itemMasterForm').submit()" class="btn btn-info">
                    <i data-feather='save'></i> <?php echo e(trans('global.save')); ?>

                </button>

                <!-- <button type="submit" class="btn btn-info"><i data-feather='save'></i> <?php echo e(trans('global.save')); ?></button> -->
            </div>
        </div>
        </div>
        </div>
    </form>
</section>
<?php echo $__env->make('admin.itemMaster.img', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- /Horizontal Wizard -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/itemMaster/edit.blade.php ENDPATH**/ ?>