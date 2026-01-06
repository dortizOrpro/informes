
<div @class(['flex border-b-1 border-base-300 hover:bg-base-200 text-sm','font-semibold bg-base-200'=>in_array($periodo->id, $factores)])>
    <div class="p-2 w-2/12 text-end">{{ $periodo->cobranza_id }}</div>
    <div class="p-2 w-3/12 text-end">{{ $periodo->resolucion }}</div>
    <div class="p-2 w-3/12 text-end">{{ $periodo->numero_interno }}</div>
    <div class="p-2 w-2/12 text-end">{{ \Illuminate\Support\Carbon::parse($periodo->periodo)->format('m-Y') }}</div>
    <div class="p-2 w-2/12 flex justify-end">
        <span class="me-3">$ {{ \Illuminate\Support\Number::format($periodo->monto,0,0,'de') }}</span>
        <span class="me-3">{{$periodo->estado}}</span>
        @php
            $aperturacionArray = json_decode($periodo->aperturacion, true) ?? [];
            $tieneAperturacion = count($aperturacionArray) > 0;
            $habilitaPago = $tieneAperturacion && (($periodo->estado_id ?? 0) === 100);
        @endphp

        @if($habilitaPago)
            <x-button
                :icon="in_array($periodo->id, $factores) ? 'carbon.subtract' : 'carbon.add'"
                class="btn-xs bg-base-300"
                wire:click="seleccionar()"
            />
        @else
            <x-icon :name="$icono[$periodo->estado_id] ?? 'carbon.user-access-locked'" />
        @endif
    </div>
</div>
