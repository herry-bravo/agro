<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h6 class="card-title mt-2 mb-25">
            <a href="<?php echo e(route("admin.currencies.index")); ?>" class="breadcrumbs__item">Currency </a>
            <a href="#" class="breadcrumbs__item"> <?php echo e(trans('cruds.currency.fields.edit')); ?></a>
        </h6>
    </div>
    <hr>
    <div class="card-body">
        <form action="<?php echo e(route("admin.currencies.update",$currency->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                <label for="name"><?php echo e(trans('cruds.currency.fields.name')); ?>*</label>
                <input type="text" id="name" name="currency_name" class="form-control" value="<?php echo e(old('name', isset($currency) ? $currency->currency_name : '')); ?>" required>
                <?php if($errors->has('name')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('name')); ?>

                </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.currency.fields.name_helper')); ?>

                </p>
            </div>
            <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
                <label for="code"><?php echo e(trans('cruds.currency.fields.code')); ?>*</label>
                <input type="text" id="code" name="currency_code" class="form-control" value="<?php echo e(old('code', isset($currency) ? $currency->currency_code : '')); ?>" required>
                <?php if($errors->has('code')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('code')); ?>

                </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.currency.fields.code_helper')); ?>

                </p>
            </div>
            <div class="form-group <?php echo e($errors->has('main_currency') ? 'has-error' : ''); ?>">
                <label for="main_currency"><?php echo e(trans('cruds.currency.fields.main_currency')); ?></label>
                <input name="currency_status" type="hidden" value="0">
                <input value="<?php echo e($currency->currency_status ??  ''); ?>" type="checkbox" id="main_currency" name="currency_status" <?php echo e((isset($currency) && $currency->currency_status) || old('currency_status', 0) === 1 ? 'checked' : ''); ?>>
                <?php if($errors->has('currency_status')): ?>
                <p class="help-block">
                    <?php echo e($errors->first('currency_status')); ?>

                </p>
                <?php endif; ?>
                <p class="helper-block">
                    <?php echo e(trans('cruds.currency.fields.main_currency_helper')); ?>

                </p>
            </div>

            <div class="box box-default">
                <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                    <table class="table table-fixed table-borderless w-100">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Company</th>
                                <th class='text-end'>Unit Per IDR</th>
                                <th class='text-end'>IDR Per Unit</th>
                                <th class='text-center'>#</th>
                            </tr>
                        </thead>
                        <tbody class="rate_container">
                            <?php $__currentLoopData = $rate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="tr_input">
                                <td width="30%">
                                    <input type="date" class="form-control search_purchase_item" placeholder="Type here ..." name="rate_date[]" id="rateid_<?php echo e($key+1); ?>" value="<?php echo e($row->rate_date); ?>" autocomplete="off">
                                    <span class="help-block search_item_code_empty" style="display: none;">No Results Found ..</span>
                                    <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>">
                                    <input type="hidden" id="id_<?php echo e($key+1); ?>" name="id[]" value="<?php echo e($row->id); ?>">
                                </td>
                                <td width="30%">
                                    <input type="text" class="form-control " name="company" id="company" value="NEXZO-APP" readonly autocomplete="off">
                                    <input type="hidden" class="form-control " name="org_id[]" id="orgid_<?php echo e($key+1); ?>" value="<?php echo e($row->org_id); ?>" autocomplete="off">
                                    <span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                </td>
                                <td width="20%">
                                    <input type="text" class="form-control text-end" name="rate[]" id="rate_<?php echo e($key+1); ?>" value="<?php echo e($row->rate); ?>" autocomplete="off">
                                    <span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                </td>
                                <td width="20%">
                                    <input type="text" class="form-control purchase_quantity  text-end" value="<?php echo e(number_format(1/$row->rate,10,",",".")); ?>" name="rete_curr[]" id="retecurr_<?php echo e($key+1); ?>" autocomplete="off" required>
                                </td>
                                <td width="auto">
                                    <button type="button" class="btn btn-ligth btn-sm" style="position: inherit;">X</button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <button type="button" class="btn btn-ligth add_rate" style="font-size: 12px;"><i data-feather='plus'></i> Add a Line</button>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-1 mb-1">
                <button type="submit" class="btn btn-primary btn-next">
                    <span class="align-middle d-sm-inline-block d-none"><?php echo e(trans('global.save')); ?></span>
                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                </button>
            </div>
    </div>
    <div>
    </div>
    </form>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        , }
    });


    $(document).ready(function() {
        $(document).on('click', '.remove_tr', function() {
            $(this).closest('tr').remove();
        });
        $(document).on('click', '.add_rate', function() {
            var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
            var split_id = lastname_id.split('_');
            var index = Number(split_id[1]) + 1;
            $('.rate_container').append('<tr class="tr_input">\
                                <td width="30%">\
                                    <input type="date" class="form-control search_purchase_item" placeholder="Type here ..." name="rate_date[]" id="rateid_' + index + '" value="" autocomplete="off" >\
                                    <input type="hidden" id="created_by" name="created_by" value="<?php echo auth()->user()->id ?>">\
                                    <input type="hidden" id="id_' + index + '" name="id[]" value="">\
                                </td>\
                                <td width="30%">\
                                    <input type="text" class="form-control " name="company" id="company" value="NEXZO-APP" readonly autocomplete="off">\
                                    <input type="hidden" class="form-control " name="org_id[]" id="orgid_' + index + '" value="<?php echo auth()->user()->org_id ?>" autocomplete="off">\
                                </td>\
                                <td width="20%">\
                                    <input type="text" class="form-control text-end" name="rate[]"  id="rate_' + index + '" value="" autocomplete="off">\
                                </td>\
                                <td width="20%">\
                                    <input type="text" class="form-control purchase_quantity  text-end" value="" name="rete_curr[]" id="retecurr_' + index + '"  autocomplete="off" required>\
                                </td>\
                                <td width="auto">\
                                    <button type="button" class="btn btn-ligth btn-sm remove_tr" style="position: inherit;">X</button>\
                                </td></tr>');
        });
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/currencies/edit.blade.php ENDPATH**/ ?>