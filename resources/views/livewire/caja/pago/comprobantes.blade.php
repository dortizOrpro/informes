<div>
    <x-cds::data-table :headers="$headers" :rows="$comprobantes" >
        @scope('cell_agencia_id', $comprobante)
        ({{$comprobante['agencia_id']}}) {{$comprobante['agencia']}}
        @endscope

        @scope('cell_cliente', $comprobante)
        {{\Src\Shared\Rules\Rut::format($comprobante['rut_empleador'])}} {{$comprobante['razon_social']}}
        @endscope
        @scope('cell_apago', $comprobante)
        {{ round($comprobante['apago'] + $comprobante['honorarios'] +   $comprobante['gastos'] ) }}
        @endscope
        @scope('actions', $comprobante)
        <x-button label="Descargar" wire:click="descargar({{$comprobante['id']}})"  spinner class="btn-sm"/>
        @endscope
</x-cds::data-table>
</div>
