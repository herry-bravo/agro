
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
                    <div class="card-header mt-1 mb-25">
                        <h6 class="card-title">
                            <a href="<?php echo e(route("admin.asset-category.index")); ?>" class="breadcrumbs__item"> <?php echo e(trans('cruds.assetMng.title')); ?></a>
                            <a href="<?php echo e(route("admin.asset-category.index")); ?>" class="breadcrumbs__item">  <?php echo e(trans('cruds.assetMng.category')); ?> </a>
                        </h6>
                    </div>
                    <hr>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.asset-category.store')); ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">

                                <div class="col-md-12 col-12">
                                    <div class="mb-3">
                                        <div class="form-group row">
                                            <div class="col-sm-5">
                                                <label class="control-label label-primary" for="number"><b >Asset Category</b></label>
                                                <input type="text" class="form-control" name="name">
                                                <input type="hidden" class="form-control" name="type" value="Purchase">
                                            </div>
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-5">
                                                <label class="control-label" for="number"><b>Company</b></label>
                                                <input type="text" class="form-control" name="company_id">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 control-label" for="number"><b style='color:green !important;'>Journal Entries</b>
                                                <hr></label>


                                            <label class="col-sm-6 control-label" for="number"><b style='color:green !important;'>Periodicity</b>
                                                <hr></label>
                                        </div>
                                    </div>


                                    <div class="mb-2">
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <!-- <label class="col-sm-2 control-label"for="number"><?php echo e(trans('cruds.assetMng.cat.journal')); ?></label>
                                            <div class="col-sm-3">
                                                <select name="journal_id" id="journal" class="form-control select2" required>
                                                    <option hidden selected></option>
                                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($row->category_code); ?>"><?php echo e($row->description); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div> -->
                                            <div class="col-sm-6"></div>
                                            <label class="col-sm-2 control-label" for="number"><?php echo e(trans('cruds.assetMng.cat.time')); ?></label>
                                            <div class="col-sm-3">
                                                <div class=" form-check-inline">
                                                    <input class="form-check-input" type="radio" name="method_time" id="inlineRadio1" value="Number" checked="">
                                                    <label class="form-check-label" for="inlineRadio1">&nbsp Number of Entries</label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="method_time" id="inlineRadio2" value="Date">
                                                    <label class="form-check-label" for="inlineRadio2">&nbsp Ending Date</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row ">
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label"for="number"><?php echo e(trans('cruds.assetMng.cat.asset_acc')); ?></label>
                                            <div class="col-sm-3">
                                                <select name="account_asset_id" id="acc" class="form-control select2" required>
                                                    <option hidden selected></option>
                                                    <?php $__currentLoopData = $acc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($row->account_code); ?>"><?php echo e($row->account_code); ?> - <?php echo e($row->description); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label" for="number"><?php echo e(trans('cruds.assetMng.cat.number')); ?></label>
                                            <div class="col-sm-3">
                                                <input type="text" name="method_number" class="form-control">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row ">
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label"for="number"><?php echo e(trans('cruds.assetMng.cat.depr')); ?> : <?php echo e(trans('cruds.assetMng.cat.asset_acc')); ?></label>
                                            <div class="col-sm-3">
                                                <select name="account_depreciation_id" id="depr1" class="form-control select2" required>
                                                    <option hidden selected></option>
                                                    <?php $__currentLoopData = $acc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($row->account_code); ?>"><?php echo e($row->account_code); ?> - <?php echo e($row->description); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label" for="number"><?php echo e(trans('cruds.assetMng.cat.one_entry')); ?></label>
                                            <div class="col-sm-3">
                                                <input type="text" name="method_period" class="form-control">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row ">
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label"for="number"><?php echo e(trans('cruds.assetMng.cat.depr')); ?> : <?php echo e(trans('cruds.assetMng.cat.expense_acc')); ?></label>
                                            <div class="col-sm-3">
                                                <select name="account_depreciation_expense_id" id="depr2" class="form-control select2" required>
                                                    <option hidden selected></option>
                                                    <?php $__currentLoopData = $acc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($row->account_code); ?>"><?php echo e($row->account_code); ?> - <?php echo e($row->description); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group row ">
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label"for="number"><?php echo e(trans('cruds.assetMng.cat.analytic')); ?></label>
                                            <div class="col-sm-3">
                                                <select name="account_analytic_id" id="analytic" class="form-control select2" required>
                                                    <option hidden selected></option>
                                                    <?php $__currentLoopData = $acc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($row->account_code); ?>"><?php echo e($row->account_code); ?> - <?php echo e($row->description); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 control-label" for="number"><b style='color:green !important;'>Additional Options</b>
                                                <hr></label>


                                            <label class="col-sm-6 control-label" for="number"><b style='color:green !important;'>Depreciation Method</b>
                                                <hr></label>
                                        </div>
                                    </div>


                                    <div class="mb-3">
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label"for="number"><?php echo e(trans('cruds.assetMng.cat.auto_confirm')); ?></label>
                                            <div class="col-sm-3">
                                                <div class="">
                                                    <input class="form-check-input" type="checkbox" name="logo" id="inlineRadio1" value="True" >
                                                    <label class="form-check-label" for="inlineRadio1"></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label" for="number"><?php echo e(trans('cruds.assetMng.cat.method')); ?></label>
                                            <div class="col-sm-3">
                                                <div class=" form-check-inline">
                                                    <input class="form-check-input" type="radio" name="method" id="inlineRadio3" value="Linear" checked="">
                                                    <label class="form-check-label" for="inlineRadio3">&nbsp &nbsp Linear</label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="method" id="inlineRadio4" value="Digressive">
                                                    <label class="form-check-label" for="inlineRadio4">&nbsp &nbsp Digressive</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label"for="number"><?php echo e(trans('cruds.assetMng.cat.group')); ?></label>
                                            <div class="col-sm-3">
                                                <div class="">
                                                    <input class="form-check-input" type="checkbox" name="group_entries" id="inlineRadio1" value="True" >
                                                    <label class="form-check-label" for="inlineRadio1"></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label" for="number"><?php echo e(trans('cruds.assetMng.cat.temporis')); ?></label>
                                            <div class="col-sm-3">
                                                <div class="">
                                                    <input class="form-check-input" type="checkbox" name="prorata" id="inlineRadio1" value="True" >
                                                    <label class="form-check-label" for="inlineRadio1"></label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="d-flex justify-content-between">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/assetCategory/create.blade.php ENDPATH**/ ?>