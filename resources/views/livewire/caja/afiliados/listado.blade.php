<div class="border-1 border-base-300">
    <x-cds::loading/>
    <div class="flex bg-base-300 font-bold text-xs">
        <div class="p-2 w-2/12">R.U.T.</div>
        <div class="p-2 w-6/12">Nombre</div>
        <div class="p-2 w-2/12">-</div>
        <div class="p-2 w-2/12">Capital</div>
    </div>
    @foreach($listado as $afiliado)
        <livewire:caja.afiliados.afiliado :afiliado="$afiliado" :key="$afiliado->rut_afiliado"/>
    @endforeach

</div>
