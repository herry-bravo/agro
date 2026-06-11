<?php $__env->startSection('content'); ?>
<section id="konfirmasi-kirim">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-12">

            <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <div class="card" style="border-left: 4px solid #0d6efd;">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <h6 class="mb-0">Shipment Confirmation</h6>
                    <a href="<?php echo e(route('admin.salesorder.show', $sales->id)); ?>" class="btn btn-sm btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>

                <div class="card-body pb-2">
                    
                    <div class="row mb-3" style="font-size:13px;">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless mb-0">
                                <tr><td class="fw-bold" style="width:130px">SO Number</td><td>: <?php echo e($sales->order_number); ?></td></tr>
                                <tr><td class="fw-bold">Customer</td><td>: <?php echo e(optional($sales->customer)->party_name ?? 'Walk-in Customer'); ?></td></tr>
                                <tr><td class="fw-bold">SO Date</td><td>: <?php echo e($sales->ordered_date); ?></td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless mb-0">
                                <tr><td class="fw-bold" style="width:130px">Ship To</td><td>: <?php echo e(optional($sales->party_site)->id ?? '-'); ?></td></tr>
                                <tr><td class="fw-bold">Payment Term</td><td>: <?php echo e(is_numeric($sales->attribute3) ? (optional($sales->term)->terms_name ?? '-') : '-'); ?></td></tr>
                            </table>
                        </div>
                    </div>

                    <form action="<?php echo e(route('admin.salesorder.proses-kirim')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="sales_id" value="<?php echo e($sales->id); ?>">

                        
                        <div class="table-responsive mb-3">
                            <table class="table table-sm table-bordered" style="font-size:13px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th class="text-center">Order Qty</th>
                                        <th class="text-center">Ship Qty</th>
                                        <th>UOM</th>
                                        <th>Warehouse</th>
                                        <th class="text-center">Available Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php echo e($key + 1); ?>

                                            <input type="hidden" name="line_id[<?php echo e($key); ?>]" value="<?php echo e($line->id); ?>">
                                            <input type="hidden" name="qty[<?php echo e($key); ?>]" value="<?php echo e($line->ordered_quantity); ?>">
                                        </td>
                                        <td><?php echo e($line->user_description_item); ?></td>
                                        <td class="text-center"><?php echo e(number_format($line->ordered_quantity, 0, ',', '.')); ?></td>
                                        <td class="text-center" style="width:90px">
                                            <span class="fw-bold"><?php echo e(number_format($line->ordered_quantity, 0, ',', '.')); ?></span>
                                        </td>
                                        <td><?php echo e($line->order_quantity_uom); ?></td>
                                        <td style="min-width:140px">
                                            <span class="fw-bold small"><?php echo e($line->shipping_inventory ?? '-'); ?></span>
                                            <input type="hidden" name="warehouse[<?php echo e($key); ?>]" value="<?php echo e($line->shipping_inventory); ?>">
                                            <?php if(!$line->shipping_inventory): ?>
                                                <div class="text-danger" style="font-size:11px">
                                                    <i class="fa fa-exclamation-triangle"></i> Warehouse belum di-set
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <?php $oh = $stock[$line->id] ?? null; ?>
                                        <td class="text-center" style="width:100px; font-size:12px; color:#555;">
                                            <?php if($oh): ?>
                                                <?php echo e(number_format($oh->primary_transaction_quantity, 0, ',', '.')); ?>

                                                <?php echo e($line->order_quantity_uom); ?>

                                                <?php if($oh->primary_transaction_quantity < $line->ordered_quantity): ?>
                                                    <div class="text-danger" style="font-size:11px; font-weight:bold;">Stok kurang!</div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-danger">-</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        
                        <div class="card mb-3" style="display:none; border-left: 4px solid #0d6efd; font-size:13px;">
                            <div class="card-header py-2">
                                <h6 class="mb-0 fw-bold">Invoice Details</h6>
                            </div>
                            <div class="card-body py-2">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Invoice Date</label>
                                        <input type="date" name="tgl_invoice" class="form-control form-control-sm"
                                               value="<?php echo e(date('Y-m-d')); ?>" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Faktur</label>
                                        <select name="faktur_code" class="form-select form-select-sm">
                                            <option value="">-- Pilih Faktur --</option>
                                            <?php $__currentLoopData = $fakturs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($f->faktur_code); ?>" <?php if($loop->first): ?> selected <?php endif; ?>><?php echo e($f->faktur_code); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($fakturs->isEmpty()): ?>
                                            <div class="text-danger mt-1" style="font-size:11px">
                                                <i class="fa fa-exclamation-triangle"></i> Tidak ada faktur tersedia
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Invoice Number</label>
                                        <input type="text" class="form-control form-control-sm bg-light" readonly
                                               value="INV-<?php echo e($sales->order_number); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="row align-items-end g-3">
                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Ship Date</label>
                                <input type="date" name="ship_date" class="form-control form-control-sm"
                                       value="<?php echo e(date('Y-m-d')); ?>" required>
                            </div>
                            <div class="col-md-4 d-flex align-items-center" style="padding-top:22px">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="buat_sj" id="buat_sj" value="1">
                                    <label class="form-check-label small fw-bold" for="buat_sj">
                                        Create Delivery Order
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5 text-end">
                                <a href="<?php echo e(route('admin.salesorder.show', $sales->id)); ?>" class="btn btn-sm btn-secondary me-1">Cancel</a>
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-send me-50">
                                        <line x1="22" y1="2" x2="11" y2="13"></line>
                                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                    </svg></span>
                                    Process Shipment
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro\resources\views/admin/sales/konfirmasi-kirim.blade.php ENDPATH**/ ?>