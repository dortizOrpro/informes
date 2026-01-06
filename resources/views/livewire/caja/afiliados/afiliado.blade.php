<div>
    <div @class(['flex border-b-1 border-base-300 hover:bg-base-200 text-sm','font-semibold bg-base-200'=>in_array($afiliado->rut_afiliado, $factores)])>
        <div class="p-2 w-2/12 flex justify-between">
            <x-button
                :icon="$expandida ? 'carbon.chevron-down':'carbon.chevron-right'"
                class="btn-xs bg-base-300"
                wire:click="expandir()"
            />
            <span>{{ \Src\Shared\Rules\Rut::format($afiliado->rut_afiliado) }}</span>
        </div>
        <div class="p-2 w-6/12">{{ $afiliado->nombre }} {{ $afiliado->ap_paterno }} {{ $afiliado->ap_materno }}</div>
        <div class="p-2 w-2/12"> - </div>
        <div class="p-2 w-2/12 flex justify-end">
            <span class="me-3">$ {{ \Illuminate\Support\Number::format($afiliado->monto,0,0,'de') }}</span>
            <div>
                <x-button
                    icon="carbon.row-delete" class="btn-xs bg-base-300"
                    wire:click="eliminar()"
                />
                <x-button
                    :icon="in_array($afiliado->rut_afiliado, $factores) ? 'carbon.subtract':'carbon.add'" class="btn-xs bg-base-300"
                    wire:click="seleccionar()"
                />
            </div>
        </div>
    </div>
    @if($expandida)
        <div class="ps-4 pb-4">
            <livewire:caja.afiliados.detalle-periodos :rut-afiliado="$afiliado->rut_afiliado" :rut-empleador="$afiliado->rut_empleador"/>
        </div>
    @endif
    {{-- DEtalle: Cobranza, resolucion, interno, perido, monto --}}


</div>
