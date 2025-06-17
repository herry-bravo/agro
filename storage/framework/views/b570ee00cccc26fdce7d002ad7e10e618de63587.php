
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-validation.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header ">
                    <h6 class="card-title">
                        <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.OrderManagement.title')); ?> </a>
                        <a href="<?php echo e(route("admin.shipment.index")); ?>" class="breadcrumbs__item"> <?php echo e(trans('cruds.shiping.title_singular')); ?> </a>
                    </h6>
                    
                </div>
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th><?php echo e(trans('cruds.shiping.modaltable.sonumb')); ?></th>
                                <th><?php echo e(trans('cruds.shiping.modaltable.ponumb')); ?></th>
                                <th><?php echo e(trans('cruds.shiping.modaltable.sales_order')); ?></th>
                                <th><?php echo e(trans('cruds.shiping.modaltable.cs')); ?></th>
                                <th><?php echo e(trans('cruds.shiping.modaltable.suratjalan')); ?></th>
                                <th><?php echo e(trans('cruds.shiping.modaltable.note')); ?></th>
                                
                                
                                <th>Shipment Date</th>
                                <!-- <th><?php echo e(trans('cruds.shiping.modaltable.next_step')); ?></th> -->
                                <!-- <th class="text-start">
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo e(trans('global.action')); ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $deliveryorder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($row->order_number); ?></td>
                                    <td><?php echo e($row->detail->sales->cust_po_number); ?></td>
                                    <td><?php echo e($row->customer->cust_party_code); ?></td>
                                    <td><?php echo e($row->customer->party_name); ?></td>
                                    <td><?php echo e($row->delivery_name); ?></td>
                                    <td><?php echo e($row->attribute2??'-'); ?></td>
                                    <td><?php echo e(date('d-M-Y',strtotime($row->created_at))); ?></td>
                                    <!-- <td><?php echo e($row->status); ?></td> -->
                                    <!-- <td><?php echo e($row->order_number); ?></td> -->
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/sales/shipment.blade.php ENDPATH**/ ?>