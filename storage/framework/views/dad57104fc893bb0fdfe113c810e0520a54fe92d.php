

<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'laravel-views::view.layout','data' => []]); ?>
<?php $component->withName('lv-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    
    <div class="mb-25">
        <?php echo $__env->make('laravel-views::components.toolbar.toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-25 lg:grid-cols-2 xl:grid-cols-<?php echo e($maxCols); ?> gap-8 md:gap-8">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="relative">
            <?php if($this->hasBulkActions): ?>
            <div class="absolute top-0 lef-0 p-2">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'laravel-views::components.form.checkbox','data' => ['wire:model' => 'selected','value' => ''.e($item->getKey()).'']]); ?>
<?php $component->withName('lv-checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:model' => 'selected','value' => ''.e($item->getKey()).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
            <?php endif; ?>
            <?php if (isset($component)) { $__componentOriginald5eb4dca035b3c477f4ee1b1bc1139e850b8c56c = $component; } ?>
<?php $component = $__env->getContainer()->make(LaravelViews\Views\Components\DynamicComponent::class, ['view' => $cardComponent,'data' => array_merge($this->card($item), [
              'withBackground' => $withBackground,
              'model' => $item,
              'actions' => $actionsByRow,
              'hasDefaultAction' => $this->hasDefaultAction,
              'selected' => in_array($item->getKey(), $selected)
            ])]); ?>
<?php $component->withName('lv-dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald5eb4dca035b3c477f4ee1b1bc1139e850b8c56c)): ?>
<?php $component = $__componentOriginald5eb4dca035b3c477f4ee1b1bc1139e850b8c56c; ?>
<?php unset($__componentOriginald5eb4dca035b3c477f4ee1b1bc1139e850b8c56c); ?>
<?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="mt-8">
        <?php echo e($items->links()); ?>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\nexzo\agro\resources\views/vendor/laravel-views/grid-view/grid-view.blade.php ENDPATH**/ ?>