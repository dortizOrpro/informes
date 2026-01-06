<div x-data="{ selection: @entangle($attributes->wire('model')) }">
    @php
        // We need this extra step to support models arrays. Ex: wire:model="emails.0"  , wire:model="emails.1"
        $uuid = $uuid . $modelName()
    @endphp

    <fieldset class="fieldset py-0" x-data="
    {
                options: {{ json_encode($options) }},
                visible_value: '',
                init(){
                    this.visible_value = this.currentValue(this.selection);
                },
                currentValue(id) {
                    valor = this.options.filter(i => i.id == id);
                    return valor.length > 0 ? valor[0].name.trim() : '';
                },
               keyUp(e) {
                    const sText = this.$refs.searchInput.value.toLowerCase();
                    const options = this.$refs.optionsList.childNodes;
                    lista = Array.from(options).filter(x => x.nodeName === 'LI' && x.nodeType === 1);
                    const count = lista.length;
                    for (let i = 0; i < count; i++) {
                        const strTexto = lista[i].innerText.toLowerCase();
                        if (strTexto.includes(sText)) {
                            lista[i].classList.remove('hidden');
                        } else  {
                            lista[i].classList.add('hidden');
                        }
                    }

                },
                selectItem(select) {
                    this.selection = select;
                    this.visible_value = this.currentValue(this.selection);
                    document.activeElement.blur();
                },
    }
    ">
        {{-- STANDARD LABEL --}}
        @if($label)
            <legend class="fieldset-legend mb-0.5">
                {{ $label }}

                @if($attributes->get('required'))
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        <label>
            <div @class(["w-full", "join" => $prepend || $append])>
                {{-- PREPEND --}}
                @if($prepend)
                    {{ $prepend }}
                @endif

                {{-- THE LABEL THAT HOLDS THE INPUT --}}
                <label
                    @if($isDisabled())
                        disabled
                    @endif

                    {{
                        $attributes->whereStartsWith('class')->class([
                            "input w-full",
                            "join-item" => $prepend || $append,
                            "border-dashed" => $isReadonly(),
                            "!input-error" => $errorFieldName() && $errors->has($errorFieldName()) && !$omitError
                        ])
                    }}
                >
                    {{-- PREFIX --}}
                    @if($prefix)
                        <span class="label">{{ $prefix }}</span>
                    @endif

                    {{-- ICON LEFT --}}
                    @if($icon)
                        <x-mary-icon :name="$icon" class="pointer-events-none w-4 h-4 opacity-40" />
                    @endif



                    <div class="dropdown w-full">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-block justify-start font-normal ps-0">
                            <span  x-text="visible_value"></span>
                        </div>

                        <div tabindex="0" class="dropdown-content menu bg-base-100 w-52 p-2 border-1 border-base-300" style="z-index: 10000; width: -webkit-fill-available;">
                            <label class="input w-full">
                                <input type="text" id="{{ $uuid }}__input" x-ref="searchInput" x-on:keyup='keyUp()'>
                            </label>
                            <ul id="{{ $uuid }}__list" style="height: 8rem; overflow-y: scroll" x-ref="optionsList">
                                @foreach($options as $option)
                                <li class="{{ $uuid }}__list_item"
                                    id="option-{{ $uuid }}-{{ data_get($option, 'id') }}"
                                    data-label="{{ data_get($option, 'name') }}"
                                    search-value="{{ data_get($option, 'name') }}"
                                >
                                    <a class="{{ $uuid }}__list_item_text  flex justify-between" x-on:click="selectItem('{{ data_get($option, 'id') }}')">
                                        {{ data_get($option, 'name') }}
                                        @if(isset($rightContent))
                                            <span @class($classRight)>
                                          {{ ((array)$option)[$rightContent] }}
                                        </span>
                                        @endif
                                    </a>

                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>



                    {{-- CLEAR ICON  --}}
                    @if($clearable)
                        <x-mary-icon x-on:click="$wire.set('{{ $modelName() }}', '', {{ json_encode($attributes->wire('model')->hasModifier('live')) }})"  name="o-x-mark" class="cursor-pointer w-4 h-4 opacity-40"/>
                    @endif

                    {{-- ICON RIGHT --}}
                    @if($iconRight)
                        <x-mary-icon :name="$iconRight" class="pointer-events-none w-4 h-4 opacity-40" />
                    @endif

                    {{-- SUFFIX --}}
                    @if($suffix)
                        <span class="label">{{ $suffix }}</span>
                    @endif
                </label>

                {{-- APPEND --}}
                @if($append)
                    {{ $append }}
                @endif
            </div>
        </label>

        {{-- ERROR --}}
        @if(!$omitError && $errors->has($errorFieldName()))
            @foreach($errors->get($errorFieldName()) as $message)
                @foreach(Arr::wrap($message) as $line)
                    <div class="{{ $errorClass }}" x-class="text-error">{{ $line }}</div>
                    @break($firstErrorOnly)
                @endforeach
                @break($firstErrorOnly)
            @endforeach
        @endif

        {{-- HINT --}}
        @if($hint)
            <div class="{{ $hintClass }}" x-classes="fieldset-label">{{ $hint }}</div>
        @endif
    </fieldset>

</div>
