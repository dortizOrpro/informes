<div>
    <div @class(["text-lg", is_string($title) ? '' : $title?->attributes->get('class') ]) >
                {{ $title }}
    </div>
    @if($subtitle)
        <div @class(["text-base-content/60 text-sm", is_string($subtitle) ? '' : $subtitle?->attributes->get('class') ]) >
            {{ $subtitle }}
        </div>
    @endif
    @foreach($rows as $form_row)
        <div class="grid grid-cols-12 gap-2">
            @foreach($form_row as $cell)
                <div class="{{ $cell['class'] ?? '' }}">
                    @php
                        $type = explode('.',$cell['type']);
                    @endphp

                    @if($type[0] === 'input')
                        <x-mary-input
                            autocomplete="off"
                            label="{{$cell['label']}}"
                            name="{{$cell['key']}}"
                            type="{{$type[1] ?? 'text'}}"
                            class="{{ $cell['control-class'] ?? '' }}"
                            placeholder="{{ $cell['placeholder'] ?? '' }}"
                            wire:model="{{$cell['model']}}"
                        />
                    @elseif($type[0] === 'select')
                        <x-select
                            label="{{$cell['label']}}"
                            name="{{$cell['key']}}"
                            class="{{ $cell['control-class'] ?? '' }}"
                            wire:model="{{$cell['model']}}"
                            :options="$options($cell['options'])"
                            placeholder="{{ $cell['placeholder'] ?? '' }}"
                        />
                    @elseif($type[0] === 'radio')
                        <x-radio
                            label="{{$cell['label']}}"
                            name="{{$cell['key']}}"
                            class="{{ $cell['control-class'] ?? '' }}"
                            wire:model="{{$cell['model']}}"
                            :options="$options($cell['options'])"
                        />
                    @elseif($type[0] === 'text')
                        <x-textarea
                            label="{{$cell['label']}}"
                            name="{{$cell['key']}}"
                            class="{{ $cell['control-class'] ?? '' }}"
                            placeholder="{{ $cell['placeholder'] ?? '' }}"
                            wire:model="{{$cell['model']}}"
                        ></x-textarea>
                    @elseif($type[0] === 'label')
                        <label class="label {{ $cell['control-class'] ?? '' }}">{{ $cell['label'] }}</label>
                    @endif

                </div>
            @endforeach
        </div>
    @endforeach
    @if($debug)
        <xmp>{{ print_r($variables, true) }}</xmp>
    @endif
</div>
