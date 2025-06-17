<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
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
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="<?php echo e(route("admin.pricelist.index")); ?>" class="breadcrumbs__item">Order Management </a>
                        <a href="<?php echo e(route("admin.pricelist.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.pricelist.title')); ?> </a>
                        <a href="#" class="breadcrumbs__item ">Edit</a></h6>
                </div>
                <hr>
                <br>
                <div class="card-body">
                    <form action="<?php echo e(route("admin.pricelist.update", [$pricelist->id])); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="mb-1">
                                            <label class="form-label" for="effective_date"><?php echo e(trans('cruds.pricelist.fields.effective_date')); ?></label>
                                            <input type="text" id="effective_date" name="effective_date" class="form-control flatpickr-basic-custom flatpickr-input active" value="<?php echo e(old('effective_date', isset($pricelist) ? $pricelist->effective_date : '')); ?>" required>
                                            
                                            <input type="hidden" id="id" name="id" value="<?php echo e($pricelist->id); ?>">
                                            <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>">
                                            <input type="hidden" id="updated_by" name="updated_by" value="<?php echo e(auth()->user()->id); ?>">

                                            <?php if($errors->has('effective_date')): ?>
                                            <em class="invalid-feedback">
                                                <?php echo e($errors->first('effective_date')); ?>

                                            </em>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-1">
                                            <label class="form-label" for="price_list_name"><?php echo e(trans('cruds.pricelist.fields.price_list_name')); ?></label>
                                            <input type="text" id="purpose_date" name="purpose_date" class="form-control" hidden value="<?php echo e(now()->format ('Y-m-d')); ?>" required>
                                            <select name="price_list_name" id="price_list_name" class="form-control select2" required>
                                                <option value="<?php echo e($pricelist->price_list_name); ?>"> <?php echo e($pricelist->customer->party_name); ?></option>
                                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($pricelist->price_list_name !=$row->id): ?>
                                                <option value="<?php echo e($row->customer_party_code); ?>"> <?php echo e($row->party_name); ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <div class="invalid-feedback"><?php echo e(trans('cruds.pricelist.fields.price_list_name')); ?> <?php echo e(trans('global.required')); ?></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-1">
                                            <label class="form-label" for="description"><?php echo e(trans('cruds.pricelist.fields.description')); ?></label>
                                            <input type="text" id="description" name="description_header" class="form-control" value="<?php echo e(old('description', isset($pricelist) ? $pricelist->description : '')); ?>" required>
                                            <?php if($errors->has('description')): ?>
                                            <em class="invalid-feedback">
                                                <?php echo e($errors->first('description')); ?>

                                            </em>
                                            <?php endif; ?>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-3">

                                        <label class="form-label" for="currency"><?php echo e(trans('cruds.pricelist.fields.currency')); ?></label>
                                        <select name="currency" id="currency" class="form-control select2" required>
                                            <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->id); ?>" <?php echo e($pricelist->currency == $row->id ? 'selected' : ''); ?>> <?php echo e($row->currency_code); ?> - <?php echo e($row->currency_name); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                    </div>
                                    <div class="col-md-6">

                                        <label class="form-label" for="location_id"><?php echo e(trans('cruds.pricelist.fields.location_id')); ?></label>
                                        <input type="number" hidden id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                                        <input type="number" id="location_id" name="location_id" class="form-control" value="<?php echo e(old('location_id', isset($pricelist) ? $pricelist->location_id : '')); ?>" required>
                                        <?php if($errors->has('location_id')): ?>
                                        <em class="invalid-feedback">
                                            <?php echo e($errors->first('location_id')); ?>

                                        </em>
                                        <?php endif; ?>

                                    </div>

                                </div>
                            </div>
                        </div>

                        </br>
                        <div class="row mb-4">
                            <div class="box box-default overflow-auto">
                                <div class="box-body" style="height: 350px;">
                                    <table class="table table-responsive" id="tab_logic">
                                        <thead>
                                            <th scope="col">Line ID</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Item Description</th>
                                            <th class="text-end" scope="col">Price</th>
                                            <th class="text-center" scope="col">Dis(%)</th>
                                            <th scope="col">Packing Type</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="pricelist_container">
                                            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="tr_input" data-entry-id="<?php echo e($list_detail->id); ?>">
                                                <td class="rownumber" width="5%">
                                                    <?php echo e($key+1); ?>

                                                </td>
                                                <td width="30%">
                                                    <input type="text" readonly class="form-control search_list" placeholder="Type here ..." id="search_item_code_<?php echo e($key+1); ?>" value="<?php echo e($list_detail->item_list->item_code); ?>" name="item_code[]" autocomplete="off" required>
                                                    <span class="help-block search_item_code_empty_1 glyphicon" style="display: none;"> No Results Found </span>
                                                    <input type="hidden" class="search_item_code_id" id="search_item_code_id_<?php echo e($key+1); ?>" value="<?php echo e($list_detail->inventory_item_id); ?>" name="inventory_item_id[]" autocomplete="off">
                                                    <input type="hidden" id="id" value='<?php echo e($list_detail->id); ?>' name="lineId[]" autocomplete="off"></td>
                                                </td>
                                                <td width="15%">
                                                    <input type="text" readonly class="form-control user_item_description" value="<?php echo e($list_detail->item_list->description); ?>" id="user_item_description_<?php echo e($key+1); ?>" name="user_item_description[]" readonly>
                                                    <span id="user_item_description_empty1"></span>
                                                </td>
                                                <td width="15%">
                                                    <input type="number" class="form-control unit_prices_list text-end" min=1  oninput="validity.valid||(value='');" id="unit_prices_list_<?php echo e($key+1); ?>" name="unit_prices[]" autocomplete="off" value="<?php echo e($list_detail->unit_price); ?>">
                                                    <input type="hidden" id="prices_list_<?php echo e($key+1); ?>" name="prices_list[]">
                                                </td>
                                                <td width="5%">
                                                    <input type="number" class="form-control discount" id="discount_<?php echo e($key+1); ?>" name="discount[]" min=0  oninput="validity.valid||(value='');" value="<?php echo e($list_detail->discount); ?>" autocomplete="off">
                                                    <input type="hidden" class="form-control uom" id="uom_<?php echo e($key+1); ?>" name="uom[]" value="<?php echo e($list_detail->uom); ?>">
                                                </td>
                                                <td width="10%">
                                                    <select class="form-control packing_type" id="packing_type_<?php echo e($key+1); ?>" name="packing_type[]" autocomplete="off">
                                                        <?php if($list_detail->packing_type == '1'): ?>
                                                        <option value="1" selected>Pallet</option>
                                                        <option value="2">Roll</option>
                                                        <?php elseif($list_detail->packing_type == '2'): ?>
                                                        <option value="1">Pallet</option>
                                                        <option value="2" selected>Roll</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </td>
                                                <td width="5%">
                                                    <input type="date" class="form-control effective_from" id="effective_from_<?php echo e($key+1); ?>" value="<?php echo e($list_detail->effective_from); ?>" name="effective_from[]">
                                                </td>
                                                <td width="10%">
                                                    <input type="date" name="effective_to[]" id="effective_to_<?php echo e($key+1); ?>" class="form-control effective_to" value="<?php echo e($list_detail->effective_to); ?>">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-ligth btn-sm " disabled>X</button>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="9">
                                                    <button type="button" class="btn btn-light add_pricelist btn-sm" id="add_pricelist"><i data-feather='plus'></i> Add Rows</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between mt-1 mb-1">
                            <button class="btn btn-warning" type="reset"><i data-feather='refresh-ccw'></i> Reset</button>
                            <button class="btn btn-primary btn-submit" type="submit"><i data-feather='save'></i> <?php echo e(trans('global.save')); ?></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/pricelist/edit.blade.php ENDPATH**/ ?>