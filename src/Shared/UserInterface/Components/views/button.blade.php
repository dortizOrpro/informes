<div>
    @if($link)
        <a href="{!! $link !!}"
    @else
        <button
            @endif

            wire:key="{{ $uuid }}"
            {{ $attributes->whereDoesntStartWith('class')->merge(['type' => 'button']) }}

            @if($icon)
                {{ $attributes->class(['btn normal-case', "!inline-flex lg:tooltip $tooltipPosition" => $tooltip]) }}
            @else
                {{ $attributes->class(['btn normal-case !ps-4 !pe-16', "!inline-flex lg:tooltip $tooltipPosition" => $tooltip]) }}
            @endif

            @if($link && $external)
                target="_blank"
            @endif

            @if($link && !$external && !$noWireNavigate)
                wire:navigate
            @endif

            @if($tooltip)
                data-tip="{{ $tooltip }}"
            @endif

            @if($spinner)
                wire:target="{{ $spinnerTarget() }}"
            wire:loading.attr="disabled"
            @endif
        >

            <!-- LABEL / SLOT -->
            @if($label)
                <span @class(["hidden lg:block" => $responsive ])>
                            {{ $label }}
                        </span>
                @if(strlen($badge ?? '') > 0)
                    <span class="badge badge-primary {{ $badgeClasses }}">{{ $badge }}</span>
                @endif
            @else
                {{ $slot }}
            @endif

            <!-- ICON -->
            @if($icon)
                <span class="block {{ isset($label) ? 'ml-4':'ml-0' }}" @if($spinner) wire:loading.class="hidden" wire:target="{{ $spinnerTarget() }}" @endif>
                            <x-mary-icon :name="$icon" />
                        </span>
            @endif

            <!-- SPINNER  -->
            @if($spinner && $icon)
                <span wire:loading wire:target="{{ $spinnerTarget() }}" class="loading loading-spinner w-5 h-5"></span>
            @endif

            @if(!$link)
        </button>
        @else
            </a>
    @endif
</div>
