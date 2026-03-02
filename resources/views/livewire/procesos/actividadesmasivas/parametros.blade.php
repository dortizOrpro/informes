<div>
    <div class="grid grid-cols-12">
        <div class="col-span-2 bg-base-200 border-r-1 border-base-300" style="height: calc(100vh - 128px)">
            @if($errors->any())
                <x-cds::notificacion title="Error" :subtitle="$errors->first()" type="error" icon="carbon.error-filled" dark="true"/>
            @endif
        </div>

        <div class="grid grid-cols-12">
            <div class="col-span-9  text-start" style="height: calc(100vh - 128px)">
                <livewire:procesos.actividades-masivas.parametros/>
            </div>
        </div>
    </div>
</div>
    

