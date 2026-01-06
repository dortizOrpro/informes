@php
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Number;use Src\Calculo\Domain\Enums\TipoCalculo;
@endphp

<div>
    <x-cds::loading/>


    <div class="grid grid-cols-12">

        {{--  COLUMNA PARAMETROS --}}
        <div class="col-span-3 bg-base-200 border-r-1 border-base-300" style="height: calc(100vh - 128px)">

            <div class="font-medium text-lg bg-base-300 py-2 border-b-1 border-base-200 px-2">
                <x-mary-icon name="carbon.parameter" label="Parámetros"/>
            </div>

            <div class="p-2">
                <div class="flex gap-4 px-4 pt-2">
                    <div class="flex-none w-1/4 text-start pt-2">Fecha Pago</div>
                    <div class="flex-none w-3/4">
                        <x-input wire:model.live="fechaPago" type="date" :omit-error="true"/>
                    </div>
                </div>
                <div class="flex gap-4 px-4 pt-2">
                    <div class="flex-none w-1/4 text-start pt-2">Fecha Cálculo</div>
                    <div class="flex-none w-3/4">
                        <p class="input text-end">{{ date('d/m/Y', strtotime($fechaCalculo)) }}</p>
                    </div>
                </div>
                <div class="flex gap-4 px-4 pt-2">
                    <div class="flex-none w-1/4 text-start pt-2">Tipo Cálculo</div>
                    <div class="flex-none w-3/4">
                        <x-select :options="$tiposCalculos" wire:model.live="tipoCalculo" class="w-full"
                                  :omit-error="true"></x-select>
                    </div>
                </div>
                @switch($tipoCalculo)
                    @case(TipoCalculo::RutAfiliado)
                        <div class="flex gap-4 px-4 pt-2">
                            <div class="flex-none w-1/4 text-start pt-2">R.U.T. Afiliado</div>
                            <div class="flex-none w-3/4">
                                <x-mary-input
                                    class="input text-end"
                                    wire:model="rutAfiliado"
                                    :disabled="$bloqueado"
                                    omit-error="true"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                        {{--                @break--}}
                    @case(TipoCalculo::RutDeudor)
                        <div class="flex gap-4 px-4 pt-2">
                            <div class="flex-none w-1/4 text-start pt-2">R.U.T. Deudor</div>
                            <div class="flex-none w-3/4">
                                <x-mary-input class="input text-end" wire:model="rutEmpleador"
                                              :disabled="count($afiliados) > 0" omit-error="true" autocomplete="off"/>
                            </div>
                        </div>
                        @break
                    @case(TipoCalculo::RitCausa)
                        <div class="flex gap-4 px-4 pt-2">
                            <div class="flex-none w-1/4 text-start pt-2">R.I.T. Causa</div>
                            <div class="flex-none w-3/4">
                                <x-mary-input class="input text-end" wire:model="ritCausa" :disabled="$bloqueado"
                                              omit-error="true" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="flex gap-4 px-4 pt-2">
                            <div class="flex-none w-1/4 text-start pt-2">Tribunal</div>
                            <div class="flex-none w-3/4">

                                <x-cds::choices-offline
                                    :options="$tribunales"
                                    wire:model="tribunalId"
                                    searchable="true"
                                    single="true"
                                    placeholder="Tribunal..."
                                    no-result-text="Sin resultados"
                                >
                                    @scope('item', $tribunal)
                                    <div class="truncate text-sm p-2 hover:bg-base-300">
                                        {{ $tribunal->name }}
                                    </div>
                                    @endscope
                                    @scope('selection', $tribunal)
                                    <div class="text-sm w-3xs" title="{{ $tribunal->name }}">
                                        <span class="truncate list-item">{{ $tribunal->name }}</span>
                                    </div>
                                    @endscope
                                </x-cds::choices-offline>

                            </div>
                        </div>
                        @break
                    @case(TipoCalculo::Cobranza)
                        <div class="flex gap-4 px-4 pt-2">
                            <div class="flex-none w-1/4 text-start pt-2">Cobranza</div>
                            <div class="flex-none w-3/4">
                                <x-mary-input class="input text-end" wire:model="cobranzaId" omit-error="true"
                                              :disabled="$bloqueado" autocomplete="off"/>
                            </div>
                        </div>
                        @break
                @endswitch
                <div class="grid grid-cols-2 gap-1 my-3">
                    <div class="">
                        <x-button label="Limpiar" wire:click="reiniciar()" class="w-full bg-base-300"/>
                    </div>
                    <div class="">
                        <x-button :disabled="$bloqueado" :label="count($afiliados)  > 0 ? 'Agregar' : 'Buscar'"
                                  wire:click="buscar()" class="btn btn-primary w-full"/>
                    </div>

                </div>

                <hr class="border-1 border-base-300"/>
                <div class="flex gap-4 px-4 pt-3">
                    <div class="flex-none w-1/4 text-start">U.F.</div>
                    <div class="flex w-3/4 justify-between">
                        <span>{{ Carbon::create($fechaCalculo)->format('d/m/Y') }}</span>
                        <span>$ {{ Number::format($uf,2,2,'de')}}</span>
                    </div>
                </div>
            </div>
            @if($errors->any() )
                <div>
                    <x-cds::notificacion type="error" title="Errores" icon="carbon.error-filled">
                        @foreach ($errors->all() as $message)
                            <p>{{ $message }}</p>
                        @endforeach
                    </x-cds::notificacion>
                </div>
            @endif
            <div class="font-medium text-lg bg-base-300 py-2 border-b-1 border-base-200 px-2">
                <x-mary-icon name="carbon.calculation-alt" label="Cálculos"/>
            </div>
            @if($isSoloCalculo)
                <div>
                    <x-cds::notificacion
                        type="warning"
                        title="Atención"
                        subtitle="Fecha de pago anterior a fecha actual solo permite cálculo."
                        icon="carbon.warning-alt-filled"
                        :dark="true"
                    />
                </div>
            @endif
            <div class="p-0">
                @foreach($calculos as $calculo => $valor)
                    <div class="flex gap-4 px-4 py-1">
                        <div class="flex-none w-1/4 text-start capitalize">{{ $calculo }}</div>
                        <div class="flex w-3/4 justify-between">
                            <span>&nbsp;</span>
                            {{--                        <span>{{ $valor }}</span>--}}
                            <span>$ {{ Number::format((float)$valor, precision: 0, locale:'de')}}</span>
                        </div>
                    </div>
                @endforeach
                <hr class="mx-3">
                <div class="flex gap-4 px-4 py-1">
                    <div class="flex-none w-1/4 text-start capitalize">Total a Pagar </div>{{-- $hasTabla --}}
                    <div class="flex w-3/4 justify-between">
                        <span>&nbsp;</span>
                        {{--                    <span>{{ $totalPago }}</span>--}}
                        <span>$ {{ Number::format($totalPago, precision: 0,locale:'de')}}</span>
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-2 gap-1 m-3">
                <div class="">
                    <x-cds::button label="Preingreso" class="btn-primary w-full" wire:click="abrirModalPreingreso"
                                   :disabled="$totalPago <= 0 || $bloqueado"/>
                </div>
                <div class="">
                    <x-cds::button label="Pagar" class="btn-primary w-full" wire:click="guardar()"
                                   :disabled="$totalPago <= 0 || $bloqueado"/>
                </div>
            </div>


        </div>
        {{--  FIN COLUMNA PARAMETROS --}}


        {{--  COLUMNA LISTADOS --}}
        <div class="col-span-9 text-start overflow-y-scroll" style="height: calc(100vh - 88px)">
            @if(isset($params['tipoCalculo']))
                <div>
                    @switch($tipoCalculo)
                        @case(\Src\Calculo\Domain\Enums\TipoCalculo::nulo)
                            @break

                        @case(\Src\Calculo\Domain\Enums\TipoCalculo::RutAfiliado)
                            <livewire:caja.afiliados.listado wire:model="afiliados"
                                                             :rut-empleador="(int)$rutEmpleador"/>
                            @break

                        @default
                            <livewire:calculo.detalle-cobranzas :tipo-calculo="$tipoCalculo" :params="$params"/>
                    @endswitch
                </div>
            @endif
        </div>

        {{-- FIN COLUMNA LISTADOS --}}

    </div>
    @if($pagar)
        <livewire:caja.pago-form :preingreso="$preingreso" :calculos="$calculos" :total-pago="$totalPago"/>
    @endif

    <livewire:preingreso.preingreso-form  />
    <x-toast />
</div>
