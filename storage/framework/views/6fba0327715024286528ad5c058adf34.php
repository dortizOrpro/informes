<div>
    <?php if (isset($component)) { $__componentOriginalc31aa031a08eb4649f0db419eaccec93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc31aa031a08eb4649f0db419eaccec93 = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\Loading::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::loading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\Loading::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc31aa031a08eb4649f0db419eaccec93)): ?>
<?php $attributes = $__attributesOriginalc31aa031a08eb4649f0db419eaccec93; ?>
<?php unset($__attributesOriginalc31aa031a08eb4649f0db419eaccec93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc31aa031a08eb4649f0db419eaccec93)): ?>
<?php $component = $__componentOriginalc31aa031a08eb4649f0db419eaccec93; ?>
<?php unset($__componentOriginalc31aa031a08eb4649f0db419eaccec93); ?>
<?php endif; ?>
    <div class="grid grid-cols-12">
        <div class="col-span-3 bg-base-200 border-r-1 border-base-300" style="height: calc(100vh - 128px)">
            <div class="font-medium text-lg bg-base-300 py-2 border-b-1 border-base-200 px-2">
                <?php if (isset($component)) { $__componentOriginalce0070e6ae017cca68172d0230e44821 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce0070e6ae017cca68172d0230e44821 = $attributes; } ?>
<?php $component = Mary\View\Components\Icon::resolve(['name' => 'carbon.parameter','label' => 'Parámetros'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mary-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce0070e6ae017cca68172d0230e44821)): ?>
<?php $attributes = $__attributesOriginalce0070e6ae017cca68172d0230e44821; ?>
<?php unset($__attributesOriginalce0070e6ae017cca68172d0230e44821); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce0070e6ae017cca68172d0230e44821)): ?>
<?php $component = $__componentOriginalce0070e6ae017cca68172d0230e44821; ?>
<?php unset($__componentOriginalce0070e6ae017cca68172d0230e44821); ?>
<?php endif; ?>
            </div>

            <div class="p-2">
                <div class="flex gap-4 px-4 pt-2">
                    <div class="flex-none w-1/4 text-start pt-2">Criterio</div>
                    <div class="flex-none w-3/4">
                        <?php if (isset($component)) { $__componentOriginald64144c2287634503c73cd4803d6e578 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald64144c2287634503c73cd4803d6e578 = $attributes; } ?>
<?php $component = Mary\View\Components\Select::resolve(['options' => $criterios] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Select::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'criterio','class' => 'w-full']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald64144c2287634503c73cd4803d6e578)): ?>
<?php $attributes = $__attributesOriginald64144c2287634503c73cd4803d6e578; ?>
<?php unset($__attributesOriginald64144c2287634503c73cd4803d6e578); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald64144c2287634503c73cd4803d6e578)): ?>
<?php $component = $__componentOriginald64144c2287634503c73cd4803d6e578; ?>
<?php unset($__componentOriginald64144c2287634503c73cd4803d6e578); ?>
<?php endif; ?>
                    </div>
                </div>

                <div class="flex gap-4 px-4 pt-2">
                    <div class="flex-none w-1/4 text-start pt-2">Archivo</div>
                    <div class="flex-none w-3/4">
                        <?php if (isset($component)) { $__componentOriginal34d3cad3f3cac9fafaaed454c83e534d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal34d3cad3f3cac9fafaaed454c83e534d = $attributes; } ?>
<?php $component = Mary\View\Components\File::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('file'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\File::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model' => 'excelCobranzas']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal34d3cad3f3cac9fafaaed454c83e534d)): ?>
<?php $attributes = $__attributesOriginal34d3cad3f3cac9fafaaed454c83e534d; ?>
<?php unset($__attributesOriginal34d3cad3f3cac9fafaaed454c83e534d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal34d3cad3f3cac9fafaaed454c83e534d)): ?>
<?php $component = $__componentOriginal34d3cad3f3cac9fafaaed454c83e534d; ?>
<?php unset($__componentOriginal34d3cad3f3cac9fafaaed454c83e534d); ?>
<?php endif; ?>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-1 my-3">
                    <div class="">
                        <?php if (isset($component)) { $__componentOriginal602b228a887fab12f0012a3179e5b533 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal602b228a887fab12f0012a3179e5b533 = $attributes; } ?>
<?php $component = Mary\View\Components\Button::resolve(['label' => 'Reiniciar'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal602b228a887fab12f0012a3179e5b533)): ?>
<?php $attributes = $__attributesOriginal602b228a887fab12f0012a3179e5b533; ?>
<?php unset($__attributesOriginal602b228a887fab12f0012a3179e5b533); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal602b228a887fab12f0012a3179e5b533)): ?>
<?php $component = $__componentOriginal602b228a887fab12f0012a3179e5b533; ?>
<?php unset($__componentOriginal602b228a887fab12f0012a3179e5b533); ?>
<?php endif; ?>
                    </div>
                    <div class="">
                        <?php if (isset($component)) { $__componentOriginal602b228a887fab12f0012a3179e5b533 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal602b228a887fab12f0012a3179e5b533 = $attributes; } ?>
<?php $component = Mary\View\Components\Button::resolve(['label' => 'Generar'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'generar()','class' => 'btn btn-primary w-full']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal602b228a887fab12f0012a3179e5b533)): ?>
<?php $attributes = $__attributesOriginal602b228a887fab12f0012a3179e5b533; ?>
<?php unset($__attributesOriginal602b228a887fab12f0012a3179e5b533); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal602b228a887fab12f0012a3179e5b533)): ?>
<?php $component = $__componentOriginal602b228a887fab12f0012a3179e5b533; ?>
<?php unset($__componentOriginal602b228a887fab12f0012a3179e5b533); ?>
<?php endif; ?>
                    </div>
                </div>

                <hr class="border-1 border-base-300"/>
            </div>
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
[$__name, $__params] = $__split('informes.fichas.criterio', ['criterio' => $criterio]);

$__html = app('livewire')->mount($__name, $__params, 'criterio-'.e($criterio).'', $__slots ?? [], get_defined_vars());

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
    

<?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\resources\views/livewire/informes/fichas/parametros.blade.php ENDPATH**/ ?>