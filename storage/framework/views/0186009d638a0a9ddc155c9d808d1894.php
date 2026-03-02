<?php if (isset($component)) { $__componentOriginal9e79cd15ec5b5957133f9c0a985abe76 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9e79cd15ec5b5957133f9c0a985abe76 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.nav','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class=" mt-4 space-y-4">
        <?php if (isset($component)) { $__componentOriginal1d7d24b263283674f2a2a2dd9ed5e838 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1d7d24b263283674f2a2a2dd9ed5e838 = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\ActionList::resolve(['actions' => $actions,'title' => 'Informe de','subtitle' => 'Informes'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::action-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\ActionList::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1d7d24b263283674f2a2a2dd9ed5e838)): ?>
<?php $attributes = $__attributesOriginal1d7d24b263283674f2a2a2dd9ed5e838; ?>
<?php unset($__attributesOriginal1d7d24b263283674f2a2a2dd9ed5e838); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1d7d24b263283674f2a2a2dd9ed5e838)): ?>
<?php $component = $__componentOriginal1d7d24b263283674f2a2a2dd9ed5e838; ?>
<?php unset($__componentOriginal1d7d24b263283674f2a2a2dd9ed5e838); ?>
<?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9e79cd15ec5b5957133f9c0a985abe76)): ?>
<?php $attributes = $__attributesOriginal9e79cd15ec5b5957133f9c0a985abe76; ?>
<?php unset($__attributesOriginal9e79cd15ec5b5957133f9c0a985abe76); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9e79cd15ec5b5957133f9c0a985abe76)): ?>
<?php $component = $__componentOriginal9e79cd15ec5b5957133f9c0a985abe76; ?>
<?php unset($__componentOriginal9e79cd15ec5b5957133f9c0a985abe76); ?>
<?php endif; ?><?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\resources\views/pages/informes/inicio.blade.php ENDPATH**/ ?>