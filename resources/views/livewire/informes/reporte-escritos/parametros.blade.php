<div>
    <x-cds::loading />

    <div class="grid grid-cols-12">
        <div class="col-span-3 bg-base-200 border-r-1 border-base-300" style="height: calc(100vh - 128px)">
            <div class="font-medium text-lg bg-base-300 py-2 border-b-1 border-base-200 px-2">
                <x-mary-icon name="carbon.parameter" label="Parámetros" />
            </div>

            <div class="p-2">
                <div class="flex gap-4 px-4 pt-2">
                    <div class="flex-none w-1/4 text-start pt-2">
                        Fecha Desde
                    </div>

                    <div class="flex-none w-3/4">
                        <x-input type="date" wire:model.live="fecha_inicio" />
                    </div>
                </div>

                <div class="flex gap-4 px-4 pt-2">
                    <div class="flex-none w-1/4 text-start pt-2">
                        Fecha Hasta
                    </div>

                    <div class="flex-none w-3/4">
                        <x-input type="date" wire:model.live="fecha_fin" />
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-1 my-3">
                    <div>
                        <x-button label="Volver" link="{{ route('informes') }}" class="w-full" />
                    </div>

                    <div>
                        <x-button label="Reiniciar" wire:click="reiniciar()" class="w-full" />
                    </div>

                    <div>
                        <x-button label="Generar" wire:click="generar()" class="btn btn-primary w-full" />
                    </div>
                </div>

                <hr class="border-1 border-base-300" />
            </div>

            @if ($errors->any())
                <x-cds::notificacion title="Error" :subtitle="$errors->first()" type="error" icon="carbon.error-filled"
                    dark="true" />
            @endif
        </div>
    </div>
</div>
