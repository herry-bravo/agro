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

            <div class="card" style="border-left: 4px solid #28a745;">
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
                                        <td style="min-width:160px">
                                            <?php if(isset($stock[$line->inventory_item_id]) && $stock[$line->inventory_item_id]->count() > 0): ?>
                                            <select name="warehouse[<?php echo e($key); ?>]" class="form-select form-select-sm warehouse-select" data-key="<?php echo e($key); ?>" required>
                                                <?php $__currentLoopData = $stock[$line->inventory_item_id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($oh->subinventory_code); ?>"
                                                        data-qty="<?php echo e($oh->primary_transaction_quantity); ?>"
                                                        <?php echo e($line->shipping_inventory == $oh->subinventory_code ? 'selected' : ''); ?>>
                                                    <?php echo e($oh->subinventory_code); ?> (<?php echo e(number_format($oh->primary_transaction_quantity, 0, ',', '.')); ?>)
                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php else: ?>
                                            <span class="text-danger small"><i class="fa fa-exclamation-triangle"></i> No stock available</span>
                                            <input type="hidden" name="warehouse[<?php echo e($key); ?>]" value="">
                                            <?php endif; ?>
                                        </td>
                                        <?php
                                            $selectedStock = null;
                                            if (isset($stock[$line->inventory_item_id])) {
                                                $selectedStock = $stock[$line->inventory_item_id]
                                                    ->firstWhere('subinventory_code', $line->shipping_inventory)
                                                    ?? $stock[$line->inventory_item_id]->first();
                                            }
                                        ?>
                                        <td class="text-center stok-display-<?php echo e($key); ?>" style="width:100px; font-size:12px; color:#555;">
                                            <?php if($selectedStock): ?>
                                                <?php echo e(number_format($selectedStock->primary_transaction_quantity, 0, ',', '.')); ?>

                                                <?php echo e($line->order_quantity_uom); ?>

                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
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
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fa fa-check"></i> Process Shipment
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

<?php $__env->startPush('script'); ?>
<script>
document.querySelectorAll('.warehouse-select').forEach(function(sel) {
    sel.addEventListener('change', function() {
        var key  = this.dataset.key;
        var opt  = this.options[this.selectedIndex];
        var qty  = opt ? opt.dataset.qty : '-';
        var cell = document.querySelector('.stok-display-' + key);
        if (cell) cell.textContent = qty ? Number(qty).toLocaleString('id') + ' ' + cell.dataset.uom : '-';
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro\resources\views/admin/sales/konfirmasi-kirim.blade.php ENDPATH**/ ?>