<div {{ $attributes->class(["bg-base-100 border-base-300 border-b", "sticky top-0 z-10" => $sticky]) }}>
    <div @class(["flex",  "max-w-screen-2xl mx-auto" => !$fullWidth])>
        <div {{ $brand?->attributes->class([" flex items-center  pl-0"]) }}>
            {{ $leftActions }}
        </div>
        <div {{ $brand?->attributes->class(["flex-1 flex items-center pl-4 py-3 font-semibold"]) }}>
            {{ $brand }}
        </div>
        <div {{ $actions?->attributes->class(["flex items-center gap-0 pr-2"]) }}>
            {{ $actions }}
        </div>
    </div>
</div>
