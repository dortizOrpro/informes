@php
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Number;use Src\Calculo\Domain\Enums\TipoCalculo;
@endphp

<div class="grid grid-cols-12">
    <x-cds::loading/>
    <div class="col-span-3 bg-base-200 border-r-1 border-base-300" style="height: calc(100vh - 128px)">
        <div class="font-medium text-lg bg-base-300 py-2 border-b-1 border-base-200 px-2">
            <x-mary-icon name="carbon.parameter" label="Parámetros"/>
        </div>


        <div class="p-2">
            <div class="flex gap-4 px-4 pt-2">
                <div class="flex-none w-1/4 text-start pt-2">Fecha Pago</div>
                <div class="flex-none w-3/4">
                    <x-input wire:model.live="fechaPago" type="date"/>
                </div>
            </div>

            <div class="flex gap-4 px-4 pt-2">
                <div class="flex-none w-1/4 text-start pt-2">Tipo Cálculo</div>
                <div class="flex-none w-3/4">
                    <x-select :options="$tiposCalculos" wire:model.live="tipoCalculo" class="w-full"></x-select>
                </div>
            </div>
            @if($tipoCalculo > 0)
                <div class="flex gap-4 px-4 pt-3">
                    <div class="flex-none w-1/4 text-start pt-2">{{ $tipoCalculoLabel }}</div>
                    <div class="flex-none w-3/4">
                        <x-mary-input class="input text-end" wire:model="valor" :disabled="$bloqueado" autocomplete="off">
                            @if(!$bloqueado)
                                <x-slot:append>
                                    <x-cds::button tooltip="Buscar" class="btn btn-primary" icon="carbon.search"
                                                   wire:click="buscar()"/>
                                </x-slot:append>
                            @endif()
                        </x-mary-input>
                    </div>
                </div>

                @if($tipoCalculo === TipoCalculo::RitCausa->value)
                    <div class="flex gap-4 px-4 pt-1">
                        <div class="flex-none w-1/4 text-start pt-2">Tribunal</div>
                        <div class="flex-none w-3/4">
                            <x-select wire:model="aux" :options="$tribunales"/>

                        </div>
                    </div>
                @endif
            @endif

            <div class="flex gap-4 px-4 pt-3">
                <div class="flex-none w-1/4 text-start">U.F.</div>
                <div class="flex w-3/4 justify-between">
                    <span>{{ Carbon::create($fechaPago)->format('d/m/Y') }}</span>
                    <span>$ {{ Number::format($uf,2,2,'cl')}}</span>
                </div>
            </div>
        </div>
        @if($errors->any())
            <x-cds::notificacion title="Error" :subtitle="$errors->first()" type="error" icon="carbon.error-filled" dark="true"/>
        @endif
        <div class="font-medium text-lg bg-base-300 py-2 border-b-1 border-base-200 px-2">
            <x-mary-icon name="carbon.calculation-alt" label="Cálculos"/>
        </div>

        <div class="p-2">
            @foreach($calculos as $calculo => $valor)
                <div class="flex gap-4 px-4 pt-3">
                    <div class="flex-none w-1/4 text-start capitalize">{{ $calculo }}</div>
                    <div class="flex w-3/4 justify-between">
                        <span>&nbsp;</span>
                        <span>$ {{ Number::format($valor,2,2,'cl')}}</span>
                    </div>
                </div>
            @endforeach
            <hr>
            <div class="flex gap-4 px-4 pt-3">
                <div class="flex-none w-1/4 text-start capitalize">Total a Pagar</div>
                <div class="flex w-3/4 justify-between">
                    <span>&nbsp;</span>
                    <span>$ {{ Number::format(0,2,2,'cl')}}</span>
                </div>
            </div>
        </div>

        <div class="flex gap-4 px-4 pt-3">
            <div class="flex-none w-1/2 text-start capitalize">
                <x-cds::button label="Preingreso" class="btn-primary"/>
            </div>
            <div class="flex w-1/2">
                <x-cds::button label="Pagar" class="btn-primary"/>
            </div>
        </div>

</div>

    <div class="col-span-9  text-start" >
        <livewire:calculo.detalle-cobranzas wire:model="cobranzas" />
    </div>
</div>
