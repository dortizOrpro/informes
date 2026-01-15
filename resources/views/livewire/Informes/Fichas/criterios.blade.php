<div>
    @switch($criterio)
        @case(2)
            <div class="grid grid-cols-3 gap-3 w-2xl px-8 pt-8">
                <div class="">
                    <x-select label="Estado" :options="$estados" wire:model="estado" placeholder="Estado..." />
                </div>
                <div class="">
                    <x-select label="Tipo" :options="$tipos" wire:model="tipo"
                              placeholder="Tipo..."/>
                </div>
                <div class="">
                    <x-input label="Resolución" class="text-end" type="text" wire:model="resolucion"  placeholder="Resolución..."/>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3 w-2xl px-8">
                    <div class="col-span-2">
                        <x-select label="Administradora" :options="$administradoras" wire:model="administradora"
                                  placeholder="Administradora..."/>
                    </div>
            </div>
        @break
        @case(3)
            <div class="grid grid-cols-2 gap-3 w-2xl px-8">
                    <div class="col-span-2">
                        <x-select label="Administradora" :options="$administradoras" wire:model="administradora"
                                  placeholder="Administradora..."/>
                    </div>
            </div>
        @break
    @endswitch

</div>


