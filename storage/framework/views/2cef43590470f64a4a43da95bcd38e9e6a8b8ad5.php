

<div class="md:flex items-center">
  
  <div class="flex-1">
    <?php echo $__env->make('laravel-views::components.toolbar.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>

  
  <div class="flex space-x-1 flex-1 justify-end items-center mb-4">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'laravel-views::components.loading','data' => ['class' => 'mb-0','wire:loading' => true]]); ?>
<?php $component->withName('lv-loading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mb-0','wire:loading' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    
    <div>
      <?php echo $__env->make('laravel-views::components.toolbar.bulk-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    
    <?php if(isset($sortableBy) && $sortableBy->isNotEmpty()): ?>
      <div>
        <?php echo $__env->make('laravel-views::components.toolbar.sorting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    <?php endif; ?>

    
    <div>
      <?php echo $__env->make('laravel-views::components.toolbar.filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
</div>
<?php /**PATH C:\laragon\www\nexzo\agro\resources\views/vendor/laravel-views/components/toolbar/toolbar.blade.php ENDPATH**/ ?>