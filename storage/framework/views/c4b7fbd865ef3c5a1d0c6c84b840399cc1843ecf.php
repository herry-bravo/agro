<?php $__env->startSection('styles'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<div class="row">
    <div class="card">
        <div class="card-header  mt-50">
            <h6 class="card-title">
                <a href="<?php echo e(route("admin.ap.index")); ?>" class="breadcrumbs__item">Accounting </a>
                <a href="<?php echo e(route("admin.ap.index")); ?>" class="breadcrumbs__item">Account Payable </a>
                <a href="<?php echo e(route("admin.ap.index")); ?>" class="breadcrumbs__item">Create </a>
            </h6>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route("admin.ap.store")); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                        </div>
                        <hr>
                        <div class="box-body">
                            <div class="card-body mt-1 centered">
                                <div class="row mb-50">
                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start text-nowrap"><?php echo e(trans('cruds.aPayable.fields.invoiceno')); ?>

                                                <p>
                                        </b>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="invoice_num" class="form-control " id="invoice_num" autocomplete="off" required>
                                        <input type="hidden" name="invoice_id" value="0" class="form-control " id="invoice_id" autocomplete="off">
                                        <?php if($errors->any()): ?>
                                        <div class="badge bg-danger">
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($error); ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="voucher_number" readonly class="form-control " value="<?php echo e($voucher_num); ?>" id="voucher_number" autocomplete="off">
                                    </div>

                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"><?php echo e(trans('cruds.aPayable.fields.invoicedate')); ?></p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="datepicker1" id="datepicker-1" value="<?php echo e(date('d-M-Y')); ?>" class="form-control text-end" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"><?php echo e(trans('cruds.aPayable.fields.gldate')); ?></p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="datepicker-2" name="datepicker2" value="<?php echo e(date('d-M-Y')); ?> " class="form-control text-end" autocomplete="off" required>

                                    </div>
                                </div>
                                <div class="row mb-50">
                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"><?php echo e(trans('cruds.aPayable.fields.vendor')); ?>

                                                <p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input type="hidden" name="vendor_id" id="vendor_id" class="form-control" placeholder="Search this blog">
                                            <input type="text" name="vendor_name" id="vendor_name" class="form-control" placeholder="Search Vendor" autocomplete="off">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-sm btn-secondary btn-vendor" id="btn-vendor" data-bs-toggle="modal" data-bs-target="#demoModal">
                                                    <i data-feather="search"></i>
                                                </button>
                                            </div>
                                            </di>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"><?php echo e(trans('cruds.aPayable.fields.duedate')); ?></p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="datepicker-3" name="duedate" value="<?php echo e(date('d-M-Y')); ?>" class="form-control datepicker text-end" autocomplete="off" required>
                                        <input type="number" hidden id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                                    </div>
                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"><?php echo e(trans('cruds.aPayable.fields.amount')); ?></p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="amount" class="form-control currency calculate text-end" autocomplete="off" value="0" required>
                                        <input type="hidden" name="invoice_amount" class="form-control value1 calculate" id="invoice_amount" autocomplete="off" required>
                                        <input type="hidden" name="job_definition_name" class="form-control" id="" value="Payable" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="row mb-50">
                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"><?php echo e(trans('cruds.aPayable.fields.curr')); ?>

                                                <p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="customer_currency" id="customer_currency" class="form-control select2" required>
                                            <option value="IDR">IDR - Rupiah</option>
                                            <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($row->currency_code !='IDR'): ?>
                                            <option value="<?php echo e($row->currency_code); ?>" <?php echo e(old('customer_currency') ? 'selected' : ''); ?>> <?php echo e($row->currency_code); ?> - <?php echo e($row->currency_name); ?> </option>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('customer_currency')): ?>
                                        <em class="invalid-feedback">
                                            <?php echo e($errors->first('customer_currency')); ?>

                                        </em>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"><?php echo e(trans('cruds.aPayable.fields.type')); ?></p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="invoice_type_lookup_code" id="invoice_type_lookup_code" value="Standard" class="form-control datepicker" id="" autocomplete="off" readonly required>
                                    </div>
                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"><?php echo e(trans('cruds.aPayable.fields.terms')); ?></p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="terms_id" id="terms_id" class="form-control select2" required>
                                            <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->term_code); ?>" <?php echo e(old('terms') ? 'selected' : ''); ?>> <?php echo e($row->term_code); ?> - <?php echo e($row->terms_name); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('terms')): ?>
                                        <em class="invalid-feedback">
                                            <?php echo e($errors->first('terms')); ?>

                                        </em>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            
                            <div class="card-header">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active btn btn-light" id="nav-ap-tab" data-bs-toggle="tab" data-bs-target="#nav-ap" type="button" role="tab" aria-controls="nav-ap" aria-selected="true">
                                            <span class="bs-stepper-box">
                                                <i data-feather="file-text" class="font-medium-3"></i>
                                            </span>
                                            <span class="bs-stepper-label">
                                                <span class="bs-stepper-title">Main</span>
                                            </span>
                                        </button>
                                        <button class="nav-link btn btn-light" id="nav-ap-det-tab" data-bs-toggle="tab" data-bs-target="#nav-ap-det" type="button" role="tab" aria-controls="nav-ap-det" aria-selected="false">
                                            <span class="bs-stepper-box">
                                                <i data-feather="dollar-sign" class="font-medium-3"></i>
                                            </span>
                                            <span class="bs-stepper-label">
                                                <span class="bs-stepper-title">Account</span>
                                            </span>

                                        </button>
                                    </div>
                                </nav>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="nav-tabContent">
                                    
                                    <div class="tab-pane fade show active" id="nav-ap" role="tabpanel" aria-labelledby="nav-ap-tab">
                                        <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                            <table class="table table-fixed table-borderless" id="tableAP">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Desc</th>
                                                        <th>Account Code</th>
                                                        <th>Quantity</th>
                                                        <th class="text-end">Price</th>
                                                        <th class="text-end">Total Amount</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="ap_container">
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr id="disableAddRow">
                                                        <td colspan="2">
                                                            <button type="button" class="btn btn-light btn-sm add_payable" style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show " id="nav-ap-det" role="tabpanel" aria-labelledby="nav-ap-det-tab">
                                        <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                            <table class="table table-fixed table-borderless" id="table_journal">
                                                <thead>
                                                    <tr>
                                                        <th>Account</th>
                                                        <th class="text-center">Label</th>
                                                        <th class="text-center">Debit</th>
                                                        <th class="text-center">Credit</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="journal_container">

                                                </tbody>
                                                <tfoot>
                                                    <tr class="" id="tr_tax">
                                                        <td width="15%">
                                                            <input type="text" class="form-control search_acc2" value="<?php echo e($tax->tax_account); ?> <?php echo e($tax->acc->description); ?>" name="quantity[]" id="accDes3_0" autocomplete="off" required>
                                                            <input type="hidden" name="account_segment[]" class="form-control datepicker" id="acc3_" value="<?php echo e($tax->tax_account); ?>" autocomplete="off">
                                                            <input type="hidden" class="form-control" value="1" id="line_1" name="line_type_lookup_code[]">
                                                        </td>
                                                        <td width="30%">
                                                            <input type="text" readonly class="form-control" value="<?php echo e($tax->acc->description); ?>" name="item_description[]" id="des3_" autocomplete="off" required>
                                                        </td>
                                                        <td width="20%">
                                                            <label class="form-control text-end tax" id="tax">0</label>
                                                            <input type="hidden" name="total_rec_tax_amount[]" readonly class="form-control datepicker float-center tax text-end" autocomplete="off">
                                                        </td>
                                                        <td width="20%">
                                                            <label class="form-control text-end">0</label>
                                                            <input type="hidden" name="total_nrec_tax_amount[]" readonly class="form-control datepicker float-center text-end" value="" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-ligth btn-sm remove_tax" style="position: inherit;">X</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="">
                                                        <td width="20%">
                                                            <input type="text" class="form-control search_acc3" value="21010000" name="quantity[]" id="accDes4_" autocomplete="off" required>
                                                            <input type="hidden" name="account_segment[]" class="form-control datepicker" id="acc4_" value="21010000" autocomplete="off">
                                                            <input type="hidden" class="form-control" value="1" id="line_1" name="line_type_lookup_code[]">
                                                        </td>
                                                        <td width="25%">
                                                            <input type="text" readonly class="form-control" name="item_description[]" id="invoice_num2" autocomplete="off" required>
                                                        </td>
                                                        <td width="20%">
                                                            <label class="form-control text-end">0</label>
                                                            <input type="hidden" name="total_rec_tax_amount[]" readonly class="form-control datepicker float-center text-end" autocomplete="off">
                                                        </td>
                                                        <td width="20%">
                                                            <input type="hidden" name="total_nrec_tax_amount[]" id="calculate" readonly class="form-control calculate float-center text-end" autocomplete="off">
                                                            <label id="calculate" class="form-control calculate2 text-end">0</label>
                                                            <input type="hidden" name="requested_date[]" id="tax" readonly class="form-control tax float-center text-end" value="" autocomplete="off">
                                                            <input type="hidden" name="requested_date[]" id="sales" readonly class="form-control datepicker float-center text-end" value="" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-ligth btn-sm" style="position: inherit;">X</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="">
                                                        <td colspan="2"></td>
                                                        <td class="text-end" width="25%">
                                                            <label id="calculate_debit" class="form-control calculate2 text-end">0</label>
                                                            <input type="hidden" name="requested_date[]" id="calculate_debit" readonly class="form-control calculate float-center text-end" value="" autocomplete="off">
                                                        </td>
                                                        <td class="text-end" width="25%">
                                                            <label id="calculate_debit" class="form-control calculate2 text-end">0</label>
                                                            <input type="hidden" name="requested_date[]" id="calculate_debit" readonly class="form-control calculate float-center text-end" value="" autocomplete="off">
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row mt-1 mb-1">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Status</label>
                                                <input type="text" class="form-control grand_total " value="Draft" name="status_name" readonly="">
                                                <input type="hidden" class="form-control grand_total " name="status_name" value='1' readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tax ( Amount )</label><br>
                                                <input type="hidden" class="form-control" id="pajak" name="tax_rate" value="<?php echo e($tax->tax_rate); ?>">
                                                <input type="hidden" class="form-control" id="pajak_code" name="tax_code" value="<?php echo e($tax->tax_code); ?>">
                                                <input type="hidden" class="form-control tax" id="tax_main" name="tax_amount">
                                                <label class="form-control text-end tax" id="tax_main2">0</label>
                                            </div>
                                        </div>
                                        <div class=" col-md-5">
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="hidden" class="form-control" value="0" id="passing" readonly="" name="purchase_total">
                                                <label class="form-control text-end calculate2">0</label>
                                                <input type="hidden" class="form-control calculate" value="0" id="total" readonly="" name="purchase_total">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.box-body -->

                                
                                <?php echo $__env->make('admin.accountPayable.vendor-src', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('admin.accountPayable.grn-src', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="d-flex justify-content-between mb-1">
                                    <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#actionModal"> <span class="bs-stepper-box">
                                            <i data-feather="settings" class="font-medium-3"></i>
                                        </span>Actions</button>
                                    <button id="btn-grn" type="button" class="btn btn-sm btn-info " data-bs-toggle="modal" data-bs-target="#poModal"> <span class="bs-stepper-box">
                                            <i data-feather="check-circle" class="font-medium-3"></i>
                                        </span>PO Match</button>
                                    <button type="submit" class="btn btn-sm btn-primary"> <i data-feather="corner-down-right" class="font-medium-3"></i> Submit</button>

                                </div>
                            </div>
                        </div>
                    </div>

            </form>

        </div>
    </div>
</div>
</div>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/accountPayable/create.blade.php ENDPATH**/ ?>