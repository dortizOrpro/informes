@php
    use Illuminate\Support\Number;use Src\Calculo\Domain\Enums\ModoCalculo;
@endphp
<div>
    <div class="grid grid-cols-3 gap-3 w-2xl px-8 pt-8">
        <div class="">
            <x-input label="Periodo" type="month" wire:model="periodo"/>
        </div>
        <div class="">
            <x-input label="Fecha pago" type="date" wire:model.live="fechaPago"/>
        </div>
        <div class="">
            <x-input label="U.F." class="text-end" type="text" wire:model="uf" prefix=" $ " disabled readonly/>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-3 w-2xl px-8">
        <div class="col-span-2">
            <x-select label="Administradora" :options="$administradoras" wire:model="administradora"
                      placeholder="Administradora..."/>
        </div>

        <!-- Modo calculo -->
        <div class="col-span-2">
            <x-radio label="Modalidad calculo" wire:model.live="modoCalculo" :options="$modo" inline/>
        </div>

        @switch($modoCalculo)
            @case(ModoCalculo::fondo)
                <div class="">
                    <x-select label="Fondo" :options="$fondos" wire:model="fondo01" placeholder="Fondo..."/>
                </div>
                <div class="">
                    <x-input label="Capital" type="text" wire:model="capital01" prefix=" $ " class="text-end"/>
                </div>

                <div class="">
                    <x-select label="" :options="$fondos" wire:model="fondo02" placeholder="Fondo..."/>
                </div>
                <div class="">
                    <x-input label="" type="text" wire:model="capital02" prefix=" $ " class="text-end"/>
                </div>
            @break
            @case(ModoCalculo::porcentaje)
                <div class="col-start-2">
                    <x-input label="Capital Total" type="text" wire:model="capital01" prefix=" $ " class="text-end"/>
                </div>

                <div class="">
                    <x-select label="Fondo" :options="$fondos" wire:model="fondo01" placeholder="Fondo..."/>
                </div>
                <div class="">
                    <x-input label="Porcentaje" type="text" wire:model="pct01" suffix=" % " class="text-end" />
                </div>

                <div class="">
                    <x-select label="" :options="$fondos" wire:model="fondo02" placeholder="Fondo..."/>
                </div>
                <div class="">
                    <x-input label="" type="text" wire:model="pct02" suffix=" % " class="text-end" />
                </div>
                @break
        @endswitch

        @if($errors->any())
            <div class="col-span-2">
                <x-cds::notificacion title="Error en los datos ingresados" type="error" icon="carbon.error-filled"
                                     dark="true">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </x-cds::notificacion>
            </div>
        @endif

<div class="col-start-2 text-end">
    <x-cds::button class="btn-primary" label="Calcular" wire:click="calcular()"/>
</div>
</div>

    <div class="w-2xl p-8">
        <div wire:loading class="p-8">Calculando...</div>
        @foreach($resultados as $key => $resultado)
            <div class="collapse bg-base-100 border-base-300 border" :key="$key">
                <input type="checkbox" />
                <div class="collapse-title font-semibold">
                    <div class="flex justify-between">
                        <span>Fondo {{ $resultado['fondo'] }}</span>
                        <span>$ {{ Number::format($resultado['deuda'], precision: 0, locale: 'de') }}</span>
                    </div>
                </div>
                <div class="collapse-content text-sm">
                    <div class="grid grid-cols-2">
                    @foreach($resultado as $label => $item)
                        @if(is_numeric($item))

                                <div class="bg-base-200 p-2 border border-base-300 uppercase">{{ $label }}</div>
                                <div
                                    class="text-end p-2 border border-base-300">
                                    $ {{ Number::format($item, precision: 2, locale: 'de') }}</div>

                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        @endforeach

    </div>

{{--   <xmp>{{ print_r($resultados, true) }}</xmp>--}}

{{--@foreach($resultados as $label => $item)--}}
{{--    <div class="bg-base-200 p-2 border border-base-300 uppercase">{{ $label }}</div>--}}
{{--    <div--}}
{{--        class="text-end p-2 border border-base-300">--}}
{{--        $ {{ Number::format($item, precision: 0, locale: 'de') }}</div>--}}
{{--@endforeach--}}


</div>
