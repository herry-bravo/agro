
<?php $__env->startSection('content'); ?>
    <?php $__env->startPush('script'); ?>
        <script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <a href="<?php echo e(route('admin.gl.index')); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.gl.fields.accrcv')); ?></a>
    <a href="<?php echo e(route('admin.gl.index')); ?>" class="breadcrumbs__item">Journal Entries</a>
    <a href="<?php echo e(route('admin.gl.edit', $data->je_header_id)); ?>" class="breadcrumbs__item active" aria-current="page">Edit</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header mt-2 mb-25">
            <h6 class="card-title">
                <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.gl.title')); ?> </a>
                <a href="javascript:history.go(-1)" class="breadcrumbs__item"> Journal Entries </a>
                <a href="<?php echo e(route("admin.gl.create")); ?>" class="breadcrumbs__item"> Edit </a>
            </h6>
        </div>
        <hr>
        </br>
        <!-- <div class="card-header">
            <h4 class="card-title mb-2">Journal <?php echo e($data->je_header_id); ?></h4>
            <nav class="breadcrumbs" style=" border: 0px solid #f1f2f0;">
                <?php if($data->posted == 1): ?>
                    <a class="breadcrumbs__item">Draft</a>
                    <a class="breadcrumbs__item active">Post</a>
                <?php else: ?>
                    <a class="breadcrumbs__item active">Draft</a>
                    <a class="breadcrumbs__item">Post</a>
                <?php endif; ?>
            </nav>
        </div> -->
        <br>
        <div class="card-body">
            <form action="<?php echo e(route('admin.gl.update', $data->je_header_id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="form-group row">
                    <label class="col-sm-1 control-label"
                        for="input_replaceinv"><?php echo e(trans('cruds.gl.fields.replaceinvoice')); ?></label>
                    <div class="col-sm-5">
                        <input autocomplete="off" type="text" id="replaceinv_id" name="name" class="form-control"
                            value="<?php echo e($data->name ?? ''); ?>" placeholder=" Name ...">
                        <input type="number" hidden id="last_updated_by" name="last_updated_by"
                            value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                        <input type="number" hidden id="je_source" name="je_source" value="Entry" class="form-control">
                        <input type="number" hidden id="status " name="status" value="0" class="form-control">
                    </div>
                    <label class="col-sm-1 control-label"
                        for="input_accdate"><?php echo e(trans('cruds.gl.fields.accdate')); ?></label>
                    <div class="col-sm-2">
                        <input required autocomplete="off" type="text" id="accdate_id"
                            value="<?php echo e($data->default_effective_date->format('Y-m-d') ?? ''); ?>"
                            name="default_effective_date" placeholder="Accounting Date..."
                            class="form-control flatpickr-basic flatpickr-input text-start">
                    </div>
                    <label class="col-sm-1 control-label"
                        for="input_accdate"><?php echo e(trans('cruds.gl.fields.periode')); ?></label>
                    <div class="col-sm-2">
                        <input required autocomplete="off" type="text" id="gl_period"
                            value='<?php echo e($data->period_name ?? ''); ?>' name="period_name" placeholder="GL  Periode ...."
                            class="form-control text-start">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label class="col-sm-1 control-label"
                        for="input_reference"><?php echo e(trans('cruds.gl.fields.refrence')); ?></label>
                    <div class="col-sm-5">
                        <input autocomplete="off" type="text" id="reference_id" name="external_reference"
                            class="form-control" value="<?php echo e($data->external_reference ?? ''); ?>" placeholder="Reference...">
                    </div>

                    <label class="col-sm-1 control-label"
                        for="input_journaldatefirst"><?php echo e(trans('cruds.gl.fields.journal')); ?></label>
                    <div class="col-sm-2">
                        <select name="je_category" id="je_category" class="form-control select2">

                            <?php $__currentLoopData = $trx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($data->je_category == $row->trx_source_types): ?>
                                    <option value="<?php echo e($data->je_category); ?>" <?php echo e('selected'); ?>>
                                        <?php echo e($data->je_category); ?> </option>
                                <?php else: ?>
                                    <option value="<?php echo e($row->trx_source_types); ?>"> <?php echo e($row->trx_source_types); ?> </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('trx_source_types')): ?>
                            <em class="invalid-feedback">
                                <?php echo e($errors->first('trx_source_types')); ?>

                            </em>
                        <?php endif; ?>
                    </div>
                    <label class="col-sm-1 control-label"
                        for="input_journaldatescd"><?php echo e(trans('cruds.gl.fields.in')); ?></label>
                    <div class="col-sm-2">
                        <select name="currency_code" id="currency" class="form-control select2">
                            <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($data->currency_code == $row->currency_code): ?>
                                    <option value="<?php echo e($data->currency_code); ?>" <?php echo e('selected'); ?>>
                                        <?php echo e($data->currency_code); ?></option>
                                <?php else: ?>
                                    <option value="<?php echo e($row->currency_code); ?>"> <?php echo e($row->currency_code); ?> -
                                        <?php echo e($row->currency_name); ?> </option>
                                <?php endif; ?>
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
                            <button class="nav-link active" id="nav-journalitems-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-journalitems" type="button" role="tab"
                                aria-controls="nav-journalitems" aria-selected="true">
                                <span class="bs-stepper-box">
                                    <i data-feather="file-text" class="font-medium-3"></i>
                                </span>
                                <?php echo e(trans('cruds.gl.button.jitem')); ?>

                            </button>
                            <button class="nav-link" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info"
                                type="button" role="tab" aria-controls="nav-info" aria-selected="false">
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
                        <div class="tab-pane fade show active" id="nav-journalitems" role="tabpanel"
                            aria-labelledby="nav-journalitems-tab">
                            <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                <table class="table table-fixed table-borderless">
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
                                        <?php
                                            $subtotal = 0;
                                            $taxAfter = 0;
                                            $subtotal2 = 0;
                                            $taxAfter2 = 0;
                                        ?>
                                        <?php $__currentLoopData = $data_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="tr_input">
                                                <td width="15%">
                                                    <input type="hidden" name="je_line_number[]"
                                                        value="<?php echo e($row->je_line_num); ?>" class="form-control datepicker"
                                                        id="line_<?php echo e($key + 1); ?>" autocomplete="off">
                                                    <input type="text" class="form-control search_acc"
                                                        value="<?php echo e($row->code_combination_id); ?> - <?php echo e($row->coa->description ?? ''); ?>"
                                                        name="accDes_[]" id="accDes_<?php echo e($key + 1); ?>"
                                                        autocomplete="off" required>
                                                    <input type="hidden" name="code_combinations[]"
                                                        value="<?php echo e($row->code_combination_id); ?>"
                                                        class="form-control datepicker" id="acc_<?php echo e($key + 1); ?>"
                                                        autocomplete="off">

                                                </td>
                                                <td width="20%">
                                                    <input type="text" class="form-control "
                                                        value="<?php echo e($row->reference_1 ?? ' '); ?>" name="party_name[]"
                                                        name="party_name_<?php echo e($key + 1); ?>" autocomplete="off">
                                                </td>
                                                <td width="30%">
                                                    <input type="text" class="form-control "
                                                        value="<?php echo e($row->description ?? ''); ?>" name="desc[]"
                                                        id="desc_<?php echo e($key + 1); ?>" autocomplete="off">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control text-end debit"
                                                        value="<?php echo e($row->entered_dr); ?>" name="dr[]"
                                                        id='dr_<?php echo e($key + 1); ?>' placeholder="0.00"
                                                        autocomplete="off" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control text-end credit"
                                                        value="<?php echo e($row->entered_cr); ?>" name="cr[]"
                                                        id='cr_<?php echo e($key + 1); ?>' placeholder="0.00"
                                                        autocomplete="off" required>
                                                </td>
                                                <td>
                                                    <select class="form-control pajak" name="tax[]"
                                                        id='tax_<?php echo e($key + 1); ?>' required>
                                                        <?php if($row->tax_code == 'TAX11'): ?>
                                                            <option value="TAX-11" selected>TAX11</option>
                                                            <option value="TAX-00">TAX00</option>
                                                        <?php else: ?>
                                                            <option value="TAX-00" selected>TAX00</option>
                                                            <option value="TAX-11">TAX11</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </td>
                                                <td class="text-end" width="0%">
                                                    <button type="button" class="btn btn-secondary btn-sm remove_tr_ar"
                                                        style="position: inherit;">X</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="10">
                                                <button type="button" class="btn btn-outline-danger add_gl_lines btn-sm "
                                                    style="font-size: 12px;"><i data-feather='plus'></i>
                                                    <?php echo e(trans('cruds.gl.button.addrow')); ?></button>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td colspan="3"></td>
                                            <td class="text-end">
                                                <label id="calculate_debit_label"
                                                    class="form-control calculate text-end"><?php echo e($data->running_total_dr ?? ''); ?></label>
                                                <input type="hidden" name="running_total_dr" id="calculate_debit"
                                                    readonly class="form-control calculate float-center text-end"
                                                    value="<?php echo e($data->running_total_dr ?? ''); ?>" autocomplete="off">
                                            </td>
                                            <td class="text-end">
                                                <label id="calculate_credit_label"
                                                    class="form-control calculate text-end"><?php echo e($data->running_total_cr ?? ''); ?></label>
                                                <input type="hidden" name="running_total_cr" readonly
                                                    class="form-control calculate float-center text-end"
                                                    id="calculate_credit" value="<?php echo e($data->running_total_cr ?? ''); ?>"
                                                    autocomplete="off">
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
                <div class="d-flex justify-content-between mt-2 mb-2">
                    <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal"
                        data-bs-target="#actionModal"> <span class="bs-stepper-box">
                            <i data-feather="settings" class="font-medium-3"></i>
                        </span>Action</button>
                    <button type="submit" class="btn btn-sm btn-primary pull-right" name='action' value="submit"> <i data-feather="corner-down-right"
                            class="font-medium-3"></i> Submit</button>
                </div>

                <div class="modal fade" id="actionModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Options</h5>
                                <button type="button" class="close border-0" data-bs-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true">X</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <?php if($data->posted == NULL): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flex" value="1"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Posted
                                        </label>
                                    </div>
                                    <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flex"
                                            id="flexRadioDefault1" value="0" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Drafted
                                        </label>
                                    </div>
                                    <?php else: ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flex" value="1"
                                            id="flexRadioDefault2" disabled checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Posted
                                        </label>
                                    </div>
                                    <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flex"
                                            id="flexRadioDefault1" value="0" disabled>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Drafted
                                        </label>
                                    </div>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" name='action' value="status"
                                    class="btn btn-sm btn-primary check">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        //  function myFunction() {
        //     var dr = document.getElementById('calculate_debit').value;
        //     var cr = document.getElementById('calculate_credit').value;
        //     var result=dr-cr;
        //     if( result != 0 || dr == 0 ){
        //     Swal.fire('Unbalance Amount Or Value is zero');
        //      }else {

        //        $('#verifyDocForm').submit();
        //      }
        // }
        // $(document).on('keyup','.debit', function(){
        //     var dr_ = document.getElementById('valueDr').value;

        //     var subtotals = document.getElementsByClassName("debit");
        //     subtotal=[];
        //     for(var i=0; i<subtotals.length;++i){
        //         var b = subtotals[i].getAttribute("id");
        //         var split_id = b.split('_');
        //         var index = Number(split_id[1]);
        //         var total = 0
        //         var data = $("#dr_"+index).val();
        //         subtotal.push({
        //             data: data
        //         });
        //     }
        //     for(var i=0; i<subtotal.length;++i){
        //         total += parseInt(subtotal[i].data);
        //     }
        //     var label_dr=total+dr_;
        //     document.getElementById('calculate_debit').value = total+dr_;
        //     document.getElementById('calculate_debit_label').innerHTML = label_dr.toLocaleString("en-US");
        // });

        // $(document).on('keyup','.credit', function(){
        //     var cr_ = document.getElementById('valueCr').value;
        //     var lines = document.getElementsByClassName("credit");
        //     line=[];
        //     for(var i=0; i<lines.length;++i){
        //         var b = lines[i].getAttribute("id");
        //         var split_id = b.split('_');
        //         var index = Number(split_id[1]);
        //         var total_cr = 0
        //         var rows = $("#cr_"+index).val();
        //         line.push({
        //             rows: rows
        //         });
        //     }
        //     for(var i=0; i<line.length;++i){
        //         total_cr += parseInt(line[i].rows);
        //     }
        //     var label_cr=total_cr+cr_;
        //     document.getElementById('calculate_credit').value = total_cr+;
        //     document.getElementById('calculate_credit_label').innerHTML =label_cr.toLocaleString("en-US");
        // });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro\resources\views/admin/glmanual/edit.blade.php ENDPATH**/ ?>