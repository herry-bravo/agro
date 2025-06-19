
<?php $__env->startSection('content'); ?>
    <?php $__env->startPush('script'); ?>
        <script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
    <?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <a href="<?php echo e(route('admin.home')); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.OrderManagement.title')); ?></a>
    <a href="<?php echo e(route('admin.deliveries.index')); ?>"
        class="breadcrumbs__item"><?php echo e(trans('cruds.Delivery.title_singular')); ?></a>
    <a href="#" class="breadcrumbs__item"><?php echo e(trans('cruds.Delivery.fields.fullfillment')); ?></a>
<?php $__env->stopSection(); ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-2"><?php echo e(trans('cruds.Delivery.fields.fullfillment')); ?></h4>
    </div>
    <form id="formship"
        action="<?php echo e(route('admin.deliveries.update', $DeliveryHeader->id, $DeliveryHeader->delivery_id)); ?>" method="POST"
        enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="card-body">
            <div class="form-group">
                <div class="form-group row">
                    <div class="col-md-3">
                        <div class="mb-2">
                            <label class="form-label" for="segment1"><?php echo e(trans('cruds.Delivery.table.cname')); ?></label>
                            <select disabled type="text" id="customer" name="customer" class="form-control select2"
                                value="<?php echo e($DeliveryHeader->sold_to_party_id); ?>" required>
                                <option value="<?php echo e($DeliveryHeader->id); ?>"><?php echo e($DeliveryHeader->cust_party_code); ?>

                                    -<?php echo e($DeliveryHeader->party_name); ?> </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1"><?php echo e(trans('cruds.Delivery.table.shipto')); ?></label>
                            <select disabled type="text" id="customer_shipto" name="customer_shipto"
                                class="form-control select2" value="<?php echo e($DeliveryHeader->ship_to_party_id); ?>" required>
                                 <?php $__currentLoopData = $customershiipto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($row->site_code); ?>" <?php echo e($DeliveryHeader->ship_to_party_id == $row->site_code ? 'selected' : ''); ?>>
                                        <?php echo e($row->address1); ?> / <?php echo e($row->address2); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1"><?php echo e(trans('cruds.shiping.fields.note')); ?></label>
                            <input readonly autocomplete="off" required type="text" id="note" name="note"
                                class="form-control" value="<?php echo e($DeliveryHeader->attribute2); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-1">
                            <label class="form-label" for="segment1"><?php echo e(trans('cruds.Delivery.table.dt')); ?></label>
                            
                             <input readonly type="text" id="datepicker-1" name="invoice_date" value="<?php echo e($DeliveryHeader->on_or_about_date->format('d-M-Y')); ?>" class="form-control datepicker text-end" autocomplete="off" required>

                        </div>
                    </div>

                    


                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1"><?php echo e(trans('cruds.Delivery.fields.sj')); ?></label>
                            <input readonly required id="invoice_no" name="invoice_no" class="form-control"
                                value="<?php echo e($DeliveryHeader->packing_slip_number); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1"><?php echo e(trans('cruds.Delivery.table.no_barang')); ?></label>
                            <input readonly="readonly" id="delivery_name" name="delivery_name" class="form-control"
                                value="<?php echo e($DeliveryHeader->delivery_id); ?>">
                            <input type="hidden" id="id" name="id" value="<?php echo e($DeliveryHeader->id); ?>">
                            <input type="hidden" id="delivery_id" name="delivery_id"
                                value="<?php echo e($DeliveryHeader->delivery_id); ?>">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1"><?php echo e(trans('cruds.shiping.fields.freight_term')); ?></label>
                            <select disabled type="text" id="freight_term" name="freight_term"
                                class="form-control select2" value="<?php echo e($DeliveryHeader->freight_terms_code); ?>"
                                required>
                                <?php $__currentLoopData = $freight_terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        value="<?php echo e($row->id); ?>"<?php echo e($DeliveryHeader->freight_terms_code == $row->id ? 'selected' : ''); ?>>
                                        <?php echo e($row->terms_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1"><?php echo e(trans('cruds.Delivery.table.status')); ?></label>
                            <select disabled type="text" id="status" name="status" class="form-control select2"
                                value="<?php echo e($DeliveryHeader->status_code); ?>" required>
                                <option value="<?php echo e($DeliveryHeader->status_code); ?>}"><?php echo e($DeliveryHeader->trx_name); ?>

                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1"><?php echo e(trans('cruds.Delivery.fields.acepdet')); ?></label>
                            <input autocomplete="off" type="text" id="fp-default" name="accepted_date"  class="form-control flatpickr-basic flatpickr-input" required>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="row mb-4">
                <div class="box box-default overflow-auto">
                    <div class="box-body" style="height: 350px;">
                        <table class="table table-bordered table-striped table-hover" id="detailitem">
                            <thead>
                                <tr>
                                    <th >
                                        <input class="form-check-input" type="checkbox" style="width:1%px;"
                                            value="" id="masterckcbx" />
                                    </th>
                                    <th>NO</th>
                                    <th><?php echo e(trans('cruds.shiping.table.sn')); ?></th>
                                    <th><?php echo e(trans('cruds.shiping.table.item_no')); ?></th>
                                    <th><?php echo e(trans('cruds.shiping.table.item_desc')); ?></th>
                                    <th class="text-center" ><?php echo e(trans('cruds.shiping.modaltable.line')); ?></th>
                                    <th class="text-center"> <?php echo e(trans('cruds.shiping.table.request_qty')); ?></th>
                                    <!-- <th class="text-center"> <?php echo e(trans('cruds.shiping.table.ship_qty')); ?></th> -->
                                    <th class="text-center"><?php echo e(trans('cruds.shiping.table.uom')); ?></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $DeliveryDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($row->delivery_detail_id == $DeliveryHeader->delivery_id): ?>
                                        <tr>
                                            <td style="width: 0%">
                                                <input type="checkbox"name="ids[]" value="<?php echo e($row->id); ?>"
                                                    class="form-check-input sub_chk" data-id="<?php echo e($row->id); ?>">
                                                <input type="hidden" name="header[]"
                                                    value="<?php echo e($row->source_header_id); ?>"
                                                    class="form-check-input sub_chk"data-id="<?php echo e($row->source_header_id); ?>">
                                                <input type="hidden" name="line[]"
                                                    value="<?php echo e($row->source_line_id); ?>"class="form-check-input sub_chk"data-id="<?php echo e($row->source_line_id); ?>">
                                                <input type="hidden" name="checkid[]" value="<?php echo e($row->id); ?>">
                                                <input type="hidden" name="inventory_item_id[]" value="<?php echo e($row->inventory_item_id); ?>">
                                                <input type="hidden" name="subinventory[]" value="<?php echo e($row->subinventory); ?>">
                                                <input type="hidden" name="qty[]" value="<?php echo e($row->requested_quantity); ?>">

                                            </td>
                                            <td><?php echo e($no++); ?></td>
                                            <td><?php echo e($row->source_header_number ?? ''); ?></td>
                                            <td><?php echo e($row->item_code ?? ''); ?></td>
                                            <td><?php echo e($row->item_description ?? ''); ?></td>
                                            <td class="text-center"><?php echo e((float)$row->source_line_id ?? ''); ?></td>
                                            <td class="text-center"><?php echo e((float)$row->requested_quantity ?? ''); ?></td>
                                            <!-- <td class="text-center" > <input type="number" name="fulfilled_quantity[]" min=1  oninput="validity.valid||(value='');" class="form-control text-center w-50 " style="background-color: #dcfdf2;"
                                                    value="<?php echo e($row->shipped_quantity ?? ''); ?>"></td> -->
                                            <td style="width: 15%" class="text-center"><?php echo e($row->requested_quantity_uom ?? ''); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-1">
                <div></div>
                <?php if($DeliveryHeader->status_code==8): ?>
                    <button class="btn btn-primary btn-submit add_all"name='action' value="fullfillment" id="add_all"
                    type="submit"><i data-feather='save'></i> <?php echo e(trans('global.save')); ?></button>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $(document).ready(function() {
        $('#detailitem').DataTable({
            paging:false,
            dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-8'i><'col-sm-4'p>>",
        });

        $('#masterckcbx').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });

        $('.add_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            console.log(allVals);
            if (allVals.length <= 0) {
                alert("Please select row.");

            } else {
                var check = alert("Add Row Success");
                if (check == true) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'idss='+join_selected_values,
                        success: function(data) {
                            // alert(data['success']);
                        },
                        error: function(data) {
                            // alert(data.responseText);
                        }
                    });
                }
            }
        });
        $(document).on('confirm', function(e) {
            var ele = e.target;
            e.preventDefault();
            $.ajax({
                url: ele.href,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function(data) {
                    alert(data.responseText);
                }
            });
            return false;
        });
        ///////////// RESET BUTTON//////////////
        $(".resetbtn").click(function() {
            $("#formship").trigger("reset");
        });
        ///////////// RESET BUTTON//////////////
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/deliveries/edit.blade.php ENDPATH**/ ?>