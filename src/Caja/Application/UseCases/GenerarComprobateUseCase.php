<?php

namespace Src\Caja\Application\UseCases;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Src\Caja\Domain\Contracts\CobranzasRepositoryContract;
use Src\Caja\Domain\Contracts\PagosRepositoryContract;
use Src\Shared\Rules\Rut;

readonly class GenerarComprobateUseCase
{
    public function __construct(
        private CobranzasRepositoryContract $cobranzasRepository,
        private PagosRepositoryContract $pagosRepository,
    ) {}

    public function run(int $comprobanteId): string
    {
        $comprobante = $this->pagosRepository->getComprobanteById($comprobanteId);
        $cobranza = $this->cobranzasRepository->getById($comprobante->cobranza_id);
        $cabecera = array_merge((array) $comprobante,(array) $cobranza);
        $cabecera['rut'] = Rut::format($cobranza->rut_empleador);
        $cabecera['fecha'] = Carbon::create($comprobante->fecha)->timezone('America/Santiago')->format('d-m-Y H:i:s');
        $detalle = $this->pagosRepository->getComprobanteDetalleById($comprobanteId);
        $logo = view('livewire.preingreso.pdf.logo')->render();
        $ruta = "comprobantes/comprobante_$comprobanteId.pdf";
        $pdf = PDF::loadView('caja::comprobante.index',[
            'cabecera' => $cabecera,
            'detalle' => $detalle,
            'logo'=>$logo,
        ]);
        $pdf->setPaper('Letter', 'portrait');
        Storage::put($ruta, $pdf->output());
        //$pdf->save(storage_path("public/$ruta"));
        return $ruta;
    }
}
