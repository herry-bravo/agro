<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<!-- <script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script> -->
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header mt-1 mb-25">
                <h6 class="card-title">
                    <a href="<?php echo e(route("admin.return.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.po')); ?> </a>
                    <a href="<?php echo e(route("admin.return.index")); ?>" class="breadcrumbs__item">Create</a>
                </h6>
            </div>
            <hr>
            <div class="card-body">
                <form action="<?php echo e(route("admin.return.store")); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal create_purchase">
                    <?php echo e(csrf_field()); ?>

                    <div class="row mt-2 mb-1">
                        <div class="col-md-3">
                            <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.return.fields.transactiondate')); ?></label>
                            <input type="date" id="datePicker" name="gl_date" class="form-control datepicker" value="" required>
                            <input type="hidden" hidden id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.return.fields.orderno')); ?></label>
                            <select id="order" name="segment1" class="form-control select2 filterReturn">
                                <option selected></option>
                                <?php $__currentLoopData = $order_head; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($row->segment1); ?>"><?php echo e($row->segment1); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.return.fields.grn')); ?> </label>
                            <select id="grn" name="receipt_num" class="form-control select2 filterReturn">
                                <option selected></option>
                                <?php $__currentLoopData = $return; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($row->transaction_type == "RECEIVE"): ?>
                                <option value="<?php echo e($row->receipt_num); ?>"><?php echo e($row->receipt_num); ?></option>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.return.fields.item')); ?></label>
                            <input type="text" id="item" class="form-control filterReturn" name="item_code" placeholder="items">
                            <input type="hidden" id="type_lookup_code" value='1' name="type_lookup_code">
                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="table-responsive scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                            <table id="tableReturn" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><input type="checkbox" class='form-check-input dt-checkboxes' id="head-cb"></th>
                                        <th class="text-center">Transaction Type</th>
                                        <th class="text-end">QTY</th>
                                        <th class="text-center">UOM</th>
                                        <th class="text-start">Purchase Item</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-center">Location To</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table></br>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-1 mb-2">
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> <?php echo e(trans('global.save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/return/create.blade.php ENDPATH**/ ?>