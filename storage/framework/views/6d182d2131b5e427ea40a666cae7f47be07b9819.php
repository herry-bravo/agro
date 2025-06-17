<?php $__env->startSection('content'); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <a href="<?php echo e(route('admin.gl.index')); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.gl.fields.accrcv')); ?></a>
    <a href="<?php echo e(route('admin.gl.index')); ?>" class="breadcrumbs__item">Journal Entries</a>
    <a href="<?php echo e(route('admin.gl.create')); ?>"class="breadcrumbs__item active" aria-current="page">Create</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card" >
        <div class="card-header mt-2 mb-25">
            <h6 class="card-title">
                <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.gl.title')); ?> </a>
                <a href="javascript:history.go(-1)" class="breadcrumbs__item"> Journal Entries </a>
                <a href="<?php echo e(route("admin.gl.create")); ?>" class="breadcrumbs__item"> Create </a>
            </h6>
        </div>
        <hr>
    </br>
        <div class="card-header">
            <h4 class="card-title mb-2"><?php echo e(trans('cruds.gl.fields.draft')); ?></h4>
        </div>
        <br>
        <div class="card-body">
            <form action="<?php echo e(route("admin.gl.store")); ?>" method="POST" enctype="multipart/form-data" id="verifyDocForm">
                <?php echo e(csrf_field()); ?>

                <div class="form-group row">
                    <label class="col-sm-1 control-label" for="input_replaceinv"><?php echo e(trans('cruds.gl.fields.replaceinvoice')); ?></label>
                    <div class="col-sm-5">
                        <input autocomplete="off" type="text" id="replaceinv_id" name="name" class="form-control" value="" placeholder=" Name ..." required >
                        <?php if($errors->any()): ?>     <?php echo implode('', $errors->all('<p style="color:red">:message</p>')); ?> <?php endif; ?>
                        <input type="text" hidden id="je_source" name="je_source" value="Entry" class="form-control">
                        <input type="number" hidden id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                        <input type="number" hidden id="last_updated_by" name="last_updated_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                        <input type="number" hidden id="status " name="status" value="0" class="form-control">
                        <input type="number" hidden id="status " name="je_batch_id" value="<?php echo e(random_int(0, 999999)); ?>" class="form-control">
                        <input type="number" hidden id="status " name="organization_id" value="222" class="form-control">
                    </div>
                    <label class="col-sm-1 control-label" for="input_accdate"><?php echo e(trans('cruds.gl.fields.accdate')); ?></label>
                    <div class="col-sm-2">
                        <input required autocomplete="off" type="text" id="accdate_id" value="<?php echo e(\Carbon\Carbon::now()->format('d-M-Y')); ?>" name="default_effective_date" placeholder="Accounting Date..." class="form-control flatpickr-basic flatpickr-input text-start">
                    </div>
                    <label class="col-sm-1 control-label" for="input_accdate"><?php echo e(trans('cruds.gl.fields.periode')); ?></label>
                    <div class="col-sm-2">
                        <input required autocomplete="off" type="text" id="gl_period" value='<?php echo e(\Carbon\Carbon::now()->format('M-Y')); ?>' name="period_name" placeholder="GL  Periode ...." class="form-control text-start">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label class="col-sm-1 control-label" for="input_reference"><?php echo e(trans('cruds.gl.fields.refrence')); ?></label>
                    <div class="col-sm-5">
                        <input autocomplete="off" type="text" id="reference_id" name="external_reference" class="form-control" value="" placeholder="Reference...">
                    </div>

                    <label class="col-sm-1 control-label" for="input_journaldatefirst"><?php echo e(trans('cruds.gl.fields.journal')); ?></label>
                    <div class="col-sm-2">
                        <select name="je_category" id="je_category" class="form-control select2" required>
                            <?php $__currentLoopData = $trx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($row->trx_source_types); ?>"> <?php echo e($row->trx_source_types); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('trx_source_types')): ?>
                        <em class="invalid-feedback">
                            <?php echo e($errors->first('trx_source_types')); ?>

                        </em>
                        <?php endif; ?>
                    </div>
                    <label class="col-sm-1 control-label" for="input_journaldatescd"><?php echo e(trans('cruds.gl.fields.in')); ?></label>
                    <div class="col-sm-2">
                        <select name="currency_code" id="currency" class="form-control select2" required>
                            <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($row->currency_code); ?>" <?php echo e(old('customer_currency') ? 'selected' : ''); ?>> <?php echo e($row->currency_code); ?> - <?php echo e($row->currency_name); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('customer_currency')): ?>
                        <em class="invalid-feedback">
                            <?php echo e($errors->first('customer_currency')); ?>

                        </em>
                        <?php endif; ?>
                    </div>
                </div>
                <br>
                <div class="card-header">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-journalitems-tab" data-bs-toggle="tab" data-bs-target="#nav-journalitems" type="button" role="tab" aria-controls="nav-journalitems" aria-selected="true">
                                <span class="bs-stepper-box">
                                    <i data-feather="file-text" class="font-medium-3"></i>
                                </span>
                                <?php echo e(trans('cruds.gl.button.jitem')); ?>

                            </button>
                            <button class="nav-link" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab" aria-controls="nav-info" aria-selected="false">
                                <span class="bs-stepper-box">
                                    <i data-feather="info" class="font-medium-3"></i>
                                </span>
                                <?php echo e(trans('cruds.gl.button.info')); ?>

                            </button>
                        </div>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-journalitems" role="tabpanel" aria-labelledby="nav-journalitems-tab">
                            <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                <table id ='gl_table' class="table table-fixed table-borderless">
                                <thead>
                                    <tr>

                                        <th><?php echo e(trans('cruds.gl.fields.account')); ?></th>
                                        <th><?php echo e(trans('cruds.gl.fields.partner')); ?></th>
                                        <th><?php echo e(trans('cruds.gl.fields.label')); ?></th>
                                        <th class="text-end"><?php echo e(trans('cruds.gl.fields.debit')); ?></th>
                                        <th class="text-end"><?php echo e(trans('cruds.gl.fields.credit')); ?></th>
                                        <th class="text-center"><?php echo e(trans('cruds.gl.fields.tax')); ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="jurnal_items_container">
                                    <?php $no = 1; ?>
                                    <?php $subtotal=0; $taxAfter=0; $subtotal2=0; $taxAfter2=0;?>
                                    <tr class="tr_input">
                                        <td width="15%">
                                            <input type="text" class="form-control search_acc" value="" name="accDes[]" id="accDes_1" autocomplete="off" required>
                                            <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1"  autocomplete="off">
                                        </td>
                                        <td width="20%">
                                            <input type="text" class="form-control " value="" name="party_name[]" name="party_name_1" autocomplete="off" >
                                        </td>
                                        <td width="30%">
                                            <input type="text" class="form-control " value="" name="desc[]" id="desc_1" autocomplete="off" >
                                        </td>
                                        <td >
                                            <input type="text" class="form-control text-end debit" value="0.00" name="dr[]" id='dr_1' placeholder="0.00" autocomplete="off" required>
                                        </td>
                                        <td >
                                            <input type="text" class="form-control text-end credit" value="0.00" name="cr[]" id='cr_1' placeholder="0.00" autocomplete="off" required>
                                        </td>
                                        <td >
                                            <select class="form-control pajak"  name="tax[]" id='tax_1' >
                                                <option  value="TAX-00" selected></option>
                                                <option value="TAX-11">TAX11</option>
                                                <option value="TAX-00">TAX00</option>
                                            </select>
                                        </td>
                                        <td class="text-end"  width="0%">

                                            <button type="button" class="btn btn-secondary btn-sm remove_tr_ar" style="position: inherit;">X</button>
                                        </td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="10" >
                                            <button type="button" class="btn btn-outline-danger add_gl_lines btn-sm " style="font-size: 12px;"><i data-feather='plus'></i> <?php echo e(trans('cruds.gl.button.addrow')); ?></button>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="3"></td>
                                        <td class="text-end">
                                            <label id="calculate_debit_label" class="form-control calculate text-end">0000</label>
                                            <input type="hidden" name="running_total_dr" id="calculate_debit" readonly class="form-control calculate_dr float-center text-end" value="00000" autocomplete="off">
                                        </td>
                                        <td class="text-end" >
                                            <label id="calculate_credit_label" class="form-control calculate text-end">0000</label>
                                            <input type="hidden" name="running_total_cr" readonly class="form-control calculate float-center text-end" id="calculate_credit" value="00000"  autocomplete="off">
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">

                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-2 mt-2">
                    <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#actionModal"> <span class="bs-stepper-box">
                            <i data-feather="settings" class="font-medium-3"></i>
                        </span>Actions</button>
                    <button type="button"  class="btn btn-sm btn-primary pull-right" onclick="myFunction()"> <i data-feather="corner-down-right" class="font-medium-3"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
     function myFunction() {
        var dr = document.getElementById('calculate_debit').value;
        var cr = document.getElementById('calculate_credit').value;

        var result=dr-cr;
        if( result != 0 || dr == 0 ){
        Swal.fire('Unbalance Amount Or Value is zero');
         }else {

           $('#verifyDocForm').submit();
         }
    }
$(document).ready(function () {
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/glmanual/create.blade.php ENDPATH**/ ?>