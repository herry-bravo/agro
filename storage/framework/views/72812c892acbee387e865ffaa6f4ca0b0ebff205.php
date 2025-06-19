
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-validation.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-wizard.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('app-assets/vendors/js/forms/wizard/bs-stepper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/js/scripts/forms/form-wizard.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <a href="<?php echo e(route('admin.vendor.index')); ?>" class="breadcrumbs__item">Purchase Order</a>
    <a href="<?php echo e(route('admin.vendor.index')); ?>" class="breadcrumbs__item">Supplier</a>
    <a href="" class="breadcrumbs__item active">Create</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Modern Horizontal Wizard -->
    <section class="modern-horizontal-wizard">
        <div class="bs-stepper wizard-modern modern-wizard-example">
            <div class="bs-stepper-header">
                <div class="step" data-target="#step1" role="tab" id="step1-trigger">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Supplier Master</span>
                            <span class="bs-stepper-subtitle">Setup Supplier Master</span>
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
                            <span class="bs-stepper-title">Supplier Site</span>
                            <span class="bs-stepper-subtitle">Add Supplier Site</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="<?php echo e(route('admin.vendor.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="bs-stepper-content">
                                <div id="step1" class="content" role="tabpanel" aria-labelledby="step1-trigger">
                                    <div class="content-header">
                                        <h5 class="mb-0">Supplier Master</h5>
                                        <small class="text-muted">Enter Your Supplier Master.</small>
                                    </div>

                                    <div class="row">
                                        <div class="mb-1 col-md-1">
                                            <label class="col-sm-0 form-label"
                                                for="site"><?php echo e(trans('cruds.vendor.fields.loc')); ?></label></br>
                                            <div class="form-check form-switch form-check-primary">
                                                <input type="checkbox" class="form-check-input" name="vendor_location"
                                                    id="customSwitch10" value="1" onclick="handleClick(this);">
                                                <label class="form-check-label" for="customSwitch10">
                                                    <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-check">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-1 col-md-6">
                                            <label class="col-sm-0 form-label"
                                                for="number"><?php echo e(trans('cruds.vendor.fields.vendor_code')); ?></label>
                                            <input type="text" class="form-control" name="vendor_id"
                                                placeholder="Vendor Code" required="required" maxlength="8" minlength="8">
                                            <input type="hidden" class="form-control" name="status" value='1'>
                                        </div>
                                        <div class="mb-1 col-md-4">
                                            <label class="col-sm-0 form-label"
                                                for="number"><?php echo e(trans('cruds.vendor.fields.vendor_name')); ?></label>
                                            <input type="text" class="form-control" name="vendor_name"
                                                placeholder="Vendor Name" maxlength="100" required>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="mb-1 col-md-6">
                                            <label class="col-sm-0 form-label"
                                                for="number"><?php echo e(trans('cruds.vendor.fields.address1')); ?></label>
                                            <input type="text" class="form-control" name="address1"
                                                placeholder="Address1" maxlength="75" required>
                                        </div>
                                        <div class="mb-1 col-md-6">
                                            <label class="col-sm-0 form-label"
                                                for="number"><?php echo e(trans('cruds.vendor.fields.address2')); ?></label>
                                            <input type="text" class="form-control" name="address2" maxlength="50"
                                                placeholder="Address2">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-1 col-md-4">
                                            <label class="col-sm-0 form-label"
                                                for="number"><?php echo e(trans('cruds.vendor.fields.city')); ?></label>
                                            <input type="text" class="form-control" name="city"
                                                placeholder="City">
                                        </div>
                                        <div class="mb-1 col-md-4">
                                            <label class="col-sm-0 form-label"
                                                for="number"><?php echo e(trans('cruds.vendor.fields.province')); ?></label>
                                            <input type="text" class="form-control" name="province"
                                                placeholder="Province">
                                        </div>
                                        <div class="mb-1 col-md-4">
                                            <label class="col-sm-0 form-label"
                                                for="number"><?php echo e(trans('cruds.vendor.fields.country')); ?></label>
                                            <input type="text" class="form-control" name="country"
                                                placeholder="Country">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-1 col-md-4">
                                            <label class="col-sm-0 form-label"
                                                for="number"><?php echo e(trans('cruds.vendor.fields.tax')); ?></label>
                                            <select type="text" id="tax_code" name="tax_code"
                                                class="form-control select2" required>
                                                <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($raw->tax_code); ?>"><?php echo e($raw->tax_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="mb-1 col-md-4">
                                            <label class="col-sm-0 form-label"
                                                for="number"><?php echo e(trans('cruds.vendor.fields.currency')); ?></label>
                                            <select type="text" id="currency" name="currency"
                                                class="form-control select2"
                                                value="<?php echo e(old('currency', isset($currency) ? $quotation->currency : '')); ?>"
                                                required>
                                                <option value="0">........Option........ </option>
                                                <option value="IDR">IDR</option>
                                                <option value="USD">USD</option>
                                            </select>
                                        </div>
                                        <div class="mb-1 col-md-4">
                                            <label class="col-sm-0 form-label"
                                                for="number"><?php echo e(trans('cruds.vendor.fields.terms')); ?></label>
                                            <select type="text" id="terms" name="terms"
                                                class="form-control select2"
                                                value="<?php echo e(old('terms', isset($terms) ? $vendor->terms : '')); ?>" required>
                                                <option value="0">........Option........ </option>
                                                <option value="3">30 After Receive Invoice</option>
                                                <option value="2">Every 15 Next Month</option>
                                                <option value="1">Cash</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-1 col-md-3">
                                            <label class="col-sm-0 form-label"
                                                for="number"><?php echo e(trans('cruds.vendor.fields.phone')); ?></label>
                                            <input type="text" name="phone" class='form-control' placeholder=''
                                                required="required" maxlength="12" minlength="10" />
                                        </div>
                                        <div class="mb-1 col-md-3">
                                            <label class="col-sm-0 form-label"
                                                for="number"><?php echo e(trans('cruds.vendor.fields.email')); ?></label>
                                            <input type="text" name="email" class='form-control' placeholder='' />
                                        </div>
                                        <div class="mb-1 col-md-3">
                                            <label class="col-sm-3"><?php echo e(trans('cruds.vendor.fields.bank_number')); ?></label>
                                            <input type="text" name="bank_number" class='form-control' placeholder=''
                                                maxlength="16" minlength="10" />
                                        </div>
                                        <div class="mb-1 col-md-3">
                                            <label class="col-sm-3"><?php echo e(trans('cruds.vendor.fields.tax_number')); ?></label>
                                            <input type="text" name="tax_number" class='form-control'
                                                placeholder='Tax Number' maxlength="16" minlength="10" />
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-outline-secondary btn-prev" disabled>
                                            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary pull-left"><i
                                                data-feather='save'></i> <?php echo e(trans('global.save')); ?></button>

                                    </div>
                                </div>
                        </form>

                        <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
                            <div class="content-header">
                                <div style="margin-top: 10px;" class="row mb-0">
                                    <div class="col-lg-11">
                                        <h5 class="mb-0">Supplier Site</h5>
                                        <small>Enter Your Supplier Site.</small>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-primary pull-left" id="allselect"
                                            data-bs-toggle="modal" data-bs-target="#demoModal"> Add Site </button>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class=" table table-bordered table-striped table-hover datatable datatable-Transaction w-100">
                                    <thead>
                                        <tr>
                                            <th width="10">

                                            </th>
                                            <th>
                                                <?php echo e(trans('cruds.vendor.fields.vendor_code')); ?>

                                            </th>
                                            <th>
                                                <?php echo e(trans('cruds.vendor.fields.vendor_name')); ?>

                                            </th>
                                            <th>
                                                <?php echo e(trans('cruds.vendor.fields.address1')); ?>

                                            </th>
                                            <th>
                                                <?php echo e(trans('cruds.vendor.fields.country')); ?>

                                            </th>
                                            <th>
                                                <?php echo e(trans('cruds.vendor.fields.phone')); ?>

                                            </th>
                                            <th>
                                                <?php echo e(trans('cruds.vendor.fields.email')); ?>

                                            </th>
                                            <th>
                                                <?php echo e(trans('cruds.vendor.fields.tax')); ?>

                                            </th>
                                            <th>
                                                <?php echo e(trans('cruds.vendor.fields.currency')); ?>

                                            </th>
                                            <th>
                                                &nbsp;
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $site; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr data-entry-id="<?php echo e($row->id); ?>">
                                                <td>

                                                </td>
                                                <td>
                                                    <?php echo e($row->cust_party_code ?? ''); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($row->vendor_name ?? ''); ?>

                                                </td>
                                                <td width="20%">
                                                    <?php echo e($row->address1 ?? ''); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($row->country ?? ''); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($row->phone ?? ''); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($row->email ?? ''); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($row->tax_code ?? ''); ?>

                                                </td>
                                                <td width="5%">
                                                    <?php echo e($row->currency ?? ''); ?>

                                                </td>
                                                <td width="15%">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('transaction_show')): ?>
                                                        <a class="btn btn-xs btn-primary"
                                                            href="<?php echo e(route('admin.transactions.show', $row->id)); ?>">
                                                            <?php echo e(trans('global.view')); ?>

                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('transaction_edit')): ?>
                                                        <a class="btn btn-xs btn-info"
                                                            href="<?php echo e(route('admin.transactions.edit', $row->id)); ?>">
                                                            <?php echo e(trans('global.edit')); ?>

                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('transaction_delete')): ?>
                                                        <form action="<?php echo e(route('admin.transactions.destroy', $row->id)); ?>"
                                                            method="POST"
                                                            onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');"
                                                            style="display: inline-block;">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="<?php echo e(csrf_token()); ?>">
                                                            <input type="submit" class="btn btn-xs btn-danger"
                                                                value="<?php echo e(trans('global.delete')); ?>">
                                                        </form>
                                                    <?php endif; ?>

                                                </td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary btn-prev">
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                            </div>

                            <form action="<?php echo e(route('admin.site.store')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <!-- Modal Example Start-->
                                <div class="modal fade" id="demoModal" tabindex="-1" role="dialog"
                                    aria-labelledby="demoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="border-0 bg-success text-white btn-close"
                                                    data-dismiss="modal" style="transform: inherit;" aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="mb-1 col-md-4">
                                                            <label class="col-sm-1 control-label"
                                                                for="number"><?php echo e(trans('cruds.site.fields.type')); ?></label>
                                                            <select name="site_type" id="type_code"
                                                                class="form-control select2" required>
                                                                <option value="Billto"> Bill TO</option>
                                                                <option value="Shipto">Ship To</option>
                                                                <option value="Deliveryto">Delivery TO</option>
                                                            </select>
                                                            <?php if($errors->has('type_code')): ?>
                                                                <p class="help-block">
                                                                    <?php echo e($errors->first('type_code')); ?>

                                                                </p>
                                                            <?php endif; ?>
                                                            <p class="helper-block">
                                                            </p>
                                                        </div>
                                                        <div class="mb-1 col-md-4">
                                                            <label class="col-sm-4 control-label"
                                                                for="number"><?php echo e(trans('cruds.site.fields.vendor_code')); ?></label>
                                                            <input type="text" class="form-control"
                                                                name="cust_party_code" 
                                                                placeholder="Party Site Code" readonly required="required"
                                                                maxlength="12" minlength="8">
                                                            <!-- <input type="text" class="form-control"
                                                                name="cust_party_code" 
                                                                value="<?php echo e($max->vendor_id); ?>"
                                                                placeholder="Party Site Code" readonly required="required"
                                                                maxlength="12" minlength="8"> -->
                                                        </div>
                                                        <div class="mb-1 col-md-4">
                                                            <label class="col-sm-4 control-label"
                                                                for="number"><?php echo e(trans('cruds.site.fields.code')); ?></label>
                                                            <input type="text" class="form-control" name="site_code"
                                                                placeholder="Party Site Code" required="required"
                                                                maxlength="12" minlength="8">
                                                        </div>
                                                    </div>
                                                    <hr>


                                                    <div class="row">
                                                        <div class="mb-1 col-md-4">
                                                            <label class="col-sm-1 control-label"
                                                                for="number"><?php echo e(trans('cruds.site.fields.name')); ?></label>
                                                            <input type="text" class="form-control" name="address1"
                                                                placeholder="Site Name">
                                                        </div>
                                                        <div class="mb-1 col-md-4">
                                                            <label class="col-sm-1 control-label"
                                                                for="number"><?php echo e(trans('cruds.site.fields.address2')); ?></label>
                                                            <input type="text" class="form-control" name="address2"
                                                                placeholder="">
                                                        </div>
                                                        <div class="mb-1 col-md-4">
                                                            <label class="col-sm-1 control-label"
                                                                for="number"><?php echo e(trans('cruds.site.fields.address3')); ?></label>
                                                            <input type="text" class="form-control" name="address3"
                                                                placeholder="">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="mb-1 col-md-3">
                                                            <label class="col-sm-1 control-label"
                                                                for="number"><?php echo e(trans('cruds.site.fields.city')); ?></label>
                                                            <input type="text" class="form-control" name="city"
                                                                placeholder="City">
                                                        </div>
                                                        <div class="mb-1 col-md-3">
                                                            <label class="col-sm-1 control-label"
                                                                for="number"><?php echo e(trans('cruds.site.fields.province')); ?></label>
                                                            <input type="text" class="form-control" name="province"
                                                                placeholder="Province">
                                                        </div>
                                                        <div class="mb-1 col-md-3">
                                                            <label class="col-sm-1 control-label"
                                                                for="number"><?php echo e(trans('cruds.site.fields.country')); ?></label>
                                                            <input type="text" class="form-control" name="country"
                                                                placeholder="Country">
                                                        </div>
                                                        <div class="mb-1 col-md-3">
                                                            <label class="col-sm-0 form-label"
                                                                for="number"><?php echo e(trans('cruds.site.fields.postal_code')); ?></label>
                                                            <input type="text" class="form-control" name="postal_code"
                                                                placeholder="Postal Code">
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="mb-1 col-md-6">
                                                            <label class="col-sm-1 control-label"
                                                                for="number"><?php echo e(trans('cruds.site.fields.phone')); ?></label>
                                                            <input type="text" name="phone" class='form-control'
                                                                placeholder='' required="required" maxlength="12"
                                                                minlength="10" />
                                                        </div>
                                                        <div class="mb-1 col-md-6">
                                                            <label class="col-sm-1 control-label"
                                                                for="number"><?php echo e(trans('cruds.site.fields.email')); ?></label>
                                                            <input type="text" name="email" class='form-control'
                                                                placeholder='' />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-secondary"><i
                                                            data-feather='plus'></i><?php echo e(trans('global.add')); ?></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Modal Example Start-->
                            </form>
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
        function handleClick(cb) {
            cb.value = cb.checked ? 0 : 1;
            console.log(cb.value);
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/vendor/create.blade.php ENDPATH**/ ?>