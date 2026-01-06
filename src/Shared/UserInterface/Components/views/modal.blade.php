<dialog
    {{ $attributes->except('wire:model')->class(["modal"]) }}

    @if($id)
        id="{{ $id }}"
    @else
        x-data="{open: @entangle($attributes->wire('model')).live }"
    :class="{'modal-open !animate-none': open}"
    :open="open"
    @if(!$persistent)
        @keydown.escape.window = "$wire.{{ $attributes->wire('model')->value() }} = false"
    @endif
    @endif
>
    <div class="modal-box p-0 {{ $boxClass }}">

        <div class="flex flex-row">
            <div class="w-4/5">
                <div class="mb-4 mt-4 ml-4">
                    <p class="mb-1 text-xs text-base-content/80">{{ $subtitle }}</p>
                    <p class="text-xl">{{ $title }}</p>
                </div>
            </div>
            <div class="absolute top-0 right-0">

                @if($clickExit)
                    <x-cds::button class="btn-ghost btn-close" icon="carbon.close-large" @click="{{ $clickExit }}"/>
                @else
                    <x-cds::button class="btn-ghost btn-close" icon="carbon.close-large"
                                   @click="$wire.{{ $attributes->wire('model')->value() }} = false"/>
                @endif

            </div>

        </div>

        <div class="text-sm ps-4 pe-4">
            {{ $slot }}
        </div>

        @if($actions)
            <div class="grid grid-flow-col gap-0 auto-cols-auto">
                {{ $actions }}
            </div>
        @endif
    </div>

    @if(!$persistent)
        <form class="modal-backdrop" method="dialog">
            @if ($id)
                <button type="submit">close</button>
            @else
                <button @click="$wire.{{ $attributes->wire('model')->value() }} = false" type="button">close</button>
            @endif
        </form>
    @endif
</dialog>
