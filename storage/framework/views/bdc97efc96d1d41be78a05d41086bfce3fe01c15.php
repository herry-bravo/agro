
<?php $__env->startSection('code', '500'); ?>
<?php $__env->startSection('description', 'Server Eror Found Contact Administrator'); ?>
<?php $__env->startSection('title','Server Eror Found'); ?>
<?php $__env->startSection('nilai'); ?>
<?php echo e($nilai = 500); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.erorrs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/errors/500.blade.php ENDPATH**/ ?>