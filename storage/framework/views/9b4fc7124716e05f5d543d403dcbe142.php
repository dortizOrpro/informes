<div>
    <div class="grid grid-cols-12">
        <div class="col-span-2 bg-base-200 border-r-1 border-base-300" style="height: calc(100vh - 128px)">
            <!--[if BLOCK]><![endif]--><?php if($errors->any()): ?>
                <?php if (isset($component)) { $__componentOriginal0ec99b2ca6c4e06d4dcf4f8712001694 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0ec99b2ca6c4e06d4dcf4f8712001694 = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\Notificacion::resolve(['title' => 'Error','subtitle' => $errors->first(),'type' => 'error','icon' => 'carbon.error-filled','dark' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::notificacion'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\Notificacion::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0ec99b2ca6c4e06d4dcf4f8712001694)): ?>
<?php $attributes = $__attributesOriginal0ec99b2ca6c4e06d4dcf4f8712001694; ?>
<?php unset($__attributesOriginal0ec99b2ca6c4e06d4dcf4f8712001694); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0ec99b2ca6c4e06d4dcf4f8712001694)): ?>
<?php $component = $__componentOriginal0ec99b2ca6c4e06d4dcf4f8712001694; ?>
<?php unset($__componentOriginal0ec99b2ca6c4e06d4dcf4f8712001694); ?>
<?php endif; ?>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <div class="grid grid-cols-12">
            <div class="col-span-9  text-start" style="height: calc(100vh - 128px)">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('procesos.actividades-masivas.parametros', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-37052646-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            </div>
        </div>
    </div>
</div>
    

<?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\resources\views/livewire/procesos/actividadesMasivas/parametros.blade.php ENDPATH**/ ?>