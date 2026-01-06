<div>
    <?php
        // We need this extra step to support models arrays. Ex: wire:model="emails.0"  , wire:model="emails.1"
        $uuid = $uuid . $modelName()
    ?>

    <fieldset class="fieldset py-0">
        
        <!--[if BLOCK]><![endif]--><?php if($label && !$inline): ?>
            <legend class="fieldset-legend mb-0.5">
                <?php echo e($label); ?>


                <!--[if BLOCK]><![endif]--><?php if($attributes->get('required')): ?>
                    <span class="text-error">*</span>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </legend>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <label class="<?php echo \Illuminate\Support\Arr::toCssClasses(["floating-label" => $label && $inline]); ?>">
            
            <!--[if BLOCK]><![endif]--><?php if($label && $inline): ?>
                <span class="font-semibold"><?php echo e($label); ?></span>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <div class="w-full">
                
                <textarea
                    placeholder="<?php echo e($attributes->get('placeholder')); ?> "

                   <?php echo e($attributes->merge(['id' => $uuid])
                        ->class([
                            "textarea w-full",
                            "border-dashed" => $attributes->has("readonly") && $attributes->get("readonly") == true,
                            "!textarea-error" => $errorFieldName() && $errors->has($errorFieldName()) && !$omitError
                        ])); ?>

                ><?php echo e($slot); ?></textarea>
            </div>
        </label>

        
        <!--[if BLOCK]><![endif]--><?php if(!$omitError && $errors->has($errorFieldName())): ?>
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $errors->get($errorFieldName()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = Arr::wrap($message); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="<?php echo e($errorClass); ?>" x-class="text-error"><?php echo e($line); ?></div>
                    <?php if($firstErrorOnly) break; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                <?php if($firstErrorOnly) break; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        
        <!--[if BLOCK]><![endif]--><?php if($hint): ?>
            <div class="<?php echo e($hintClass); ?>" x-classes="fieldset-label"><?php echo e($hint); ?></div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </fieldset>
</div><?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\storage\framework\views/121a85e04a05b510f63fc1275a01b176.blade.php ENDPATH**/ ?>