<x-layouts.nav>
    <x-cds::header
        title="Pago N° {{ $id }}"
        subtitle="Recaudación"

    >
    </x-cds::header>
    <livewire:caja.pago.comprobantes :headers="$headers" :comprobantes="$comprobantes"/>

</x-layouts.nav>
