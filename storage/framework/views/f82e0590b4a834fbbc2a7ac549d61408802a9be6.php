
<?php $__env->startSection('code', '404'); ?>
<?php $__env->startSection('description', 'Not Found'); ?>
<?php $__env->startSection('title','Not Found, Or Missing'); ?>
<?php $__env->startSection('nilai'); ?>
<?php echo e($nilai = 404); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.erorrs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/errors/404.blade.php ENDPATH**/ ?>