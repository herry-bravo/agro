<?php if($message = Session::get('success')): ?>
<script>
    $.notify("Success <?php echo e($message); ?>", "success");
</script>
<?php endif; ?>

<?php if($message = Session::get('error')): ?>
<script>
    $.notify("Eror !! <?php echo e($message); ?>", "error");
</script>
<?php endif; ?>

<?php if($message = Session::get('warning')): ?>
<script>
    $.notify("Warning !! <?php echo e($message); ?>", "warn");
</script>
<?php endif; ?>

<?php if($message = Session::get('info')): ?>
<script>
    $.notify("Info !! <?php echo e($message); ?>", "info");
</script>
<?php endif; ?>

<?php if($errors->any()): ?>
<script>
    $.notify("Eror !! <?php echo e($message); ?>", "error");
</script>
<?php endif; ?>

<?php if($message = Session::get('deleted')): ?>
<script>
    $.notify("Data !! <?php echo e($message); ?>", "error");
</script>
<?php endif; ?>
<?php /**PATH C:\laragon\www\agro\resources\views/layouts/flash.blade.php ENDPATH**/ ?>