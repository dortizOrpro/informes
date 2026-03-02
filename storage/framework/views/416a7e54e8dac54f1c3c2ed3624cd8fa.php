<a
    href="<?php echo e(route($action['route'])); ?>"
    class="block text-decoration-none text-reset"
>
    <div class="card mb-2 hover:bg-base-200 transition">
        <div class="flex items-center gap-4 p-3">

            <div class="flex-shrink-0">
                <?php if (isset($component)) { $__componentOriginalce0070e6ae017cca68172d0230e44821 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce0070e6ae017cca68172d0230e44821 = $attributes; } ?>
<?php $component = Mary\View\Components\Icon::resolve(['name' => ''.e($action['icon']).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-8 h-8']); ?>
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

            <div class="flex flex-col">
                <h6 class="font-semibold mb-1">
                    <?php echo e($action['title']); ?>

                </h6>
                <p class="text-sm text-gray-500">
                    <?php echo e($action['description']); ?>

                </p>
            </div>

        </div>
    </div>
</a><?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\app\../src/Shared/UserInterface/Components/views/action-list-item.blade.php ENDPATH**/ ?>