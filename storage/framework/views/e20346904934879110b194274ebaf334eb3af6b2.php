<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<a href="<?php echo e(route('admin.rcv.index')); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.rcv.fields.purchaseorder')); ?></a>
<a href="<?php echo e(route('admin.rcv.index')); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.rcv.title')); ?></a>
<a href="#" class="breadcrumbs__item active"><?php echo e(trans('cruds.rcv.fields.customerreceive')); ?></a>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo e($error); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
            </br>
                <div class="card-body">
                    <form action="<?php echo e(route("admin.rcvcustomer.store")); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal create_purchase">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.customer.cust')); ?></label>
                                <select id="vendor_id" name="vendor_id" class="form-control select2 filterrcvcustomer">
                                    <option selected></option>
                                    <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($row->party_name); ?>"><?php echo e($row->party_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.rcv.customer.so')); ?></label>
                                <select id="orderno" name="orderno" class="form-control select2 filterrcvcustomer">
                                    <option selected></option>
                                    <?php $__currentLoopData = $sales_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($row->order_number); ?>"><?php echo e($row->order_number); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.rcv.fields.item')); ?></label>
                                <input type="text" id="item" class="form-control filterrcvcustomer" name="item" placeholder="items">
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="box box-default">
                                <div class="box-body table-responsive scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                    <table class="table" id="rcvcustomerdetil" data-toggle="table">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class='form-check-input dt-checkboxes' id="head-cb"></th>
                                                <th class="text-end"><?php echo e(trans('cruds.rcv.fields.ordernumber')); ?></th>
                                                <th class="text-end"><?php echo e(trans('cruds.rcv.fields.qty')); ?></th>
                                                <th><?php echo e(trans('cruds.rcv.fields.uom')); ?></th>
                                                <th class="text-start"><?php echo e(trans('cruds.rcv.fields.purchaseorder')); ?></th>
                                                <th class="text-end"><?php echo e(trans('cruds.rcv.fields.price')); ?></th>
                                                <th class="text-end"><?php echo e(trans('cruds.rcv.fields.total')); ?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    </br>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div></div>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <?php echo e(trans('global.save')); ?></button>
                            <input type="hidden" name="grn" value="<?php echo e($grn->id); ?>">
                        </div>
                        <!-- Modal Example Start-->
                      <div class="modal fade" id="demoModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                 <div class="modal-header  bg-primary">
								  <h4 class="modal-title text-white" id="exampleModalLongTitle"><?php echo e(trans('cruds.rcv.title')); ?></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="mb-1">
                                                        <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.fields.grn')); ?></label>
                                                        <input type="text" class="form-control" value="<?php echo e($grn->id??''); ?>" readonly value="" name="receipt_num" autocomplete="off" maxlength="10" required>
                                                        <input type="hidden" id="agent_id" name="agent_id" value="<?php echo e(auth()->user()->id?? ''); ?>">
                                                        <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id?? ''); ?>">
                                                        <input type="hidden" id="updated_by" name="updated_by" value="<?php echo e(auth()->user()->id?? ''); ?>">
                                                        <input type="hidden" id="organization_id" value='222' name="organization_id">
                                                        <input type="hidden" id="ship_to_location" value='SH-982221229' name="ship_to_location">
                                                        <input type="hidden" id="bill_to_location" value='BL-982221229' name="bill_to_location">
                                                        <input type="hidden" id="type_lookup_code" value='1' name="type_lookup_code">

                                                        <input type="hidden" id="source" value='1' name="source">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.fields.packingslip')); ?></label>
                                                        <input type="text" class="form-control search_supplier_name" name="packing_slip" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.rcv.fields.transactiondate')); ?></label>
                                                        <input type="date" id="datePicker" name="gl_date" class="form-control datepicker" value="" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.fields.bill')); ?></label>
                                                        <input type="text" class="form-control search_supplier_name" name="waybill_airbill_num" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="col-sm-0 control-label" for="rate"><?php echo e(trans('cruds.rcv.fields.received')); ?></label>
                                                        <select class="form-control" name="user_receipt">
                                                            <option value="1">Syarifuddin</option>
                                                            <option value="2">Tirta</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.fields.freight')); ?></label>
                                                        <input type="text" class="form-control search_supplier_name" name="freight_terms" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="col-sm-0 control-label" for="rate"><?php echo e(trans('cruds.rcv.fields.aju')); ?></label>
                                                        <input type="text" class="form-control " name="attribute1" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Modal Example Start-->
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/rcvcustomer/create.blade.php ENDPATH**/ ?>