<div id="<?php echo e($anchor); ?>" <?php echo e($attributes->class(["bg-base-200", "mary-header-anchor" => $withAnchor])); ?>>
    <div noclass="flex flex-wrap gap-5 justify-between items-center">
        <div class="pt-4 mb-6 px-4 relative">
            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(["$size text-xl", is_string($title) ? '' : $title?->attributes->get('class') ]); ?>" >
                <?php if($withAnchor): ?>
                    <a href="#<?php echo e($anchor); ?>">
                        <?php endif; ?>

                        <?php echo e($title); ?>


                        <?php if($withAnchor): ?>
                    </a>
                <?php endif; ?>
            </div>

            <?php if($subtitle): ?>
                <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(["text-base-content/60 text-sm", is_string($subtitle) ? '' : $subtitle?->attributes->get('class') ]); ?>" >
                    <?php echo e($subtitle); ?>

                </div>
            <?php endif; ?>

            <?php if($link): ?>





                <div class="absolute top-0 right-0 mr-2">
                    <?php if (isset($component)) { $__componentOriginal41b8929e354b43700da6c3f66364b7aa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41b8929e354b43700da6c3f66364b7aa = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\Button::resolve(['icon' => $iconLink,'link' => $link,'tooltip' => $tooltipLink,'tooltipBottom' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'btn-ghost btn-close']); ?>
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
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>

            </div>
            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(["flex items-center justify-center gap-3 grow order-last sm:order-none", is_string($middle) ? '' : $middle?->attributes->get('class')]); ?>">
                <?php echo e($middle); ?>

            </div>
            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(["flex items-center gap-0 justify-end", is_string($actions) ? '' : $actions?->attributes->get('class') ]); ?>">
                <?php echo e($actions); ?>

            </div>
        </div>











    </div>

    <?php if($separator): ?>
        <hr class="mt-2 border-base-300" />
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\app\../src/Shared/UserInterface/Components/views/header.blade.php ENDPATH**/ ?>