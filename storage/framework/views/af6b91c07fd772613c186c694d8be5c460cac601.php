
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('breadcrumbs'); ?>

<a href="" class="breadcrumbs__item">Settings</a>
<a href="" class="breadcrumbs__item">Global Terms</a>
<a href="" class="breadcrumbs__item">Create Global Terms</a>

<?php $__env->stopSection(); ?>
<!-- Main content -->
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-2">Supplier</h4>
                </div>
                <hr>
                <div class="card-body">
                    <form action="<?php echo e(route("admin.terms.store")); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>">
                        <input type="hidden" id="updated_by" name="updated_by" value="<?php echo e(auth()->user()->id); ?>">
                        <div class="box-body">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.terms.fields.term_category')); ?></label>
                                        <select type="text" id="term_category" name="term_category" class="form-control select2" required>
                                            <option hidden selected></option>
                                            <option value="PAYMENT">PAYMENT</option>
                                            <option value="FREIGHT">FREIGHT</option>
                                            <option value="CARRIER">CARRIER</option>
                                            <option value="ORIGIN">ORIGIN</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.terms.fields.term_code')); ?></label>
                                        <input type="text" class="form-control" name="term_code" placeholder="Terms Code" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.terms.fields.terms_name')); ?></label>
                                        <input type="text" class="form-control" name="terms_name" placeholder="Term Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.terms.fields.attribute1')); ?></label>
                                        <input type="text" class="form-control" name="attribute1" placeholder="Attribute" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-warning" type="reset"><i data-feather='refresh-ccw'></i> Reset</button>
                            <button type="submit" class="btn btn-primary pull-left btn-submit"><i data-feather='save'></i> <?php echo e(trans('global.save')); ?></button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/terms/create.blade.php ENDPATH**/ ?>