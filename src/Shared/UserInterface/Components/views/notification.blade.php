<div>
<div  @class([
        'border-1 border-s-4 p-4 flex flex-row',
        'bg-error/20 border-error' => $type === 'error',
        'bg-success/20 border-success' => $type === 'success',
        'bg-warning/20 border-warning' => $type === 'warning',
        'bg-info/20 border-info' => $type === 'info',
        '!bg-black' => $dark
 ])>
    <div class="pe-4">
        <x-icon :name="$icon" class="text-{{ $type }}"/>
    </div>
    <div>
        <div @class(["text-white" => $dark]) >
            <span class="font-semibold">{{ $title }}</span>
            <span class="font-normal">{{ $subtitle }}</span>
        </div>
        <div @class(["text-normal", "text-white" => $dark])>
            {{ $slot }}
        </div>
    </div>
</div>
</div>
