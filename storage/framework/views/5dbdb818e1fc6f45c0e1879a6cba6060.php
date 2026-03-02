<div class="space-y-4">

    <!-- <?php if($title || $subtitle): ?>
        <?php if (isset($component)) { $__componentOriginald9897c58a399a94d46906be73e938a88 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald9897c58a399a94d46906be73e938a88 = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\Header::resolve(['title' => $title,'subtitle' => $subtitle,'separator' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
    <?php endif; ?> -->
    <div class="p-5">
        <div class="card bg-base-100 p-5 bg-base-200 m-5">
            <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="border-b border-base-300 last:border-b-0">
                    <?php if (isset($component)) { $__componentOriginala0c9301c6b15a96bd8777864e5e9d8a7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0c9301c6b15a96bd8777864e5e9d8a7 = $attributes; } ?>
<?php $component = Src\Shared\UserInterface\Components\ActionListItem::resolve(['action' => $action] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cds::action-list-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Src\Shared\UserInterface\Components\ActionListItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0c9301c6b15a96bd8777864e5e9d8a7)): ?>
<?php $attributes = $__attributesOriginala0c9301c6b15a96bd8777864e5e9d8a7; ?>
<?php unset($__attributesOriginala0c9301c6b15a96bd8777864e5e9d8a7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0c9301c6b15a96bd8777864e5e9d8a7)): ?>
<?php $component = $__componentOriginala0c9301c6b15a96bd8777864e5e9d8a7; ?>
<?php unset($__componentOriginala0c9301c6b15a96bd8777864e5e9d8a7); ?>
<?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

</div>
<?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\app\../src/Shared/UserInterface/Components/views/action-list.blade.php ENDPATH**/ ?>