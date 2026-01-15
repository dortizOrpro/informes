    <div wire:key="<?php echo e($uuid); ?>">
        <div
            <?php echo e($attributes->class([
                    "flex justify-start items-center gap-4 px-3 py-3",
                    "hover:bg-base-200" => !$noHover,
                    "cursor-pointer" => $link
                ])); ?>

        >

            <!--[if BLOCK]><![endif]--><?php if($link && (data_get($item, $avatar) || !is_string($avatar))): ?>
                <div>
                    <a href="<?php echo e($link); ?>" wire:navigate>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <!-- AVATAR -->
            <!--[if BLOCK]><![endif]--><?php if(data_get($item, $avatar) || $fallbackAvatar && is_string($avatar)): ?>
                <div>
                    <div class="avatar">
                        <div class="w-11 rounded-full">
                            <img src="<?php echo e(data_get($item, $avatar)); ?>" <?php if($fallbackAvatar): ?> onerror="this.src='<?php echo e($fallbackAvatar); ?>'" <?php endif; ?> />
                        </div>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <!--[if BLOCK]><![endif]--><?php if(!is_string($avatar)): ?>
                <div <?php echo e($avatar->attributes->class([])); ?>>
                    <?php echo e($avatar); ?>

                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->


            <!--[if BLOCK]><![endif]--><?php if($link && (data_get($item, $avatar) || !is_string($avatar))): ?>
                    </a>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <!-- CONTENT -->
            <div class="flex-1 overflow-hidden whitespace-nowrap text-ellipsis truncate w-0 mary-hideable">
                <!--[if BLOCK]><![endif]--><?php if($link): ?>
                    <a href="<?php echo e($link); ?>" wire:navigate>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <div>
                    <div <?php if(!is_string($value)): ?> <?php echo e($value->attributes->class(["font-semibold truncate"])); ?> <?php else: ?> class="font-semibold truncate" <?php endif; ?>>
                        <?php echo e(is_string($value) ? data_get($item, $value) : $value); ?>

                    </div>

                    <div <?php if(!is_string($subValue)): ?>  <?php echo e($subValue->attributes->class(["text-base-content/50 text-sm truncate"])); ?> <?php else: ?> class="text-base-content/50 text-sm truncate" <?php endif; ?>>
                        <?php echo e(is_string($subValue) ? data_get($item, $subValue) : $subValue); ?>

                    </div>
                </div>

                <!--[if BLOCK]><![endif]--><?php if($link): ?>
                    </a>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <!-- ACTION -->
            <!--[if BLOCK]><![endif]--><?php if($actions): ?>
                <!--[if BLOCK]><![endif]--><?php if($link && !Str::of($actions)->contains([':click', '@click' , 'href'])): ?>
                    <a href="<?php echo e($link); ?>" wire:navigate>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <div <?php echo e($actions->attributes->class(["flex items-center gap-3 mary-hideable"])); ?>>
                            <?php echo e($actions); ?>

                    </div>

                <!--[if BLOCK]><![endif]--><?php if($link && !Str::of($actions)->contains([':click', '@click' , 'href'])): ?>
                    </a>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <!--[if BLOCK]><![endif]--><?php if(!$noSeparator): ?>
            <hr class="border-t-[length:var(--border)] border-base-content/10"/>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div><?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\storage\framework\views/6a03d5958811f415fea2268570443211.blade.php ENDPATH**/ ?>