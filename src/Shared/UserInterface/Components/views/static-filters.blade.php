
    <div id="filter_modal_{{ $name }}" class="bg-base-100 z-[1] p-0">
        <div class="!p-0">

            <div class="flex flex-row">
                <div class="w-4/5">
                    <div class="mb-4 mt-4 ml-4">
                        <p class="mb-1 text-xs">{{ $description }}</p>
                        <p class="text-lg">{{ $label }}</p>
                    </div>
                </div>
            </div>
            <div class="" x-data="{ values: {}, form_valid: true}">
                <form id="filter_form_{{ $name }}" class="p-1" style="height: 50vh; overflow-y: auto">
                    <ul class="ps-4">
                        @foreach($form as $filter)
                            @php
                                $control_name = "fv_" . $filter->name;
                                $model_name = "values." . $filter->name;
                            @endphp
                            <li class="grid grid-cols-3 my-1">
                                <label class="label label-text">{{ $filter->label }}</label>
                                <div class="col-span-2 join border border-base-300 filter-item">
                                    @switch($filter->type)
                                        @case('text')
                                        @case('date')
                                        @case('email')
                                            <input
                                                autocomplete="off"
                                                x-model="{{ $model_name }}"
                                                id="{{ $control_name }}"
                                                type="{{ $filter->type }}"
                                                class="input input-sm w-full max-w-xs input-filter-item"
                                                @if($filter->pattern) pattern="{{ $filter->pattern }}" @endif
                                                x-on:keyup="form_valid = filter_form_{{ $name }}.checkValidity()"
                                            />
                                            @break
                                        @case('select')
                                            <select class="select select-sm w-full max-w-xs" x-model="{{ $model_name }}"
                                                    name="{{ $control_name }}" id="{{ $control_name }}">
                                                <option value="null"></option>
                                                @foreach($filter->options as $option)
                                                    <option
                                                        value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                                @endforeach
                                            </select>
                                            @break
                                        @default
                                    @endswitch
                                    <button type="button" class="btn btn-sm join-item"
                                            @click="$data.{{  $model_name  }} = null">x
                                    </button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </form>
                <div class="grid grid-cols-2 mt-2">
                    <x-cds::button
                        label="Limpiar"
                        class="w-6/12 btn-ghost btn-cds-action"
                        @click="$data.values = {}"
                    />
                    <x-cds::button
                        label="Filtrar"
                        class="w-6/12 btn-primary btn-cds-action"
                        @click="filter_form_{{ $name }}.checkValidity() ? $wire.filter(values) : false"
                        x-bind:disabled="!form_valid"
                    />
                </div>
            </div>
        </div>
    </div>
