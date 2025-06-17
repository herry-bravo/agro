
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header mt-2">
                    <h6 class="card-title">
                        <a href="<?php echo e(route("admin.category.index")); ?>" class="breadcrumbs__item">Category</a>
                        <a href="#" class="breadcrumbs__item">Create</a>
                    </h6>
                </div>
                <hr>
                <div class="card-body">
                    <form action="<?php echo e(route("admin.category.store")); ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="mb-1">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>">
                                    <input type="hidden" id="status" name="status" value="1">
                                    <div class="form-group row">
                                        <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.category.fields.code')); ?></label>

                                        <div class="col-sm-3 <?php echo e($errors->get('category_code') ? 'has-error' : ''); ?>">
                                            <input type="text" class="form-control" name="category_code" maxlength="6">
                                            <?php $__currentLoopData = $errors->get('category_code'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="help-block"><?php echo e($error); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                        <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.category.fields.name')); ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="category_name" maxlength="50">
                                        </div>

                                        <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.category.fields.description')); ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="description" maxlength="50">
                                        </div>
                                    </div>
                                </div>

                                <div class=" form-group row">
                                    <label class="col-sm-1 control-label" for="number">Inventory</label>
                                    <div class="col-sm-3">
                                        <select name="inventory_account_code" id="inventory_account_code" class="form-control select2" required>
                                            <option value="0000000">00000000</option>
                                            <?php $__currentLoopData = $acc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->account_code); ?>  <?php echo e(in_array($row->account_code, old('account_code', [])) ? 'selected' : ''); ?>"><?php echo e($row->account_code); ?> <?php echo e($row->description); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('account_code')): ?>
                                        <p class="help-block">
                                            <?php echo e($errors->first('account_code')); ?>

                                        </p>
                                        <?php endif; ?>
                                        <p class="helper-block">
                                        </p>
                                    </div>
                                    <label class="col-sm-1 control-label" for="number">Payable</label>
                                    <div class="col-sm-3">
                                        <select name="payable_account_code" id="payable_account_code" class="form-control select2" required>
                                            <option value="0000000">00000000</option>
                                            <?php $__currentLoopData = $acc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->account_code); ?>  <?php echo e(in_array($row->account_code, old('account_code', [])) ? 'selected' : ''); ?>"><?php echo e($row->account_code); ?> <?php echo e($row->description); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('account_code')): ?>
                                        <p class="help-block">
                                            <?php echo e($errors->first('account_code')); ?>

                                        </p>
                                        <?php endif; ?>
                                        <p class="helper-block">
                                        </p>
                                    </div>
                                    <label class="col-sm-1 control-label" for="number">Receive</label>
                                    <div class="col-sm-3">
                                        <select name="receivable_account_code" id="receivable_account_code" class="form-control select2" required>
                                            <option value="0000000">00000000</option>
                                            <?php $__currentLoopData = $acc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->account_code); ?>  <?php echo e(in_array($row->account_code, old('account_code', [])) ? 'selected' : ''); ?>"><?php echo e($row->account_code); ?> <?php echo e($row->description); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('account_code')): ?>
                                        <p class="help-block">
                                            <?php echo e($errors->first('account_code')); ?>

                                        </p>
                                        <?php endif; ?>
                                        <p class="helper-block">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.category.fields.salescode')); ?></label>
                                    <div class="col-sm-3">
                                        <select name="attribute1" id="attribute1" class="form-control select2" required>
                                            <option value="0000000">00000000</option>
                                            <?php $__currentLoopData = $acc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->account_code); ?>  <?php echo e(in_array($row->account_code, old('account_code', [])) ? 'selected' : ''); ?>"><?php echo e($row->account_code); ?> <?php echo e($row->description); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('account_code')): ?>
                                        <p class="help-block">
                                            <?php echo e($errors->first('account_code')); ?>

                                        </p>
                                        <?php endif; ?>
                                        <p class="helper-block">
                                        </p>
                                    </div>
                                    <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.category.fields.cogscode')); ?></label>
                                    <div class="col-sm-3">
                                        <select name="consumption_account_code" id="consumption_account_code" class="form-control select2" required>
                                            <option value="0000000">00000000</option>
                                            <?php $__currentLoopData = $acc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->account_code); ?>  <?php echo e(in_array($row->account_code, old('account_code', [])) ? 'selected' : ''); ?>"><?php echo e($row->account_code); ?> <?php echo e($row->description); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('account_code')): ?>
                                        <p class="help-block">
                                            <?php echo e($errors->first('account_code')); ?>

                                        </p>
                                        <?php endif; ?>
                                        <p class="helper-block">
                                        </p>
                                    </div>
                                    <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.category.fields.note')); ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" name="account_type" class="form-control" name="Attribute2" placeholder="">
                                        <input type="hidden" class="form-control" name="Attribute2" value='<?php echo e(Auth::user()->org_id); ?>' name='org_id' placeholder="">
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="d-flex justify-content-between mb-1 mt-1">
                                    <button type="reset" class="btn btn-danger pull-left">Reset</button>
                                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
                                </div>
                            </div>
                    </form> <!-- /.box-body -->
                </div>
            </div>
        </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/Admin/category/create.blade.php ENDPATH**/ ?>