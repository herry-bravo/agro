
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<style>
    .card-body {
        padding-bottom: 0em;
    }

</style>
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
            <form action="<?php echo e(route('admin.salesorder.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">
                            <a href="<?php echo e(route("admin.salesorder.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.OrderManagement.title')); ?> </a>
                            <a href="<?php echo e(route("admin.salesorder.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.OrderManagement.title_singular')); ?> </a>
                            <a href="" class="breadcrumbs__item">Create </a>
                        </h6>
                    </div>
                    <hr>

                    <div class="card-body">
                        <div class="row mb-25">
                            <div class="col-md-12">
                                <div class="row mb-25">
                                    <div class="col-md-4">
                                        <label class="form-label" for="order_number"><?php echo e(trans('cruds.order.fields.order_number')); ?></label>
                                        <input type="text" id="purpose_date" name="purpose_date" class="form-control" hidden value="<?php echo e(now()->format ('Y-m-d')); ?>">
                                        <input type="number" hidden id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                                        <input type="text" id="order_number" name="order_number" class="form-control" value="<?php echo e(old('order_number', isset($order) ? $order->order_number : '')); ?>" readonly>
                                        <?php if($errors->has('order_number')): ?>
                                        <em class="invalid-feedback">
                                            <?php echo e($errors->first('order_number')); ?>

                                        </em>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="currency"><?php echo e(trans('cruds.order.fields.type')); ?></label>
                                        <select type="text" id="type" name="type" class="form-control select2" value="<?php echo e(old('type', isset($order) ? $order->type : '')); ?>" required>
                                            <option value="50" selected>Local Sales</option>
                                            <option value="51">Oversea Sales</option>
                                            <option value="60">Return Local Sales</option>
                                            <option value="61">Return Oversea Sales</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label" for="customer_currency"><?php echo e(trans('cruds.order.fields.customer_currency')); ?></label>
                                        <select name="customer_currency" id="customer_currency" class="form-control select2" required>
                                            <option value='IDR'> IDR - Rupiah</option>
                                            <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($row->currency_code != "IDR"): ?>
                                                    <option value="<?php echo e($row->currency_code); ?>"  <?php echo e(old('customer_currency') == $row->currency_code ? 'selected' : ''); ?>> <?php echo e($row->currency_code); ?> - <?php echo e($row->currency_name); ?> </option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('customer_currency')): ?>
                                        <em class="invalid-feedback">
                                            <?php echo e($errors->first('customer_currency')); ?>

                                        </em>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Faktur</label>
                                        <select name="faktur" id="faktur" class="form-control select2" required>
                                            <option value='01'>01</option>
                                            <option value='07'>07</option>
                                            <option value='080'>080</option>
                                            <option value='03'>03</option>
                                            <option value='011'>011</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="conversion_rate_date" id="conversion_rate_date">
                                    <input type="hidden" name="conversion_rate" id="conversion_rate">
                                    <input type="hidden" name="conversion_type_code" id="conversion_type_code">
                                </div>

                                <div class="row mb-25">
                                    <div class="col-md-4">
                                        <label class="form-label" for="bill_to"><?php echo e(trans('cruds.order.fields.bill_to')); ?></label>
                                        <select name="bill_to" id="bill_to" class="form-control select2" required>
                                            <option hidden disabled selected></option>
                                            <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->cust_party_code); ?>"  <?php echo e(old('bill_to') == $row->cust_party_code ? 'selected' : ''); ?>> <?php echo e($row->party_name); ?> - <?php echo e($row->address1); ?>, <?php echo e($row->city); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('bill_to')): ?>
                                        <em class="invalid-feedback">
                                            <?php echo e($errors->first('bill_to')); ?>

                                        </em>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="sales_order_date"><?php echo e(trans('cruds.order.fields.sales_order_date')); ?></label>
                                        <input type="text" id="datepicker-1" name="ordered_date" class="form-control datepicker" value="<?php echo e(date('d-M-Y')); ?>" required>
                                        <?php if($errors->has('sales_order_date')): ?>
                                        <em class="invalid-feedback">
                                            <?php echo e($errors->first('sales_order_date')); ?>

                                        </em>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="currency"><?php echo e(trans('cruds.order.fields.po_number')); ?></label>
                                        <select name="po_number" id="po_number" class="form-control select2" required>
                                            
                                            <?php $__currentLoopData = $price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($row->id); ?>" <?php echo e(old('price_list_name') ? 'selected' : ''); ?>> <?php echo e($row->description); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('po_number')): ?>
                                        <em class="invalid-feedback">
                                            <?php echo e($errors->first('po_number')); ?>

                                        </em>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mb-25">
                                    <div class="col-md-4">
                                        <label class="form-label" for="ship_to"><?php echo e(trans('cruds.order.fields.ship_to')); ?></label>
                                        <select id="ship_to" name="deliver_to_org_id" class="form-control select2" required>
                                            <?php $__currentLoopData = $site; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($row->site_code); ?>"><?php echo e($row->address1); ?>, <?php echo e($row->city); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                       
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <label class="form-label" for="currency"><?php echo e(trans('cruds.order.fields.terms')); ?></label>
                                        <select name="freight_terms_code" id="terms" class="form-control select2" required>
                                            <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->id); ?>" <?php echo e(old('freight_terms_code') == $row->id ? 'selected' : ''); ?>> <?php echo e($row->term_code); ?> - <?php echo e($row->terms_name); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('terms')): ?>
                                        <em class="invalid-feedback">
                                            <?php echo e($errors->first('terms')); ?>

                                        </em>
                                        <?php endif; ?>
                                    </div> -->
                                    <div class="col-md-2">
                                        <label class="form-label" for="terms_start"><?php echo e(trans('cruds.order.fields.customer_po')); ?></label>
                                        <input autocomplete="off" type="text" id="terms_start" name="cust_po_number" class="form-control" value="<?php echo e(old('terms_start', isset($order) ? $order->terms_start : '')); ?>" required>
                                        <?php if($errors->has('terms_start')): ?>
                                        <em class="invalid-feedback">
                                            <?php echo e($errors->first('terms_start')); ?>

                                        </em>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-2">
                                    <label class="form-label" for="payment_method"><?php echo e(trans('cruds.order.fields.paymentmethod')); ?></label>
                                        <select name="payment_method" id="payment_method" class="form-control select2">
                                                <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($row->id); ?>" <?php echo e(old('price_list_name') ? 'selected' : ''); ?>> <?php echo e($row->terms_name); ?> </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="currency"><?php echo e(trans('cruds.order.fields.tax')); ?></label>
                                        <select name="select_tax" id="select_tax" class="form-control select2">
                                            <option hidden disabled selected></option>
                                            <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($row->tax_rate); ?>" <?php echo e(old('price_list_name') ? 'selected' : ''); ?>> <?php echo e($row->tax_name); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>
                    
                    <div class="card">
                        <div class="card-header">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-sales-tab" data-bs-toggle="tab" data-bs-target="#nav-sales" type="button" role="tab" aria-controls="nav-sales" aria-selected="true">
                                        <span class="bs-stepper-box"> Sales <i data-feather="shopping-bag" class="font-medium-3"></i></span></button>
                                    <!-- <button class="nav-link" id="nav-priceList-tab" data-bs-toggle="tab" data-bs-target="#nav-priceList" type="button" role="tab" aria-controls="nav-priceList" aria-selected="false">
                                        <span class="bs-stepper-box">Price List Detail
                                            <i data-feather="file-text" class="font-medium-3"></i>
                                        </span>
                                    </button>
                                    <button class="nav-link" id="nav-shipment-tab" data-bs-toggle="tab" data-bs-target="#nav-shipment" type="button" role="tab" aria-controls="nav-shipment" aria-selected="false">
                                        <span class="bs-stepper-box">
                                            <i data-feather="truck" class="font-medium-3"></i>
                                        </span>
                                        Shipping
                                    </button> -->
                                </div>
                            </nav>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-sales" role="tabpanel" aria-labelledby="nav-sales-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                        <table class="table table-striped tableFixHead" id="tab_logic">
                                            <thead>
                                                <th width="auto">
                                                </th>
                                                <th scope="col">Line</th>
                                                <th scope="col">Product Category</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Price</th>
                                                
                                                <th scope="col">Disc</th>
                                                <th width="auto" scope="col">Shippement Date</th>
                                                <th scope="col" class="text-end">Unit Price</th>
                                                <th scope="col" class="text-end">Sub. Total</th>
                                                <th scope="col" class="text-center">#</th>
                                                </tr>
                                            </thead>
                                            <tbody class="sales_order_container">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="9">
                                                        <button type="button" class="btn btn-light add_sales_order btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> <?php echo e(trans('cruds.OrderManagement.field.addrow')); ?></button>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="nav-priceList" role="tabpanel" aria-labelledby="nav-priceList-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                        <table class="table table-striped tableFixHead" id="tab_logic">
                                            <thead>
                                                <th scope="col">Line</th>
                                                <th scope="col">Tax</th>
                                                <th scope="col">Document</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Price Effective Date</th>
                                                <th scope="col">Disc.%</th>
                                                <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="sales_order_detail_container">
                                                <tr class="tr_input1">
                                                    <td class="rownumber1" width="2%">1</td>
                                                    <td width="10%">
                                                        <select class="form-control pajak" id="pajak_1" name="tax_code[]" required>
                                                            <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($row->tax_rate); ?>" <?php echo e(old('tax_code') == $row->tax_rate ? 'selected' : ''); ?>><?php echo e($row->tax_code); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <input type="hidden" readonly id="pajak_hasil_1" class="form-control pajak_hasil" name="pajak_hasil[]">
                                                    </td>
                                                    <td width="20%">
                                                        <input type="hidden" class="line_id" name="line_id[]" value="1">
                                                        <input type="text" class="form-control " id="price_list_name_1" name="price_list_name[]" autocomplete="off" required readonly>
                                                        <input type="hidden" class="form-control " id="price_list_id_1" name="price_list_id[]" autocomplete="off" required readonly>
                                                        <input type="hidden" class="form-control" id="price_id_1" name="pricing_attribute1[]" autocomplete="off" required readonly>
                                                    </td>
                                                    <td width="30%"> <input type="number" id="harga2_1" class="form-control harga" readonly></td>
                                                    <td width="20%"><input type="date" id="effective_date_1" name="pricing_date[]" readonly class="form-control "></td>
                                                    <td width="20%">
                                                        <input type="number" id="disc_1" class="form-control disc text-end" name="disc[]" readonly>
                                                    </td>
                                                    <td width="10%">
                                                        <button type="button" class="btn btn-ligth btn-sm" style="position: inherit;">X</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                
                                <div class="tab-pane fade" id="nav-shipment" role="tabpanel" aria-labelledby="nav-shipment-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                        <table class="table table-striped tableFixHead" id="tab_logic">
                                            <thead>
                                                <th scope="col">Line</th>
                                                <th scope="col">UOM</th>
                                                <th scope="col">Sub Inventory</th>
                                                <th scope="col">Packing Style</th>
                                                <th scope="col">Status</th>
                                                <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="sales_order_shipment_container">
                                                <tr class="tr_input">
                                                    <td class="rownumber">1</td>
                                                    <td width=10%>
                                                        <input type="text" readonly id="uom_1" class="form-control uom" name="uom[]">
                                                    </td>
                                                    <td width="30%">
                                                        <input type="hidden" class="line_id" id="line_id_1" name="line_id[]" value="1">
                                                        <input type="text" class="form-control search_subinventory" value="" name="subinventory_from[]" id="subinventoryfrom_1" required>
                                                        <input type="hidden" class="form-control subinvfrom_1" name="shipping_inventory[]" id="subinvfrom_1" autocomplete="off">
                                                    </td>
                                                    <td width="30%">
                                                        <select type="text" class="form-control Select2" id="packingstyle_1" name="packing_style[]">
                                                            <option value="Roll" selected>ROLL</option>
                                                            <option value="Pallet">PALLET</option>
                                                            <option value="Pack">PACK</option>
                                                        </select>
                                                    </td>
                                                    <td width="30%">
                                                        <select class="form-control" id="" name="flow_status[]" required>
                                                            <option value="5" selected>Entered</option>
                                                        </select>
                                                    </td>
                                                    <td width="5%"><button type="button" class="btn btn-ligth btn-sm" style="position: inherit;">X</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 mb-25 ">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label> Status</label>
                                        <input type="text" class="form-control grand_total " value="Enter" name="status_name" readonly="">
                                        <input type="hidden" class="form-control grand_total " name="status_name" value='1' readonly="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Untaxed Amount</label><br>
                                        <input type="text" readonly class="form-control text-end" id="tax_amount" name="tax_amount">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>PPN</label><br>
                                        <input type="text" readonly class="form-control text-end" id="ppn" name="ppn">
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="text" class="form-control purchase_total text-end " id="total_" readonly="" name="purchase_total">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-50 mt-1">
                                <button type="reset" class="btn btn-warning pull-left">Reset</button>
                                <button class="btn btn-primary btn-submit" type="submit"><i data-feather='save'></i>
                                    <?php echo e(trans('global.save')); ?></button>
                            </div>
                        </div>

                        <!-- /.box-body -->
                    </div>
                </div>
        </div>
    </div>
    </div>
    </form>
    </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>

    $(function() {
        $("#datepicker-1").datepicker({
            maxDate: 0
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        , }
    });
    $("#customer_currency").change(function() {
        var curr = $("#customer_currency").val();
        $.ajax({
            url: '<?php echo e(url("search/getRate")); ?>'
            , type: 'POST'
            , data: {
                id: curr
            , }
            , success: function(result) {
                document.getElementById('conversion_rate_date').value = result['rate_date'];
                document.getElementById('conversion_rate').value = result['rate'];
                document.getElementById('conversion_type_code').value = result['currency_id'];
            }

        })
    });
    // $(document).ready(function() {
    //     function formatRibuan(number) {
    //         return number.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    //     }

    //     function calculateSubtotal(row) {
    //         var jumlah = parseFloat($(row).find('.recount').val()) || 0;
    //         var harga = parseFloat($(row).find('.harga').val()) || 0;
    //         var disc = parseFloat($(row).find('.disc').val()) || 0;
    //         var subtotal = jumlah * harga - disc;
    //         $(row).find('.subtotal123').val(formatRibuan(subtotal));
    //     }

    //     // Event handler untuk setiap perubahan pada input yang relevan
    //     $(document).on('input', '.recount, .harga, .disc', function() {
    //         var row = $(this).closest('.tr_input');
    //         calculateSubtotal(row);
    //     });

    //     // Event handler untuk baris baru jika ada
    //     $(document).on('click', '.btn-ligth', function() {
    //         var row = $(this).closest('.tr_input');
    //         row.remove(); // Menghapus baris saat tombol X diklik
    //     });
    // });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/sales/create.blade.php ENDPATH**/ ?>