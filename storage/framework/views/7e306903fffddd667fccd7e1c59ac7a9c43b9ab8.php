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
                        <a href="#" class="breadcrumbs__item ">Create</a></h6>
                </div>
                <hr>
                <div class="card-body">
                    <form action="<?php echo e(route("admin.pricelist.store")); ?>" method="POST" enctype="multipart/form-data" id="jquery-val-form">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="effective_date"><?php echo e(trans('cruds.pricelist.fields.effective_date')); ?></label>
                                            <input type="text" id="fp-default" name="effective_date" class="form-control flatpickr-basic flatpickr-input" value="<?php echo e(old('effective_date', isset($pricelist) ? $pricelist->effective_date : '')); ?>" required>
                                            <div class="invalid-feedback"><?php echo e(trans('cruds.pricelist.fields.effective_date')); ?> <?php echo e(trans('global.required')); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="price_list_name"><?php echo e(trans('cruds.pricelist.fields.price_list_name')); ?></label>
                                            <input type="text" id="purpose_date" name="purpose_date" class="form-control" hidden value="<?php echo e(now()->format ('Y-m-d')); ?>">
                                            <select name="price_list_name" class="form-control select2" required>
                                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($row->cust_party_code); ?>" <?php echo e(old('price_list_name') == $row->cust_party_code ? 'selected' : ''); ?>> <?php echo e($row->party_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <div class="invalid-feedback"><?php echo e(trans('cruds.pricelist.fields.price_list_name')); ?> <?php echo e(trans('global.required')); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">

                                            <label class="form-label" for="description"><?php echo e(trans('cruds.pricelist.fields.description')); ?></label>
                                            <input type="text" id="description" name="description_header" class="form-control" value="<?php echo e(old('description', isset($pricelist) ? $pricelist->description : '')); ?>" required autocomplete="off">
                                            <div class="invalid-feedback"><?php echo e(trans('cruds.pricelist.fields.description')); ?> <?php echo e(trans('global.required')); ?></div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="currency"><?php echo e(trans('cruds.pricelist.fields.currency')); ?></label>
                                            <select name="currency" id="currency" class="form-control select2" required>
                                                <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($row->id); ?>" <?php echo e(old('currency') == $row->id ? 'selected' : ''); ?>> <?php echo e($row->currency_code); ?> - <?php echo e($row->currency_name); ?> </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">

                                            <label class="form-label" for="location_id"><?php echo e(trans('cruds.pricelist.fields.location_id')); ?></label>
                                            <input type="number" hidden id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                                            <input type="number" hidden id="updated_by" name="updated_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                                            <input type="number" id="location_id" name="location_id" class="form-control" value="<?php echo e(old('location_id', isset($pricelist) ? $pricelist->location_id : '')); ?>" required>
                                            <div class="invalid-feedback"><?php echo e(trans('cruds.pricelist.fields.location_id')); ?> <?php echo e(trans('global.required')); ?></div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row mb-4">
                            <div class="box box-default overflow-auto">
                                <div class="box-body" style="height: 350px;">
                                    <table class="table table-responsive" id="tab_logic">
                                        <thead>
                                            <th scope="col">Line ID</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Item Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Packing Type</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="pricelist_container">
                                            <tr class="tr_input">
                                                <td class="rownumber" width="3%">1
                                                </td>
                                                <td width="25%">
                                                    <input type="hidden" class="line_id" id="line_id_1" name="line_id[]" value="1">
                                                    <input type="text" class="form-control search_list" placeholder="Type here ..." id="search_item_code_1" name="item_code[]" autocomplete="off" required>
                                                    <span class="help-block search_item_code_empty1 glyphicon" style="display: none;"> No Results Found </span>
                                                    <input type="hidden" class="search_item_code_id" id="id_1" name="inventory_item_id[]" autocomplete="off">
                                                    <input type="hidden" class="form-control" name="description_item_code[]" id="description_item_code_1" value="">
                                                    <input type="hidden" class="form-control" name="uom[]" id="uom_1" value="">
                                                    <?php if($errors->first('inventory_item_id')): ?>
                                                    <div class="danger">
                                                        <span class="badge bg-danger"><?php echo e($errors->first('inventory_item_id')); ?></span>
                                                    </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td width="15%">
                                                    <input type="text" class="form-control user_item_description" id="user_item_description_1" name="user_item_description[]" readonly autocomplete="off">
                                                    <span id="user_item_description_empty_1"></span>
                                                </td>
                                                <td width="15%">
                                                    <input type="number" class="form-control text-end" min=1  oninput="validity.valid||(value='');" id="unit_prices_list_1" name="unit_prices[]" autocomplete="off" required>
                                                    <input type="hidden" id="prices_list_1" name="prices_list[]" autocomplete="off">
                                                    <div class="invalid-feedback"><?php echo e(trans('cruds.pricelist.fields.unit_price')); ?> <?php echo e(trans('global.required')); ?></div>
                                                </td>
                                                <td width="10%">
                                                    <input type="number" class="form-control discount" min=0  oninput="validity.valid||(value='');" id="discount_1" name="discount[]" autocomplete="off" required>
                                                    <div class="invalid-feedback"><?php echo e(trans('cruds.pricelist.fields.discount')); ?> <?php echo e(trans('global.required')); ?></div>
                                                </td>
                                                <td width="10%">
                                                    <select class="form-control packing_type" id="packing_type_1" name="packing_type[]" required>
                                                        <option value="2">Roll</option>
                                                        <option value="1">Pallet</option>

                                                    </select>
                                                </td>
                                                <td width="10%">
                                                    <input type="date" class="form-control effective_from" id="effective_from_1" name="effective_from[]" required>
                                                    <div class="invalid-feedback"><?php echo e(trans('cruds.pricelist.fields.effective_from')); ?> <?php echo e(trans('global.required')); ?></div>
                                                    <?php if($errors->first('effective_from')): ?>
                                                    <div class="danger">
                                                        <span class="badge bg-danger"><?php echo e($errors->first('effective_from')); ?></span>
                                                    </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td width="10%">
                                                    <input type="date" name="effective_to[]" id="effective_to_1" class="form-control effective_to">
                                                    <div class="invalid-feedback"><?php echo e(trans('cruds.pricelist.fields.effective_to')); ?> <?php echo e(trans('global.required')); ?></div>
                                                    <?php if($errors->first('effective_to')): ?>
                                                    <div class="danger">
                                                        <span class="badge bg-danger"><?php echo e($errors->first('effective_to')); ?></span>
                                                    </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-ligth btn-sm remove_tr_pricelist disabled">X</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="9">
                                                    <button type="button" class="btn btn-light add_pricelist btn-sm " id="add_pricelist"><i data-feather='plus'></i> Add Rows</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mt-1 mb-50">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/pricelist/create.blade.php ENDPATH**/ ?>