<div <?php echo e($attributes->class(["bg-base-100 border-base-300 border-b", "sticky top-0 z-10" => $sticky])); ?>>
    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(["flex",  "max-w-screen-2xl mx-auto" => !$fullWidth]); ?>">
        <div <?php echo e($brand?->attributes->class([" flex items-center  pl-0"])); ?>>
            <?php echo e($leftActions); ?>

        </div>
        <div <?php echo e($brand?->attributes->class(["flex-1 flex items-center pl-4 py-3 font-semibold"])); ?>>
            <?php echo e($brand); ?>

        </div>
        <div <?php echo e($actions?->attributes->class(["flex items-center gap-0 pr-2"])); ?>>
            <?php echo e($actions); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\Users\diego.ortiz\Documents\GitHub\informes\app\../src/Shared/UserInterface/Components/views/nav.blade.php ENDPATH**/ ?>