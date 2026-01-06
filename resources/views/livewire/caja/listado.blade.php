<div>
    @switch($tipoCalculo)
        @case(\Src\Calculo\Domain\Enums\TipoCalculo::nulo)
        @break

        @case(\Src\Calculo\Domain\Enums\TipoCalculo::RutAfiliado)
            <h1>Por afiliado</h1>
        @break

        @default
            <livewire:calculo.detalle-cobranzas :tipo-calculo="$tipoCalculo" :params="$params" />
    @endswitch
</div>
