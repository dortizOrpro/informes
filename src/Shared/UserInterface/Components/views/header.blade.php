<div id="{{ $anchor }}" {{ $attributes->class(["bg-base-200", "mary-header-anchor" => $withAnchor]) }}>
    <div noclass="flex flex-wrap gap-5 justify-between items-center">
        <div class="pt-4 mb-6 px-4 relative">
            <div @class(["$size text-xl", is_string($title) ? '' : $title?->attributes->get('class') ]) >
                @if($withAnchor)
                    <a href="#{{ $anchor }}">
                        @endif

                        {{ $title }}

                        @if($withAnchor)
                    </a>
                @endif
            </div>

            @if($subtitle)
                <div @class(["text-base-content/60 text-sm", is_string($subtitle) ? '' : $subtitle?->attributes->get('class') ]) >
                    {{ $subtitle }}
                </div>
            @endif

            @if($link)
{{--                <div class="absolute top-0 right-0 mr-2">--}}
{{--                    <a href="{{ $link }}" class="btn btn-ghost" :title="$tooltipLink" tooltip-bottom="true">--}}
{{--                        <x-icon :name="$iconLink" />--}}
{{--                    </a>--}}
{{--                </div>--}}
                <div class="absolute top-0 right-0 mr-2">
                    <x-cds::button
                        class="btn-ghost btn-close"
                        :icon="$iconLink"
                        :link="$link"
                        :tooltip="$tooltipLink"
                        tooltip-bottom="true"
                    />
                </div>
            @endif
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>

            </div>
            <div @class(["flex items-center justify-center gap-3 grow order-last sm:order-none", is_string($middle) ? '' : $middle?->attributes->get('class')])>
                {{ $middle }}
            </div>
            <div @class(["flex items-center gap-0 justify-end", is_string($actions) ? '' : $actions?->attributes->get('class') ])>
                {{ $actions}}
            </div>
        </div>
{{--        @if($middle)--}}
{{--            <div @class(["flex items-center justify-center gap-3 grow order-last sm:order-none", is_string($middle) ? '' : $middle?->attributes->get('class')])>--}}
{{--                <div xclass="w-full lg:w-auto">--}}
{{--                    {{ $middle }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <div @class(["flex items-center gap-0 justify-end", is_string($actions) ? '' : $actions?->attributes->get('class') ]) >--}}
{{--            {{ $actions}}--}}
{{--        </div>--}}
    </div>

    @if($separator)
        <hr class="mt-2 border-base-300" />
    @endif
</div>
