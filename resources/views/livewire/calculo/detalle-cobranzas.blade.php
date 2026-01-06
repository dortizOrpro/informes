<div>
    @php
        use Src\Calculo\Domain\Enums\TipoCalculo;
        use Src\Shared\Rules\Rut;
        $referencia = $cobranzas[0] ?? [];
    @endphp
    <x-cds::loading/>

    @if($tipoCalculo !== TipoCalculo::nulo)
        <div class="sticky top-0">
            <div class="text-lg bg-base-300 py-2 border-1 border-base-200 px-2 flex justify-between">
                <div>
                    @switch($tipoCalculo)
                        @case(TipoCalculo::RutDeudor)
                            <span
                                class="pe-2">Deudor: {{ is_numeric($referencia?->rut_empleador ?? '') ? Rut::format($referencia?->rut_empleador) : '-' }}</span>
                            <span>{{ $referencia?->razon_social ?? '-' }}</span>
                            @break
                        @case(TipoCalculo::Cobranza)
                            <span>Cobranza: {{ $referencia?->id ?? '' }}</span>
                            @break
                        @case(TipoCalculo::RitCausa)
                            <span class="pe-2">Causa: {{ $referencia?->rit ?? '-' }}</span>
                            <span>{{ $referencia?->tribunal ?? '-' }}</span>
                            @break
                    @endswitch
                </div>
                <div>
{{--                    <x-cds::side-filter :form="$filters" name="filtro_calculo"/>--}}
                    <livewire:component.side-filter :form="$filters" description="Filtros" label="Cobranzas" name="filtro_calculo"/>
                </div>
            </div>
            <div class="flex bg-base-300 font-bold text-sm">
                <div class="p-3 w-2/12">Cobranza</div>
                <div class="p-3 w-2/12">Producto</div>
                <div class="p-3 w-8/12">Cliente</div>
            </div>
        </div>
        @foreach($cobranzas as $cobranza)
            <livewire:caja.cobranza :cobranza="$cobranza" :key="$cobranza->id"/>
        @endforeach
    @endif
</div>
