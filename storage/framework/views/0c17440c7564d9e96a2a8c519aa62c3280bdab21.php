<?php $__env->startSection('content'); ?>
<?php $__env->startSection('breadcrumbs'); ?>
        <a href="" class="breadcrumbs__item">Settings</a>
        <a href="" class="breadcrumbs__item">Global Terms</a>
        <a href="" class="breadcrumbs__item">Edit Global Terms</a>
<?php $__env->stopSection(); ?>
<!-- Main content -->
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-2"><?php echo e(trans('global.edit')); ?> <?php echo e(trans('cruds.terms.title')); ?></h4>
                </div>
                <hr>
                    <div class="card-body">
                        <form action="<?php echo e(route("admin.terms.update", [$terms->id])); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                        <input type="hidden" id="updated_by" name="updated_by" value="<?php echo e(auth()->user()->id); ?>">
                        <div class="box-body">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.terms.fields.term_category')); ?></label>
                                    <select type="text" id="term_category" name="term_category" class="form-control select2" required>
                                        <?php if(($terms->term_category) == "PAYMENT"): ?>
                                            <option value="PAYMENT" selected>PAYMENT</option>
                                            <option value="FREIGHT" >FREIGHT</option>
                                            <option value="CARRIER" >CARRIER</option>
                                        <?php elseif(($terms->term_category) == "FREIGHT"): ?>
                                            <option value="FREIGHT" selected>FREIGHT</option>
                                            <option value="PAYMENT" >PAYMENT</option>
                                            <option value="CARRIER" >CARRIER</option>
                                        <?php elseif(($terms->term_category) == "CARRIER"): ?>
                                            <option value="CARRIER" selected>CARRIER</option>
                                            <option value="PAYMENT" >PAYMENT</option>
                                            <option value="FREIGHT" >FREIGHT</option>
                                        <?php endif; ?>
                                    </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.terms.fields.term_code')); ?></label>
                                    <input type="text" class="form-control" name="term_code" value="<?php echo e($terms->term_code); ?>" placeholder="Terms Code" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.terms.fields.terms_name')); ?></label>
                                        <input type="text" class="form-control" name="terms_name" value="<?php echo e($terms->terms_name); ?>" placeholder="Term Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="col-sm-0 form-label" for="number"><?php echo e(trans('cruds.terms.fields.attribute1')); ?></label>
                                    <input type="text" class="form-control" name="attribute1" value="<?php echo e($terms->attribute1); ?>" placeholder="Attribute">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="reset" class="btn btn-danger pull-left">Reset</button>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/terms/edit.blade.php ENDPATH**/ ?>