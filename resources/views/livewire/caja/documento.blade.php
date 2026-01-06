<div>
    <x-cds::loading/>
    <div @class(["flex border-1 border-base-300 hover:bg-base-200 text-sm","font-semibold bg-base-200"=>$seleccionado])>
        <div class="p-2 w-2/12 flex justify-between">
            <x-button
                :icon="$expandida ? 'carbon.chevron-down':'carbon.chevron-right'"
                class="btn-xs bg-base-300"
                wire:click="expandir()"
            />
            <span>{{ $documento->remesa_id }}</span>
        </div>
        <div class="p-2 w-4/12">{{ $documento->documento }}</div>
        <div class="p-2 w-4/12">{{ $documento->numero_interno }}</div>
        <div class="p-2 w-1/12">{{ \Illuminate\Support\Carbon::parse($documento->periodo)->format('m-Y') }}</div>
        <div class="flex p-2 justify-end w-2/12">
            <span class="me-3">$ {{ \Illuminate\Support\Number::format($documento->capital ?? 0,0,0,'de') }}</span>
            <x-button :icon="$marcarTodo ? 'carbon.add':'carbon.subtract'" class="btn-xs bg-base-300" wire:click="agregar()"/>
        </div>
    </div>
    @if($expandida)
        <div class="ps-4 pb-4">
            <livewire:calculo.detalle-afiliados :documento="$documento"/>
        </div>
    @endif
</div>
