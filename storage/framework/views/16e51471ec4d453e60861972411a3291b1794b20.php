<div
  x-data='{ open: false, message: "", type: "success" }'
  x-init="window.livewire.find('<?php echo e($_instance->id); ?>').on('notify', (notification) => {
    open = true;
    message = notification.message;
    
  })"
>
  <div x-show='open'>
    <template x-if="type === 'danger'">
      <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'laravel-views::components.alert','data' => ['type' => 'danger','onClose' => 'open = false']]); ?>
<?php $component->withName('lv-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => 'danger','onClose' => 'open = false']); ?>
        <div x-text='message'></div>
       <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    </template>
    <template x-if="type === 'success'">
      <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'laravel-views::components.alert','data' => ['onClose' => 'open = false']]); ?>
<?php $component->withName('lv-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['onClose' => 'open = false']); ?>
        <div x-text='message'></div>
       <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    </template>
  </div>
</div><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/vendor/laravel-views/components/alerts-handler.blade.php ENDPATH**/ ?>