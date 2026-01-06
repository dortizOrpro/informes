<?php
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Number;use Src\Calculo\Domain\Enums\TipoCalculo;
?>

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
                    <div class="flex-none w-1/4 text-start pt-2">Fecha Pago</div>
                    <div class="flex-none w-3/4">
                        <?php if (isset($component)) { $__componentOriginalf51438a7488970badd535e5f203e0c1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf51438a7488970badd535e5f203e0c1b = $attributes; } ?>
<?php $component = Mary\View\Components\Input::resolve(['omitError' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'fechaPago','type' => 'date']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf51438a7488970badd535e5f203e0c1b)): ?>
<?php $attributes = $__attributesOriginalf51438a7488970badd535e5f203e0c1b; ?>
<?php unset($__attributesOriginalf51438a7488970badd535e5f203e0c1b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf51438a7488970badd535e5f203e0c1b)): ?>
<?php $component = $__componentOriginalf51438a7488970badd535e5f203e0c1b; ?>
<?php unset($__componentOriginalf51438a7488970badd535e5f203e0c1b); ?>
<?php endif; ?>
                    </div>
                </div>
                <div class="flex gap-4 px-4 pt-2">
                    <div class="flex-none w-1/4 text-start pt-2">Fecha Cálculo</div>
                    <div class="flex-none w-3/4">
                        <p class="input text-end"><?php echo e(date('d/m/Y', strtotime($fechaCalculo))); ?></p>
                    </div>
                </div>
                <div class="flex gap-4 px-4 pt-2">
                    <div class="flex-none w-1/4 text-start pt-2">Tipo Cálculo</div>
                    <div class="flex-none w-3/4">
                        <?php if (isset($component)) { $__componentOriginald64144c2287634503c73cd4803d6e578 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald64144c2287634503c73cd4803d6e578 = $attributes; } ?>
<?php $component = Mary\View\Components\Select::resolve(['options' => $tiposCalculos,'omitError' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Select::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'tipoCalculo','class' => 'w-full']); ?> <?php echo $__env->renderComponent(); ?>
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
                <!--[if BLOCK]><![endif]--><?php switch($tipoCalculo):
                    case (TipoCalculo::RutAfiliado): ?>
                        <div class="flex gap-4 px-4 pt-2">
                            <div class="flex-none w-1/4 text-start pt-2">R.U.T. Afiliado</div>
                            <div class="flex-none w-3/4">
                                <?php if (isset($component)) { $__componentOriginalf51438a7488970badd535e5f203e0c1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf51438a7488970badd535e5f203e0c1b = $attributes; } ?>
<?php $component = Mary\View\Components\Input::resolve(['omitError' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mary-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'input text-end','wire:model' => 'rutAfiliado','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bloqueado),'autocomplete' => 'off']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf51438a7488970badd535e5f203e0c1b)): ?>
<?php $attributes = $__attributesOriginalf51438a7488970badd535e5f203e0c1b; ?>
<?php unset($__attributesOriginalf51438a7488970badd535e5f203e0c1b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf51438a7488970badd535e5f203e0c1b)): ?>
<?php $component = $__componentOriginalf51438a7488970badd535e5f203e0c1b; ?>
<?php unset($__componentOriginalf51438a7488970badd535e5f203e0c1b); ?>
<?php endif; ?>
                            </div>
                        </div>
                        
                    <?php case (TipoCalculo::RutDeudor): ?>
                        <div class="flex gap-4 px-4 pt-2">
                            <div class="flex-none w-1/4 text-start pt-2">R.U.T. Deudor</div>
                            <div class="flex-none w-3/4">
                                <?php if (isset($component)) { $__componentOriginalf51438a7488970badd535e5f203e0c1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf51438a7488970badd535e5f203e0c1b = $attributes; } ?>
<?php $component = Mary\View\Components\Input::resolve(['omitError' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mary-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'input text-end','wire:model' => 'rutEmpleador','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(count($afiliados) > 0),'autocomplete' => 'off']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf51438a7488970badd535e5f203e0c1b)): ?>
<?php $attributes = $__attributesOriginalf51438a7488970badd535e5f203e0c1b; ?>
<?php unset($__attributesOriginalf51438a7488970badd535e5f203e0c1b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf51438a7488970badd535e5f203e0c1b)): ?>
<?php $component = $__componentOriginalf51438a7488970badd535e5f203e0c1b; ?>
<?php unset($__componentOriginalf51438a7488970badd535e5f203e0c1b); ?>
<?php endif; ?>
                            </div>
                        </div>
                        <?php break; ?>
                    <?php case (TipoCalculo::RitCausa): ?>
                        <div class="flex gap-4 px-4 pt-2">
                            <div class="flex-none w-1/4 text-start pt-2">R.I.T. Causa</div>
                            <div class="flex-none w-3/4">
                                <?php if (isset($component)) { $__componentOriginalf51438a7488970badd535e5f203e0c1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf51438a7488970badd535e5f203e0c1b = $attributes; } ?>
<?php $component = Mary\View\Components\Input::resolve(['omitError' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mary-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'input text-end','wire:model' => 'ritCausa','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bloqueado),'autocomplete' => 'off']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf51438a7488970badd535e5f203e0c1b)): ?>
<?php $attributes = $__attributesOriginalf51438a7488970badd535e5f203e0c1b; ?>
<?php unset($__attributesOriginalf51438a7488970badd535e5f203e0c1b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf51438a7488970badd535e5f203e0c1b)): ?>
<?php $component = $__componentOriginalf51438a7488970badd535e5f203e0c1b; ?>
<?php unset($__componentOriginalf51438a7488970badd535e5f203e0c1b); ?>
<?php endif; ?>
                            </div>
                        </div>
                        <div class="flex gap-4 px-4 pt-2">
                            <div class="flex-none w-1/4 text-start pt-2">Tribunal</div>
                            <div class="flex-none w-3/4">

                                <?php if (isset($component)) { $__componentOriginalee4b1effbc1c9cc6d14282619901b2fe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee4b1effbc1c9cc6d14282619901b2fe = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\ChoicesOffline::resolve(['options' => $tribunales,'searchable' => 'true','single' => 'true','noResultText' => 'Sin resultados'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::choices-offline'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\ChoicesOffline::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model' => 'tribunalId','placeholder' => 'Tribunal...']); ?>
                                    <?php $__bladeCompiler = $__bladeCompiler ?? null; $loop = null; $__env->slot('item', function($tribunal) use ($__env,$__bladeCompiler) { $loop = (object) $__env->getLoopStack()[0] ?>
                                    <div class="truncate text-sm p-2 hover:bg-base-300">
                                        <?php echo e($tribunal->name); ?>

                                    </div>
                                    <?php }); ?>
                                    <?php $__bladeCompiler = $__bladeCompiler ?? null; $loop = null; $__env->slot('selection', function($tribunal) use ($__env,$__bladeCompiler) { $loop = (object) $__env->getLoopStack()[0] ?>
                                    <div class="text-sm w-3xs" title="<?php echo e($tribunal->name); ?>">
                                        <span class="truncate list-item"><?php echo e($tribunal->name); ?></span>
                                    </div>
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
                        <?php break; ?>
                    <?php case (TipoCalculo::Cobranza): ?>
                        <div class="flex gap-4 px-4 pt-2">
                            <div class="flex-none w-1/4 text-start pt-2">Cobranza</div>
                            <div class="flex-none w-3/4">
                                <?php if (isset($component)) { $__componentOriginalf51438a7488970badd535e5f203e0c1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf51438a7488970badd535e5f203e0c1b = $attributes; } ?>
<?php $component = Mary\View\Components\Input::resolve(['omitError' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mary-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'input text-end','wire:model' => 'cobranzaId','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bloqueado),'autocomplete' => 'off']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf51438a7488970badd535e5f203e0c1b)): ?>
<?php $attributes = $__attributesOriginalf51438a7488970badd535e5f203e0c1b; ?>
<?php unset($__attributesOriginalf51438a7488970badd535e5f203e0c1b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf51438a7488970badd535e5f203e0c1b)): ?>
<?php $component = $__componentOriginalf51438a7488970badd535e5f203e0c1b; ?>
<?php unset($__componentOriginalf51438a7488970badd535e5f203e0c1b); ?>
<?php endif; ?>
                            </div>
                        </div>
                        <?php break; ?>
                <?php endswitch; ?><!--[if ENDBLOCK]><![endif]-->
                <div class="grid grid-cols-2 gap-1 my-3">
                    <div class="">
                        <?php if (isset($component)) { $__componentOriginal602b228a887fab12f0012a3179e5b533 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal602b228a887fab12f0012a3179e5b533 = $attributes; } ?>
<?php $component = Mary\View\Components\Button::resolve(['label' => 'Limpiar'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'reiniciar()','class' => 'w-full bg-base-300']); ?>
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
<?php $component = Mary\View\Components\Button::resolve(['label' => count($afiliados)  > 0 ? 'Agregar' : 'Buscar'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bloqueado),'wire:click' => 'buscar()','class' => 'btn btn-primary w-full']); ?>
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
                <div class="flex gap-4 px-4 pt-3">
                    <div class="flex-none w-1/4 text-start">U.F.</div>
                    <div class="flex w-3/4 justify-between">
                        <span><?php echo e(Carbon::create($fechaCalculo)->format('d/m/Y')); ?></span>
                        <span>$ <?php echo e(Number::format($uf,2,2,'de')); ?></span>
                    </div>
                </div>
            </div>
            <!--[if BLOCK]><![endif]--><?php if($errors->any() ): ?>
                <div>
                    <?php if (isset($component)) { $__componentOriginal0ec99b2ca6c4e06d4dcf4f8712001694 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0ec99b2ca6c4e06d4dcf4f8712001694 = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\Notificacion::resolve(['type' => 'error','title' => 'Errores','icon' => 'carbon.error-filled'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::notificacion'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\Notificacion::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p><?php echo e($message); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
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
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <div class="font-medium text-lg bg-base-300 py-2 border-b-1 border-base-200 px-2">
                <?php if (isset($component)) { $__componentOriginalce0070e6ae017cca68172d0230e44821 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce0070e6ae017cca68172d0230e44821 = $attributes; } ?>
<?php $component = Mary\View\Components\Icon::resolve(['name' => 'carbon.calculation-alt','label' => 'Cálculos'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
            <!--[if BLOCK]><![endif]--><?php if($isSoloCalculo): ?>
                <div>
                    <?php if (isset($component)) { $__componentOriginal0ec99b2ca6c4e06d4dcf4f8712001694 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0ec99b2ca6c4e06d4dcf4f8712001694 = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\Notificacion::resolve(['type' => 'warning','title' => 'Atención','subtitle' => 'Fecha de pago anterior a fecha actual solo permite cálculo.','icon' => 'carbon.warning-alt-filled','dark' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <div class="p-0">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $calculos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $calculo => $valor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex gap-4 px-4 py-1">
                        <div class="flex-none w-1/4 text-start capitalize"><?php echo e($calculo); ?></div>
                        <div class="flex w-3/4 justify-between">
                            <span>&nbsp;</span>
                            
                            <span>$ <?php echo e(Number::format((float)$valor, precision: 0, locale:'de')); ?></span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                <hr class="mx-3">
                <div class="flex gap-4 px-4 py-1">
                    <div class="flex-none w-1/4 text-start capitalize">Total a Pagar </div>
                    <div class="flex w-3/4 justify-between">
                        <span>&nbsp;</span>
                        
                        <span>$ <?php echo e(Number::format($totalPago, precision: 0,locale:'de')); ?></span>
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-2 gap-1 m-3">
                <div class="">
                    <?php if (isset($component)) { $__componentOriginal41b8929e354b43700da6c3f66364b7aa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41b8929e354b43700da6c3f66364b7aa = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\Button::resolve(['label' => 'Preingreso'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'btn-primary w-full','wire:click' => 'abrirModalPreingreso','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalPago <= 0 || $bloqueado)]); ?>
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
                <div class="">
                    <?php if (isset($component)) { $__componentOriginal41b8929e354b43700da6c3f66364b7aa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41b8929e354b43700da6c3f66364b7aa = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\Button::resolve(['label' => 'Pagar'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'btn-primary w-full','wire:click' => 'guardar()','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalPago <= 0 || $bloqueado)]); ?>
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
        


        
        <div class="col-span-9 text-start overflow-y-scroll" style="height: calc(100vh - 88px)">
            <!--[if BLOCK]><![endif]--><?php if(isset($params['tipoCalculo'])): ?>
                <div>
                    <!--[if BLOCK]><![endif]--><?php switch($tipoCalculo):
                        case (\Src\Calculo\Domain\Enums\TipoCalculo::nulo): ?>
                            <?php break; ?>

                        <?php case (\Src\Calculo\Domain\Enums\TipoCalculo::RutAfiliado): ?>
                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('caja.afiliados.listado', ['wire:model' => 'afiliados','rutEmpleador' => (int)$rutEmpleador]);

$__html = app('livewire')->mount($__name, $__params, 'lw-2537731238-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                            <?php break; ?>

                        <?php default: ?>
                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('calculo.detalle-cobranzas', ['tipoCalculo' => $tipoCalculo,'params' => $params]);

$__html = app('livewire')->mount($__name, $__params, 'lw-2537731238-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                    <?php endswitch; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        

    </div>
    <!--[if BLOCK]><![endif]--><?php if($pagar): ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('caja.pago-form', ['preingreso' => $preingreso,'calculos' => $calculos,'totalPago' => $totalPago]);

$__html = app('livewire')->mount($__name, $__params, 'lw-2537731238-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('preingreso.preingreso-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2537731238-3', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php if (isset($component)) { $__componentOriginal2aca76be1376419dfd37220f36011753 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2aca76be1376419dfd37220f36011753 = $attributes; } ?>
<?php $component = Mary\View\Components\Toast::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('toast'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Toast::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2aca76be1376419dfd37220f36011753)): ?>
<?php $attributes = $__attributesOriginal2aca76be1376419dfd37220f36011753; ?>
<?php unset($__attributesOriginal2aca76be1376419dfd37220f36011753); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2aca76be1376419dfd37220f36011753)): ?>
<?php $component = $__componentOriginal2aca76be1376419dfd37220f36011753; ?>
<?php unset($__componentOriginal2aca76be1376419dfd37220f36011753); ?>
<?php endif; ?>
</div>
<?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\resources\views/livewire/calculo/parametros.blade.php ENDPATH**/ ?>