<div class="border-1 border-base-300">
    <x-cds::loading/>
        <div class="flex bg-base-300 font-bold text-xs">
            <div class="p-2 w-2/12">R.U.T.</div>
            <div class="p-2 w-6/12">Nombre</div>
            <div class="p-2 w-2/12">Periodo</div>
            <div class="p-2 w-2/12">Capital</div>
            <div class="p-2 w-2/12">Estado</div>
        </div>
        @if(count($afiliados) === 0)
            <div class="flex bg-base-300 font-bold text-sm w-full">
                <h1 class="w-full bg-base-200 p-2">
                    <x-icon name="carbon.warning-alt-filled" label="Sin Afiliados"/>
                </h1>
            </div>
        @endif
        @foreach($afiliados as $afiliado)
            <livewire:caja.afiliado
                :documento="$documento"
                :afiliado="$afiliado"
                :key="$afiliado->rut_afiliado"
                wire:model="tick"
            />
        @endforeach

</div>
