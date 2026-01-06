<dialog
    <?php echo e($attributes->except('wire:model')->class(["modal"])); ?>


    <?php if($id): ?>
        id="<?php echo e($id); ?>"
    <?php else: ?>
        x-data="{open: <?php if ((object) ($attributes->wire('model')) instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e($attributes->wire('model')->value()); ?>')<?php echo e($attributes->wire('model')->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e($attributes->wire('model')); ?>')<?php endif; ?>.live }"
    :class="{'modal-open !animate-none': open}"
    :open="open"
    <?php if(!$persistent): ?>
        @keydown.escape.window = "$wire.<?php echo e($attributes->wire('model')->value()); ?> = false"
    <?php endif; ?>
    <?php endif; ?>
>
    <div class="modal-box p-0 <?php echo e($boxClass); ?>">

        <div class="flex flex-row">
            <div class="w-4/5">
                <div class="mb-4 mt-4 ml-4">
                    <p class="mb-1 text-xs text-base-content/80"><?php echo e($subtitle); ?></p>
                    <p class="text-xl"><?php echo e($title); ?></p>
                </div>
            </div>
            <div class="absolute top-0 right-0">

                <!--[if BLOCK]><![endif]--><?php if($clickExit): ?>
                    <?php if (isset($component)) { $__componentOriginal41b8929e354b43700da6c3f66364b7aa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41b8929e354b43700da6c3f66364b7aa = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\Button::resolve(['icon' => 'carbon.close-large'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'btn-ghost btn-close','@click' => ''.e($clickExit).'']); ?>
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
                <?php else: ?>
                    <?php if (isset($component)) { $__componentOriginal41b8929e354b43700da6c3f66364b7aa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41b8929e354b43700da6c3f66364b7aa = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\Button::resolve(['icon' => 'carbon.close-large'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'btn-ghost btn-close','@click' => '$wire.'.e($attributes->wire('model')->value()).' = false']); ?>
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
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            </div>

        </div>

        <div class="text-sm ps-4 pe-4">
            <?php echo e($slot); ?>

        </div>

        <!--[if BLOCK]><![endif]--><?php if($actions): ?>
            <div class="grid grid-flow-col gap-0 auto-cols-auto">
                <?php echo e($actions); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <!--[if BLOCK]><![endif]--><?php if(!$persistent): ?>
        <form class="modal-backdrop" method="dialog">
            <!--[if BLOCK]><![endif]--><?php if($id): ?>
                <button type="submit">close</button>
            <?php else: ?>
                <button @click="$wire.<?php echo e($attributes->wire('model')->value()); ?> = false" type="button">close</button>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </form>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</dialog>
<?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\app\../src/Shared/UserInterface/Components/views/modal.blade.php ENDPATH**/ ?>