<?php

namespace Src\Caja\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Src\Caja\Domain\Contracts\DocumentosRepositoryContract;

class DocumentosRepository implements DocumentosRepositoryContract
{
    public function getByCobranza(int $cobranza): array
    {
        $builder = DB::table('cobranzas.cobranza_deuda as cd')
            ->join('remesas.deuda as d', 'd.id', '=', 'cd.deuda_id')
            ->select(
                'd.resolucion as documento',
                'd.periodo',
                'd.numero_interno',
                DB::raw('SUM(d.monto) as capital'),
                DB::raw("format('%s/%s/%s/%s', d.remesa_id ,d.resolucion, d.numero_interno, d.periodo ) as id")
            )
            ->groupBy('d.remesa_id', 'd.resolucion', 'd.numero_interno', 'd.periodo')
            ->where('cd.cobranza_id', $cobranza)
            ->get();

        return $builder->toArray();
    }
}
