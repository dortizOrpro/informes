<div>
    <modal wire:model="state" title="Enviar preingreso por correo" subtitle="Complete los campos para enviar">
        <x-form no-separator>

            <x-input label="Asunto" wire:model.defer="asunto" placeholder="Asunto del correo" readonly/>

            <div class="grid grid-cols-2 gap-2">
                <x-input label="Para" wire:model.defer="para" placeholder="Destinatario" />
                <x-input 
    label="E-mail" 
    wire:model.defer="emailPreingreso" 
    placeholder="correo@ejemplo.com"
/>
            </div>
            <div x-data="{ mostrarCopia: @entangle('mostrarCopia') }">
                <div class="flex justify-end">
                    <x-button label="Con copia" sm @click="mostrarCopia = !mostrarCopia"/>
                </div>
            
                <div x-show="mostrarCopia" x-transition class="grid grid-cols-2 gap-2">
                    <x-input label="Con copia a nombre" wire:model.defer="copia_nombre" placeholder="Nombre" />
                    <x-input label="Con copia a email" wire:model.defer="copia_email" placeholder="correo@ejemplo.com" />
                </div>
            </div>

            <div x-data="{ nota: @entangle('nota') }">
                <x-toggle 
                    label="Nota en el correo" 
                    wire:model.defer="nota" 
                    on-label="Sí" 
                    off-label="No" 
                />
                <div x-show="nota" x-transition class="mt-2">
                    <x-textarea 
                        label="Escriba la nota" 
                        wire:model.defer="nota_texto" 
                        placeholder="Nota Post Script que aparecerá en el correo"
                        rows="4"
                        style="resize: none;"
                    />
                </div>
            </div>

            <x-textarea style="resize: none;" label="Motivo" wire:model.defer="motivo" placeholder="Comentar el motivo del re envío del correo con la liquidación" />

            <x-slot:actions class="mb-3">
                <x-button label="Enviar" class="btn-primary" wire:click="pdfPreingreso()" wire:loading.attr="disabled" />
                <x-button label="Cancelar" @click="$wire.modalPreIngreso = false" wire:loading.attr="disabled" />
            </x-slot:actions>

        </x-form>
    </modal>
</div>
