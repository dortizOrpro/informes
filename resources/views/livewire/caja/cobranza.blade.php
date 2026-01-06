<div>
    <div @class(["flex border-b-1 border-base-300 hover:bg-base-200", 'bg-base-200' => $expandida])>
        <div class="flex p-2 justify-between w-2/12">
            <x-button
                :icon="$expandida ? 'carbon.chevron-down':'carbon.chevron-right'"
                class="btn-xs bg-base-300"
                wire:click="expandir()"
            />
            <span>{{ $cobranza->id }}</span>
        </div>
        <div class="p-2 w-2/12">
            {{ $cobranza->producto_id }}
        </div>
        <div class="flex p-2 justify-between w-8/12">
            <span>{{ $cobranza->empresa }}</span>
            <x-button :icon="$marcarTodo ? 'carbon.add':'carbon.subtract'" class="btn-xs bg-base-300" wire:click="agregar()"/>
        </div>
    </div>
    @if($expandida)
        <div class="ps-4 pb-4 border-b-1 border-base-300">
            <livewire:calculo.detalle-documentos :cobranza="$cobranza->id" :key="$cobranza->id"/>
        </div>
    @endif
</div>
