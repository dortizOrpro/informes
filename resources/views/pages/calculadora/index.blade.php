<x-layouts.nav>
    <x-cds::header
        title="Calculadora"
        subtitle="Recaudación"

    >
        {{--        <x-slot:actions>--}}
        {{--            <x-button label="Calcular" class="btn-primary" icon="carbon.calculation-alt"/>--}}
        {{--        </x-slot:actions>--}}
    </x-cds::header>

    <div class="grid grid-cols-12">
        <div class="col-span-3 bg-base-200 border-r-1 border-base-300" style="height: calc(100vh - 128px)">
            <p>&nbsp;</p>
        </div>
        <div class="col-span-9  text-start" style="height: calc(100vh - 128px)">
            <livewire:calculadora.calculadora/>
        </div>
    </div>

</x-layouts.nav>
