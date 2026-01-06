<x-cds::modal
    title="Enviar preingreso"
    box-class="bg-base-300 max-w-3/5 top-[2rem] absolute"
    wire:model="modalPreIngreso"
    click-exit="$wire.cancel()"
    persistent="true"
>
    <div class="pb-16 px-2 overflow-y-scroll" style="max-height: calc(100vh - 16rem)">
        <h1 class="text-sm font-bold mb-2">Datos del destinatario</h1>
        <div class="grid grid-cols-2 gap-2 mb-4">
            <x-input label="Para" wire:model.defer="para" placeholder="Destinatario"/>
            <x-input label="E-mail" wire:model.defer="emailPreingreso" placeholder="correo@ejemplo.com"/>
        </div>

        <div x-data="{ mostrarCopia: @entangle('mostrarCopia') }">
            <div class="flex justify-end mb-2">
                <x-button label="Con copia" sm @click="mostrarCopia = !mostrarCopia"/>
            </div>
            <div x-show="mostrarCopia" x-transition class="grid grid-cols-2 gap-2 mb-4">
                <x-input label="Con copia a nombre" wire:model.defer="copia_nombre" placeholder="Nombre"/>
                <x-input label="Con copia a email" wire:model.defer="copia_email" placeholder="correo@ejemplo.com"/>
            </div>
        </div>

        {{--<div x-data="{ nota: @entangle('nota') }" class="mb-4">
            <x-toggle label="Nota en el correo" wire:model.defer="nota" on-label="Sí" off-label="No"/>
            <div x-show="nota" x-transition>
                <x-textarea label="Escriba la nota" wire:model.defer="nota_texto" placeholder="Nota Post Script que aparecerá en el correo" rows="4"/>
            </div>
        </div>--}}

        <x-textarea label="Motivo" wire:model.defer="motivo" placeholder="Motivo del envío" rows="3"/>

    </div>

    <x-slot:actions>
        <x-button label="Cancelar" wire:click="cancel()" class="btn-cds-action" wire:loading.attr="disabled"/>
        <x-button label="Enviar" class="btn-cds-action btn-primary" wire:click="pdfPreingreso()" wire:loading.attr="disabled"/>
    </x-slot:actions>
</x-cds::modal>
