<div>
<div  class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'border-1 border-s-4 p-4 flex flex-row',
        'bg-error/20 border-error' => $type === 'error',
        'bg-success/20 border-success' => $type === 'success',
        'bg-warning/20 border-warning' => $type === 'warning',
        'bg-info/20 border-info' => $type === 'info',
        '!bg-black' => $dark
 ]); ?>">
    <div class="pe-4">
        <?php if (isset($component)) { $__componentOriginalce0070e6ae017cca68172d0230e44821 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce0070e6ae017cca68172d0230e44821 = $attributes; } ?>
<?php $component = Mary\View\Components\Icon::resolve(['name' => $icon] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-'.e($type).'']); ?>
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
    <div>
        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(["text-white" => $dark]); ?>" >
            <span class="font-semibold"><?php echo e($title); ?></span>
            <span class="font-normal"><?php echo e($subtitle); ?></span>
        </div>
        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(["text-normal", "text-white" => $dark]); ?>">
            <?php echo e($slot); ?>

        </div>
    </div>
</div>
</div>
<?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\app\../src/Shared/UserInterface/Components/views/notification.blade.php ENDPATH**/ ?>