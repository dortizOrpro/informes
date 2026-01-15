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
    <?php if (isset($component)) { $__componentOriginald9897c58a399a94d46906be73e938a88 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald9897c58a399a94d46906be73e938a88 = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\Header::resolve(['title' => 'Actividades','subtitle' => 'Carga masiva de actividades desde un archivo.'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\Header::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald9897c58a399a94d46906be73e938a88)): ?>
<?php $attributes = $__attributesOriginald9897c58a399a94d46906be73e938a88; ?>
<?php unset($__attributesOriginald9897c58a399a94d46906be73e938a88); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald9897c58a399a94d46906be73e938a88)): ?>
<?php $component = $__componentOriginald9897c58a399a94d46906be73e938a88; ?>
<?php unset($__componentOriginald9897c58a399a94d46906be73e938a88); ?>
<?php endif; ?>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('procesos.actividades-masivas.actividad-masiva', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3660172404-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9e79cd15ec5b5957133f9c0a985abe76)): ?>
<?php $attributes = $__attributesOriginal9e79cd15ec5b5957133f9c0a985abe76; ?>
<?php unset($__attributesOriginal9e79cd15ec5b5957133f9c0a985abe76); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9e79cd15ec5b5957133f9c0a985abe76)): ?>
<?php $component = $__componentOriginal9e79cd15ec5b5957133f9c0a985abe76; ?>
<?php unset($__componentOriginal9e79cd15ec5b5957133f9c0a985abe76); ?>
<?php endif; ?><?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\resources\views/pages/procesos/actividadesMasivas/inicio.blade.php ENDPATH**/ ?>