<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerarPdfPreingresoService
{   

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function pdf(string $uuid, array $calculo, $a_pago): ?string
    {
        $preingreso = $this->getPreingreso($uuid);

        if (!$preingreso) {
            Log::warning("No se encontró preingreso con uuid: {$uuid}");
            return null;
        }

        $detalle = $this->getDetallePreingreso($uuid);
        $cobranza = $detalle[0]->cobranza;
        $empleador = $this->getEmpleador($cobranza);

        $pdf = Pdf::loadView('livewire.preingreso.pdf.main', [
            'preingreso'   => $preingreso->id,
            'a_pago'       => $a_pago,
            'totales'      => (object) $calculo,
            'vencimiento'  => $preingreso->vencimiento,
            'detalle'      => $detalle,
            'empleador'    => $empleador,
            'qr'           => $this->generarQr($preingreso->id),
            'urlQr'        => $preingreso->id,
        ])->setPaper('letter');

        $pdf->save("{$preingreso->id}.pdf", 'pdf');

        return $preingreso->id;
    }


    private function getPreingreso(string $uuid): ?object
    {
        return DB::table('recaudacion.preingreso')
            ->where('uuid', $uuid)
            ->first();
    }


    private function getDetallePreingreso(string $uuid): \Illuminate\Support\Collection
    {
        
        $pdAgg = DB::table('recaudacion.preingreso_detalle')
            ->select('deuda_id')
            ->selectRaw('SUM(COALESCE(capital,0)) as capital')
            ->selectRaw('SUM(COALESCE(reajuste,0)) as reajuste')
            ->selectRaw('SUM(COALESCE(intereses,0)) as intereses')
            ->selectRaw('SUM(COALESCE(recargo,0)) as recargo')
            ->selectRaw('SUM(COALESCE(apago,0)) as apago')
            ->where('preingreso_id', $uuid)
            ->groupBy('deuda_id');

        $query = DB::query()
            ->fromSub($pdAgg, 'pd_agg')
            ->select([
                DB::raw("TO_CHAR(d.periodo, 'MM/YYYY') as periodo"),
                'd.resolucion',
                'cd.cobranza_id as cobranza',
                'e.alias as cliente',
                'pd_agg.capital',
                'pd_agg.reajuste',
                'pd_agg.intereses',
                'pd_agg.recargo',
                'pd_agg.apago',
            ])
            ->join('remesas.deuda as d', 'pd_agg.deuda_id', '=', 'd.id')
            ->join('cobranzas.cobranza_deuda as cd', 'pd_agg.deuda_id', '=', 'cd.deuda_id')
            ->join(DB::raw("
                LATERAL (
                    SELECT r.remesa_id, r.periodo, r.resolucion, r.cliente
                    FROM remesas.resolucion r
                    WHERE r.remesa_id = d.remesa_id
                      AND r.periodo = d.periodo
                      AND r.resolucion = d.resolucion
                      AND r.planilla = d.planilla
                    LIMIT 1
                ) AS r
            "), DB::raw('TRUE'), '=', DB::raw('TRUE'))
            ->join('gui.empresa as e', 'e.id', '=', 'r.cliente')
            ->get();
        return $query;
    }

    private function getEmpleador($cobranza)
    {
        $empleador = DB::table('cobranzas.cobranza as c')
        ->join('remesas.empleador as e', 'c.rut_empleador', '=', 'e.rut')
        ->where('c.id', $cobranza)
        ->groupBy('c.id', 'c.rut_empleador')
        ->select(
            'c.id',
            'c.rut_empleador',
            DB::raw('MAX(e.rut) as rut_empleador_real'),
            DB::raw('MAX(e.razon_social) as razon_social')
        )
        ->get();

        return $empleador;
    }

    

    private function generarQr(string $id): string
    {
        return 'data:image/svg+xml;base64,' . base64_encode(
            QrCode::size(72)->generate($id)
        );
    }
}
