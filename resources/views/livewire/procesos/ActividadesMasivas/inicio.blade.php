<div>
    <x-cds::loading/>
    <div class="grid grid-cols-3 gap-3 w-2xl px-8 pt-8">
        <div class="col-span-1">
            <x-select label="Tipo" :options="$tipos" wire:model.live="tipo"
                      placeholder="Tipo..."/>
        </div>
        <div class="col-span-2">
            <x-cds::choices-offline
                        wire:model.live="actividad"
                        name="selActividad"
                        label="Actividad"
                        right-content="id"
                        class-right="badge badge-neutral badge-outline"
                        :options="$actividades"
                        omit-error="true"
                        single="true"
                        searchable="true"
                        no-result-text="No se encontró actividad..."
                        :disabled="$deshabilitado"
                    >
                        @scope('item', $actividades)
                        <x-list-item :item="$actividades">
                            <x-slot:value>
                                <p>
                                    <span class="badge badge-primary badge-outline font-mono">
                                        {{ Str::padLeft($actividades->id % 1000,3,'0') }}
                                    </span>
                                    <span class="ps-1">{{ Str::afterLast($actividades->name,"\t") }}</span>
                                </p>
                            </x-slot:value>
                        </x-list-item>
                        @endscope
            </x-cds::choices-offline>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-3 w-2xl px-8">
            <div class="col-span-2">
                <x-file wire:model="excelCobranzas" label="Archivo"></x-file>
            </div>
            <div class="col-start-2 text-end">
                <x-cds::button class="btn-primary" label="Procesar" wire:click="procesar()"/>
            </div>
    </div>
    
</div>


