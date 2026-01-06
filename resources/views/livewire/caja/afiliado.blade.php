<div @class(['flex border-b-1 border-base-300 hover:bg-base-200 text-sm','font-semibold bg-base-200'=>in_array($afiliado->id, $factores)])>
    <div class="p-2 w-2/12 text-end">{{ \Src\Shared\Rules\Rut::format($afiliado->rut_afiliado) }}</div>
    <div class="p-2 w-6/12">{{ $afiliado->nombre }}</div>
    <div class="p-2 w-2/12">{{  \Illuminate\Support\Carbon::parse($afiliado->periodo)->format('m-Y')}}</div>
    <span class="p-2 w-2/12 text-end">$ {{ \Illuminate\Support\Number::format($afiliado->monto,0,0,'de') }}</span>
    <div class="p-2 w-2/12 text-end">{{$afiliado->estado}}</div>
    <div class="p-2 w-2/12 flex justify-end">
        @php
            $aperturacionArray = json_decode($afiliado->aperturacion, true) ?? [];
            $tieneAperturacion = count($aperturacionArray) > 0;
            $habilitaPago = $tieneAperturacion && (($afiliado->estado_id ?? 0) === 100);
        @endphp
        
        @if($habilitaPago)
            <x-button
                :icon="in_array($afiliado->id, $factores) ? 'carbon.subtract' : 'carbon.add'"
                class="btn-xs bg-base-300"
                wire:click="seleccionar()"
            />
        @else
            <x-icon :name="$icono[$afiliado->estado_id] ?? 'carbon.user-access-locked'" />
        @endif
    </div>
</div>

{{--
    <div class="p-2 w-2/12 flex justify-end">
        @if(($afiliado->estado_id ?? 0) === 100)
            <x-button
                :icon="in_array($afiliado->id, $factores) ? 'carbon.subtract':'carbon.add'"
                class="btn-xs bg-base-300"
                wire:click="seleccionar()"
            />
        @else
            <x-icon :name="$icono[$afiliado->estado_id] ?? 'carbon.document-blank'"/>
        @endif
    </div>
--}}