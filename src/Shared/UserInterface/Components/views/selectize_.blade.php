<div x-data="{ focused: false, selection: @entangle($attributes->wire('model')) }">
    <div x-data="{
    search: '',
    options: {{ json_encode($options) }},
    noResults: false,
    id: $id('{{ $uuid }}'),
    init() {
        this.$refs.dropdownOptions.addEventListener('toggle', (event) => {
                if(event.newState === 'open') {
                    this.$refs.searchInput.focus()
                    this.resetList();
                    this.search = '';
                }
            }
        );
    },

    get selectedOption() {
        o = this.options.filter(i => i.{{ $optionValue }} == this.selection)[0];
          return o ? o.{{ $optionLabel }} : '';
    },

    selectOption(option) {
        this.selection = option;
        this.$refs.dropdownOptions.open = false;
    },

    resetList() {
        Array.from(this.$refs.choicesOptions.children).forEach(child => {
            child.classList.remove('hidden');
        });
    },

    lookup() {
        Array.from(this.$refs.choicesOptions.children).forEach(child => {
            if (!child.getAttribute('search-value').match(new RegExp(this.search, 'i'))){
                child.classList.add('hidden')
            } else {
                child.classList.remove('hidden')
            }
        })

        this.noResults = Array.from(this.$refs.choicesOptions.querySelectorAll('div > .hidden')).length ==
                         Array.from(this.$refs.choicesOptions.querySelectorAll('[search-value]')).length;

        console.log(this.noResults);
    },
}
">
        @if($label)
            <label :for="id" class="pt-0 label label-text font-semibold">
                                <span>
                                    {{ $label }}
                                    @if($attributes->get('required'))
                                        <span class="text-error">*</span>
                                    @endif
                                </span>
            </label>
        @endif
        <details :id="id" class="dropdown w-full" wire:key="selectize-{{ $uuid }}" x-ref="dropdownOptions">
            <summary tabindex="0" class="select select-sm w-full select-primary flex items-center"
                     x-text="selectedOption">&nbsp;
            </summary>

            <div class="dropdown-content bg-base-200 w-full z-50 border border-accent shadow-sm" tabindex="0"
                 wire:key="options-list-{{ $uuid }}">
                <input id="{{ $name }}__input"
                       type="text"
                       autocomplete="off"
                       class="select-sm border-b border-accent w-full bg-base-200"
                       x-ref="searchInput"
                       x-model="search"
                       @keyup="lookup()"
                />
                <div x-show="noResults" class="text-sm w-full text-start cursor-pointer px-3 py-1"
                     wire:key="no-results-{{ rand() }}">Sin resultados
                </div>
                <div style="overflow-y: auto" x-ref="choicesOptions" class="{{ $attributes->get('list-height') }}">
                    @foreach($options as $option)
                        <div class="text-sm btn-ghost w-full text-start cursor-pointer px-3 py-1"
                             search-value="{{ data_get($option, $optionLabel) }}"
                             @click="selectOption({{ data_get($option, $optionValue) }})"
                             wire:key="option-{{ data_get($option, $optionValue) }}"
                        >
                            @if(isset(${"option_item"}))
                                {{ ${"option_item"}($option) }}
                            @else
                                {{ data_get($option, $optionLabel) }}
                            @endif
                        </div>
                    @endforeach

                </div>
            </div>
        </details>
    </div>
</div>
