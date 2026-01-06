<div class="drawer drawer-end">
    <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex justify-end">
        <label for="my-drawer-4" class="drawer-button btn btn-primary btn-sm">
            <x-icon name="carbon.filter"/>
        </label>
    </div>
    <div class="drawer-side">
        <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
        <div class="menu pt-0 bg-base-200 text-base-content min-h-full w-sm">

            <div class="!p-0">

                <div class="flex flex-row sticky top-0 bg-base-200 z-50">
                    <div class="w-4/5">
                        <div class="mb-4 mt-4 ml-4">
                            <p class="mb-1 text-xs">{{ $description }}</p>
                            <p class="text-lg">{{ $label }}</p>
                        </div>
                    </div>
                </div>
                <div class=""
                     x-data="{
                        values: {},
                        form_valid: true,
                        collapseOn(x) {
                            let element = document.getElementById('collapse-' + x);
                            element.classList.remove('collapse-open');
                        },
                        collapseOff(x) {
                            let element = document.getElementById('collapse-' + x);
                            element.classList.add('collapse-open');
                        },
                        cambia(x){
                            let element = x.target.id;
                            if(x.target.value.length !== 0) {
                                this.collapseOff(x.target.id);
                            } else {
                                this.collapseOn(x.target.id);
                            }
                        },
                        limpiar(x){
                            this.collapseOn(x);
                        }
                    }"
                >
                    <form id="filter_form_{{ $name }}" class="p-1" style="overflow-y: scroll; height: calc(100vh - 172px)">
                        @foreach($form as $filter)
                            @php
                                $control_name = "fv_" . $filter->name;
                                $model_name = "values." . $filter->name;
                            @endphp
                            <div class="collapse collapse-arrow bg-base-200 border-y border-base-300" id="collapse-{{ $control_name }}">
                                <input type="checkbox" />
                                <div class="collapse-title font-semibold bg-base-200">{{ $filter->label }}</div>
                                <div class="collapse-content text-sm p-0">

                                    <div class="col-span-2 nojoin border border-base-300 filter-item w-full">
                                        @switch($filter->type)
                                            @case('text')
                                            @case('date')
                                            @case('email')
                                                <input
                                                    autocomplete="off"
                                                    x-model="{{ $model_name }}"
                                                    id="{{ $control_name }}"
                                                    type="{{ $filter->type }}"
                                                    class="input input-sm w-full input-filter-item"
                                                    @if($filter->pattern) pattern="{{ $filter->pattern }}" @endif
                                                    x-on:keyup="form_valid = filter_form_{{ $name }}.checkValidity()"
                                                    x-on:change="cambia"
                                                />
                                                @break
                                            @case('multicheck')
                                            <div class="block">
                                                    @foreach($filter->options as $key=>$option)
                                                    <label class="label block py-2">
                                                        <input
                                                            class="checkbox"
                                                            type="checkbox"
                                                            x-model="{{ $model_name }}_{{ $key }}"
                                                            value="{{ ((array)$option)['id'] }}"
                                                            />
                                                        {{ ((array)$option)['name'] }}
                                                    </label>

                                                    @endforeach
                                                </div>
                                                @break
                                            @case('select')
                                                <select class="select select-sm w-full" x-model="{{ $model_name }}"
                                                        name="{{ $control_name }}" id="{{ $control_name }}"
                                                        x-on:change="cambia"
                                                >
                                                    <option value="null"></option>
                                                    @foreach($filter->options as $option)
                                                        <option
                                                            value="{{ ((array)$option)['id'] }}">{{ ((array)$option)['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                @break
                                            @case('xselect')
                                                <x-select class="select select-sm w-full max-w-xs" x-model="{{ $model_name }}"
                                                          :options="$filter->options"
                                                />

                                                @break
                                            @case('selectize')
                                                <x-cds::choices-offline
                                                    class="select-sm"
                                                    x-model="{{ $model_name }}"
                                                    name="{{ $control_name }}" id="{{ $control_name }}"
                                                    option-value="id"
                                                    option-label="name"
                                                    :options="$filter->options"
                                                    single="true"
                                                    searchable="true"
                                                />
                                                @break
                                            @default
                                        @endswitch
                                        <button type="button" class="btn btn-sm join-item"
                                                @click="$data.{{  $model_name  }} = null;limpiar('{{  $control_name  }}')">x
                                        </button>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </form>
                    <div class="grid grid-cols-2 mt-2 fixed bottom-0 left-0 right-0 ">
                        <x-cds::button
                            label="Limpiar"
                            class="w-6/12 btn-ghost btn-cds-action"
                            @click="$data.values = {}"
                        />
                        <x-cds::button
                            label="Filtrar"
                            class="w-6/12 btn-primary btn-cds-action"
                            @click="filter_form_{{ $name }}.checkValidity() ? $wire.onFilter(values) : false"
                            x-bind:disabled="!form_valid"
                        />
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
