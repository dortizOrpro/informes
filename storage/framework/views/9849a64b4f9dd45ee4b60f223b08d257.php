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
    <div class="grid grid-cols-3 gap-3 w-2xl px-8 pt-8">
        <div class="col-span-1">
            <?php if (isset($component)) { $__componentOriginald64144c2287634503c73cd4803d6e578 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald64144c2287634503c73cd4803d6e578 = $attributes; } ?>
<?php $component = Mary\View\Components\Select::resolve(['label' => 'Tipo','options' => $tipos,'placeholder' => 'Tipo...'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Select::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'tipo']); ?>
<?php echo $__env->renderComponent(); ?>
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
        <div class="col-span-2">
            <?php if (isset($component)) { $__componentOriginalee4b1effbc1c9cc6d14282619901b2fe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee4b1effbc1c9cc6d14282619901b2fe = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\ChoicesOffline::resolve(['label' => 'Actividad','options' => $actividades,'omitError' => 'true','single' => 'true','searchable' => 'true','noResultText' => 'No se encontró actividad...'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::choices-offline'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\ChoicesOffline::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'actividad','name' => 'selActividad','right-content' => 'id','class-right' => 'badge badge-neutral badge-outline','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($deshabilitado)]); ?>
                        <?php $__bladeCompiler = $__bladeCompiler ?? null; $loop = null; $__env->slot('item', function($actividades) use ($__env,$__bladeCompiler) { $loop = (object) $__env->getLoopStack()[0] ?>
                        <?php if (isset($component)) { $__componentOriginal8653fe0e2b5ee7b7ab3811c66ab90418 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8653fe0e2b5ee7b7ab3811c66ab90418 = $attributes; } ?>
<?php $component = Mary\View\Components\ListItem::resolve(['item' => $actividades] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('list-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\ListItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                             <?php $__env->slot('value', null, []); ?> 
                                <p>
                                    <span class="badge badge-primary badge-outline font-mono">
                                        <?php echo e(Str::padLeft($actividades->id % 1000,3,'0')); ?>

                                    </span>
                                    <span class="ps-1"><?php echo e(Str::afterLast($actividades->name,"\t")); ?></span>
                                </p>
                             <?php $__env->endSlot(); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8653fe0e2b5ee7b7ab3811c66ab90418)): ?>
<?php $attributes = $__attributesOriginal8653fe0e2b5ee7b7ab3811c66ab90418; ?>
<?php unset($__attributesOriginal8653fe0e2b5ee7b7ab3811c66ab90418); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8653fe0e2b5ee7b7ab3811c66ab90418)): ?>
<?php $component = $__componentOriginal8653fe0e2b5ee7b7ab3811c66ab90418; ?>
<?php unset($__componentOriginal8653fe0e2b5ee7b7ab3811c66ab90418); ?>
<?php endif; ?>
                        <?php }); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee4b1effbc1c9cc6d14282619901b2fe)): ?>
<?php $attributes = $__attributesOriginalee4b1effbc1c9cc6d14282619901b2fe; ?>
<?php unset($__attributesOriginalee4b1effbc1c9cc6d14282619901b2fe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee4b1effbc1c9cc6d14282619901b2fe)): ?>
<?php $component = $__componentOriginalee4b1effbc1c9cc6d14282619901b2fe; ?>
<?php unset($__componentOriginalee4b1effbc1c9cc6d14282619901b2fe); ?>
<?php endif; ?>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-3 w-2xl px-8">
            <div class="col-span-2">
                <?php if (isset($component)) { $__componentOriginal34d3cad3f3cac9fafaaed454c83e534d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal34d3cad3f3cac9fafaaed454c83e534d = $attributes; } ?>
<?php $component = Mary\View\Components\File::resolve(['label' => 'Archivo'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
            <div class="col-start-2 text-end">
                <?php if (isset($component)) { $__componentOriginal41b8929e354b43700da6c3f66364b7aa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41b8929e354b43700da6c3f66364b7aa = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\Button::resolve(['label' => 'Procesar'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'btn-primary','wire:click' => 'procesar()']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41b8929e354b43700da6c3f66364b7aa)): ?>
<?php $attributes = $__attributesOriginal41b8929e354b43700da6c3f66364b7aa; ?>
<?php unset($__attributesOriginal41b8929e354b43700da6c3f66364b7aa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41b8929e354b43700da6c3f66364b7aa)): ?>
<?php $component = $__componentOriginal41b8929e354b43700da6c3f66364b7aa; ?>
<?php unset($__componentOriginal41b8929e354b43700da6c3f66364b7aa); ?>
<?php endif; ?>
            </div>
    </div>
    
</div>


<?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\resources\views/livewire/procesos/actividadesMasivas/inicio.blade.php ENDPATH**/ ?>