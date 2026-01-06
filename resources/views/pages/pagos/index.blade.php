<x-layouts.nav>
    <x-cds::header
        title="Pagos"
        subtitle="Recaudación"

    >
        <x-slot:actions>
            <x-button label="Calcular" class="btn-primary" icon="carbon.calculation-alt" link="/caja"/>
        </x-slot:actions>
    </x-cds::header>

    <div class="">
        <livewire:pagos.listado/>
    </div>

</x-layouts.nav>
