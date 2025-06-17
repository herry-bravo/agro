<?php $__env->startSection('code', '403'); ?>
<?php $__env->startSection('description', 'You dont have access to this modul contact Administrator'); ?>
<?php $__env->startSection('title', __($exception->getMessage() ?: 'Forbidden')); ?>
<?php $__env->startSection('nilai'); ?>
<?php echo e($nilai = 403); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.erorrs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/errors/403.blade.php ENDPATH**/ ?>