<?php if (isset($component)) { $__componentOriginald5eb4dca035b3c477f4ee1b1bc1139e850b8c56c = $component; } ?>
<?php $component = $__env->getContainer()->make(LaravelViews\Views\Components\DynamicComponent::class, ['view' => $view,'data' => $data]); ?>
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
<?php /**PATH C:\laragon\www\nexzo\agro\vendor\laravel-views\laravel-views\src/../resources/views/core/dynamic-component.blade.php ENDPATH**/ ?>