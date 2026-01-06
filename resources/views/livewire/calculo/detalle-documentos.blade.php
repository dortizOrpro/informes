<div class="">
    <x-cds::loading/>
    <div class="flex bg-base-300 font-bold text-xs">
        <div class="p-2 w-2/12">Remesa</div>
        <div class="p-2 w-3/12">Documento</div>
        <div class="p-2 w-3/12">N° Interno</div>
        <div class="p-2 w-2/12">Periodo</div>
        <div class="p-2 w-2/12">Capital</div>
    </div>
    @foreach($documentos as $documento)
        <livewire:caja.documento :documento="$documento" :key="$documento->id"/>
    @endforeach
</div>
