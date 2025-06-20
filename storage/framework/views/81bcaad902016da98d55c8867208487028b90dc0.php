<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="card">
        <div class="card-header  mt-50">
            <h6 class="card-title">
                <a href="<?php echo e(route("admin.ar.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.aReceivable.title')); ?> </a>
                <a href="<?php echo e(route("admin.ar.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.aReceivable.title')); ?> </a>
                <a href="<?php echo e(route("admin.ar.create")); ?>" class="breadcrumbs__item">Create </a>
            </h6>
        </div>
        <hr>
        <div class="card-body">
            <form action="<?php echo e(route('admin.ar.store')); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal" novalidate>
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                        </div>
                        <div class="box-body">
                            <div class="card-body mt-50 centered">
                                <div class="row mb-50">
                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start text-nowrap">
                                                <?php echo e(trans('cruds.aReceivable.ar.trx_number')); ?>

                                                <p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="invoice_num" class="form-control " id="invoice_num" value="" autocomplete="off">
                                        <?php if($errors->any()): ?>
                                        <div class="badge bg-danger">
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($error); ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"><?php echo e(trans('cruds.aReceivable.ar.trx_date')); ?>

                                            </p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="datepicker-1" name="trx_date" value="<?php echo e(date('d-M-Y')); ?>" class="form-control datepicker" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"> Delivery</p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="attribute1" value="" class="form-control" autocomplete="off" required>

                                    </div>
                                </div>
                                <div class="row mb-50">
                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"><?php echo e(trans('cruds.aReceivable.ar.bill_to')); ?></p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="bill_to_customer_id" id="bill_to" class="form-control select2" required>
                                            <option hidden disabled selected></option>
                                            <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->cust_party_code); ?>" <?php echo e(old('customer_name') ? 'selected' : ''); ?>><?php echo e($row->party_name); ?> - <?php echo e($row->address1); ?>,<?php echo e($row->city); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"><?php echo e(trans('cruds.aReceivable.ar.terms')); ?></p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="term_id" id="terms" class="form-control select2" required>
                                            <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($row->term_code); ?>" <?php echo e(old('terms') ? 'selected' : ''); ?>><?php echo e($row->term_code); ?> - <?php echo e($row->terms_name); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('terms')): ?>
                                        <em class="invalid-feedback"><?php echo e($errors->first('terms')); ?></em>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start">Note No</p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="attribute2" class="form-control" autocomplete="off" value="" required>
                                        <input type="hidden" name="lines[]" class="form-control" autocomplete="off" value="" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"><?php echo e(trans('cruds.aReceivable.ar.ship_to')); ?></p>
                                        </b>
                                    </div>

                                    <div class="col-md-3">
                                        <select id="ship_to" name="ship_to_customer_id" class="form-control select2" required>
                                            <option hidden disabled selected></option>
                                            <?php $__currentLoopData = $site; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->site_code); ?>"><?php echo e($row->address1); ?>, <?php echo e($row->city); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <b>
                                            <p class="text-start"><?php echo e(trans('cruds.aReceivable.ar.curr')); ?>

                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="invoice_currency_code" id="customer_currency" class="form-control select2" required>
                                            <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->currency_code); ?>"><?php echo e($row->currency_code); ?> - <?php echo e($row->currency_name); ?>

                                            </option>
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
                                            <p class="text-start">GL Date </p>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="datepicker-2" name="gl_date" value="<?php echo e(date('d-M-Y')); ?>" class="form-control datepicker" autocomplete="off" required>
                                        <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id ?? ''); ?>">
                                        <input type="hidden" id="created_by" name="bill_template_name" value="Receivable">
                                    </div>
                                </div>

                            </div>
                            <hr>

                            
                            <div class="card-header">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active btn btn-light" id="nav-ap-tab" data-bs-toggle="tab" data-bs-target="#nav-ap" type="button" role="tab" aria-controls="nav-ap" aria-selected="true">
                                            <span class="bs-stepper-box"><i data-feather="file-text" class="font-medium-3"></i></span>
                                            <span class="bs-stepper-label"><span class="bs-stepper-title">Main</span></span>
                                        </button>
                                        <button class="nav-link btn btn-light" id="nav-ap-det-tab" data-bs-toggle="tab" data-bs-target="#nav-ap-det" type="button" role="tab" aria-controls="nav-ap-det" aria-selected="false">
                                            <span class="bs-stepper-box"><i data-feather="dollar-sign" class="font-medium-3"></i></span>
                                            <span class="bs-stepper-label"><span class="bs-stepper-title">Journal Items</span></span>
                                        </button>
                                    </div>
                                </nav>
                            </div>
                            <div class="card-body ">
                                <div class="tab-content" id="nav-tabContent">
                                    
                                    <div class="tab-pane fade show active" id="nav-ap" role="tabpanel" aria-labelledby="nav-ap-tab">
                                        <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                            <table class="table table-fixed table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Product</th>
                                                        <th class="text-center">Label</th>
                                                        <th class="text-center">Account Code</th>
                                                        <th class="text-center">Quantity</th>
                                                        <th class="text-center">Price</th>
                                                        <th class="text-center">Total Amount</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="receivable_container">
                                                    <tr class="">
                                                        <td width="15%">
                                                            <input type="text" class="form-control search_ar_item" placeholder="Typye here ..." name="item_code[]" id="searchitem_1" autocomplete="off" required>
                                                            <span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span>
                                                            <input type="hidden" class="search_inventory_item_id" id="id_1" name="inventory_item_id[]">
                                                            <input type="hidden" class="form-control" value="" id="item_code_1" name="child_item[]">
                                                        </td>
                                                        <td width="20%">
                                                            <input type="text" class="form-control" value="" id="description_1" name="">
                                                            <input type="hidden" class="form-control" value="" id="uom_1" readonly name="uom_code[]">
                                                        </td>
                                                        <td width="20%">
                                                            <input type="text" name="accountDess[]" class="form-control search_acc" id="accDes_1" autocomplete="off">
                                                            <input type="hidden" name="code_combinations1[]" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                        </td>
                                                        <td width="10%">
                                                            <input type="text" name="quantity_invoiced[]" class="form-control recount_ar text-end" id="qty_1" autocomplete="off">
                                                        </td>
                                                        <td width="20%">
                                                            <input type="text" name="unit_selling_price[]" class="form-control recount_ar float-center text-end" id="price_1" autocomplete="off">
                                                        </td>
                                                        <td width="20%">
                                                            <input type="text" name="amount_due_original[]" class="form-control subtotalAdd_1 grandSub float-center text-end" id="subtotalAdd_1" value="0" readonlyautocomplete="off">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-ligth btn-sm " style="position: inherit;">X</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2">
                                                            <button type="button" class="btn btn-light btn-sm add_receivable " style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        <div class="row mt-2 mb-2">
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
                                                    <input type="hidden" class="form-control tax" id="tax_main" value="0" name="tax_amount">
                                                    <input type="hidden" class="form-control" id="pajak" value="0.11" name="tax">
                                                    <label class="form-control text-end tax" id="tax_main2">0</label>
                                                </div>
                                            </div>
                                            <div class=" col-md-5">
                                                <div class="form-group">
                                                    <label>Total</label>
                                                    <input type="hidden" class="form-control calculate" value="0" id="amount" readonly="" name="ar_amount">
                                                    <label class="form-control text-end calculate" id="total">0</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show " id="nav-ap-det" role="tabpanel" aria-labelledby="nav-ap-det-tab">
                                        <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                            <table class="table table-fixed table-borderless">
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
                                                    <tr class="tr_input">
                                                        <td width="20%">
                                                            <input type="text" class="form-control search_acc" name="quantity[]" id="accDes2_1" autocomplete="off" required>
                                                            <input type="hidden" name="code_combinations[]" class="form-control datepicker" id="acc2_1" autocomplete="off">
                                                            <input type="hidden" name="line_type[]" class="form-control datepicker" value="0" id="" autocomplete="off">
                                                        </td>
                                                        <td width="32%">
                                                            <input type="text" class="form-control" value="" id="description2_1" readonly name="description[]">
                                                        </td>
                                                        <td width="20%">
                                                            <label class="form-control  text-end">0</label>
                                                            <input type="hidden" name="frt_ed_amount[]" readonly class="form-control float-center text-end" id="price_1" autocomplete="off">
                                                        </td>
                                                        <td width="25%">
                                                            <label class="form-control text-end" id="price2_1">0</label>
                                                            <input type="hidden" name="frt_uned_amount[]" readonly class="form-control subtotalAdd float-center text-end" id="subtotal_1" value="0" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-ligth hapusdata btn-sm" style="position: inherit;">X</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="">
                                                        <td width="15%">
                                                            <input type="text" class="form-control search_acc2" value="<?php echo e($tax->tax_account); ?> <?php echo e($tax->acc->description); ?>" name="quantity2[]" id="accDes3_" autocomplete="off" required>
                                                            <input type="hidden" class="form-control" name="tax_acc" id="accDes3_" autocomplete="off" required>
                                                            <input type="hidden" class="form-control" value="TAX-11" name="tax_code" id="accDes3_" autocomplete="off" required>
                                                            <input type="hidden" name="code_combinations[]" class="form-control datepicker" id="acc3_" value="<?php echo e($tax->tax_account); ?>" autocomplete="off">
                                                            <input type="hidden" name="organization_id" class="form-control datepicker" id="" value="222" autocomplete="off">
                                                            <input type="hidden" name="line_type[]" class="form-control datepicker" value="1" id="" autocomplete="off">
                                                        </td>
                                                        <td width="25%">
                                                            <input type="text" readonly class="form-control" value="<?php echo e($tax->acc->description); ?>" name="description[]" id="des3_" autocomplete="off" required>
                                                        </td>
                                                        <td width="20%">
                                                            <label class="form-control text-end ">0</label>
                                                            <input type="hidden" name="frt_ed_amount[]" readonly class="form-control datepicker float-center text-end" autocomplete="off">
                                                        </td>
                                                        <td width="20%">
                                                            <label class="form-control text-end tax">0</label>
                                                            <input type="hidden" name="frt_uned_amount[]" readonly class="form-control tax float-center text-end" value="0" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-ligth btn-sm remove_tax" style="position: inherit;">X</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="">
                                                        <td width="15%">
                                                            <input type="text" class="form-control search_acc3" value="" name="quantity3[]" id="ar_accDess" autocomplete="off" required>
                                                            <input type="hidden" name="code_combinations[]" class="form-control datepicker" id="ar_acc" autocomplete="off">
                                                            <input type="hidden" name="line_type[]" class="form-control datepicker" value="1" id="" autocomplete="off">
                                                        </td>
                                                        <td width="25%">
                                                            <input type="text" class="form-control" value="" name="description[]" id="ar_accDess2" autocomplete="off" required>
                                                        </td>
                                                        <td width="20%">
                                                            <label id="calculate" class="form-control calculate text-end">0</label>
                                                            <input type="hidden" name="frt_ed_amount[]" id="calculate" readonly class="form-control calculate float-center text-end" value="0" autocomplete="off">
                                                            <input type="hidden" name="" id="tax" readonly class="form-control tax float-center text-end" value="0" autocomplete="off">
                                                            <input type="hidden" name="" id="sales" readonly class="form-control datepicker float-center text-end" value="0" autocomplete="off">
                                                        </td>
                                                        <td width="20%">
                                                            <label class="form-control text-end">0</label>
                                                            <input type="hidden" name="frt_uned_amount[]" readonly class="form-control float-center text-end" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-ligth btn-sm " style="position: inherit;">X</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="">
                                                        <td colspan="2"></td>
                                                        <td class="text-end" width="20%">
                                                            <label id="calculate_debit" class="form-control calculate text-end">0</label>
                                                            <input type="hidden" name="" id="calculate_debit" readonly class="form-control calculate float-center text-end" value="0" autocomplete="off">
                                                        </td>
                                                        <td class="text-end" width="20%">
                                                            <label id="calculate_credit" class="form-control calculate text-end">0</label>
                                                            <input type="hidden" name="" readonly class="form-control calculate float-center text-end" id="calculate_credit" value="0" autocomplete="off">
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="d-flex justify-content-between mt-2 mb-2">
                                    <div></div>
                                    <button type="submit" name='action' value="save" class="btn btn-sm btn-primary pull-right"> <i data-feather="corner-down-right" class="font-medium-3"></i>Submit</button>
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

<?php $__env->startPush('script'); ?>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        , }
    });

    $(document).ready(function() {
        $("input:checkbox").on('click', function() {
            // in the handler, 'this' refers to the box clicked on
            var $box = $(this);
            if ($box.is(":checked")) {
                // the name of the box is retrieved using the .attr() method
                // as it is assumed and expected to be immutable
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                // the checked state of the group/box on the other hand will change
                // and the current value is retrieved using .prop() method
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });
    });

</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/arReceivable/create.blade.php ENDPATH**/ ?>