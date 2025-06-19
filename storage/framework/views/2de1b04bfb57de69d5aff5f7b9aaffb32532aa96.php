<div class="flex space-x-1">
  <?php if(count($selected) > 0): ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'laravel-views::components.dropdown.drop-down','data' => ['label' => 'Actions']]); ?>
<?php $component->withName('lv-drop-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['label' => 'Actions']); ?>
      <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'laravel-views::components.dropdown.header','data' => ['label' => ''.e(count($selected)).' Selected']]); ?>
<?php $component->withName('lv-drop-down.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['label' => ''.e(count($selected)).' Selected']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
      <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'laravel-views::components.actions.icon-and-title','data' => ['actions' => $this->bulkActions]]); ?>
<?php $component->withName('lv-actions.icon-and-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->bulkActions)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
  <?php endif; ?>

  <?php if($this->hasBulkActions && isset($headers) <= 0): ?>
    <button
      wire:click="$set('allSelected', <?php echo e(!$allSelected); ?>)"
      class="border border-transparent hover:border-gray-300 focus:border-gray-300 focus:outline-none flex items-center text-xs px-3 py-2 rounded hover:shadow-sm font-medium"
    >
      <?php echo e(__($allSelected ? 'Unselect all' : 'Select all')); ?>

    </button>
  <?php endif; ?>
</div><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/vendor/laravel-views/components/toolbar/bulk-actions.blade.php ENDPATH**/ ?>