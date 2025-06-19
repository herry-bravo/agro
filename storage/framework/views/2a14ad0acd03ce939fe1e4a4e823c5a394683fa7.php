<div
  x-data='{ open: false, action: "", id: "", message: ""}'
  x-init="window.livewire.find('<?php echo e($_instance->id); ?>').on('openConfirmationModal', (actionObject) => {
    open = true;
    action = actionObject.id;
    id = actionObject.modelId;
    message = actionObject.message;
  })"
>
  <div x-show="open" x-cloak>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'laravel-views::components.modal','data' => []]); ?>
<?php $component->withName('lv-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
      <div x-text='message' class="text-gray-900 text-lg font-medium" ></div>
      <div class="mt-4 flex flex-col space-y-2 sm:space-y-0 sm:space-x-2 sm:flex-row sm:items-center">
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'laravel-views::components.buttons.button','data' => ['@click' => 'open = false','variant' => 'white','wire:loading.attr' => 'disabled']]); ?>
<?php $component->withName('lv-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['@click' => 'open = false','variant' => 'white','wire:loading.attr' => 'disabled']); ?>
          <?php echo e(__("Cancel")); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'laravel-views::components.buttons.button','data' => ['variant' => 'danger','@click' => 'await $wire.call(\'confirmAndExecuteAction\', action, id, false); open = false','wire:loading.attr' => 'disabled']]); ?>
<?php $component->withName('lv-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['variant' => 'danger','@click' => 'await $wire.call(\'confirmAndExecuteAction\', action, id, false); open = false','wire:loading.attr' => 'disabled']); ?>
          <?php echo e(__("Yes, I'm sure")); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'laravel-views::components.loading','data' => ['wire:loading' => true]]); ?>
<?php $component->withName('lv-loading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:loading' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
      </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
  </div>
</div><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/vendor/laravel-views/components/confirmation-message.blade.php ENDPATH**/ ?>