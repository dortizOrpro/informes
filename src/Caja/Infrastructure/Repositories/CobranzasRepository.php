<?php

namespace Src\Caja\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Src\Caja\Domain\Contracts\CobranzasRepositoryContract;
use Src\Calculo\Domain\Enums\TipoCalculo;
use Illuminate\Database\Query\Builder;

class CobranzasRepository implements CobranzasRepositoryContract
{
    public function getByRut(int $rut): array
    {
        $resultado = DB::table('cobranzas.cobranza as c')
            ->leftJoin('gui.empresa as e', 'e.id', '=', 'c.cliente')
            ->where('c.rut_empleador', $rut)
            ->select('c.id', 'e.empresa', 'c.producto_id')
            ->get()
            ->toArray();

        return $resultado;
    }

    public function getByCriterio(TipoCalculo $criterio, array $busqueda): array
    {
        Log::info("getByCriterio", $busqueda);
        $builder = DB::table('cobranzas.cobranza as c')
            ->leftJoin('gui.empresa as e', 'e.id', '=', 'c.cliente');

        match ($criterio) {
            TipoCalculo::RutDeudor => $builder
                ->where('c.rut_empleador', (int) $busqueda['rutEmpleador'])
                ->select(
                    'c.id',
                    'e.empresa',
                    'c.producto_id',
                    'c.rut_empleador',
                    DB::raw('(select r.razon_social from remesas.empleador as r where r.rut = c.rut_empleador limit 1) as razon_social')
                ),

            TipoCalculo::Cobranza => $builder
                ->where('c.id', (int) $busqueda['cobranzaId'])
                ->select(
                    'c.id',
                    'e.empresa',
                    'c.producto_id'
                ),
            TipoCalculo::RutAfiliado => $builder
                ->join('cobranzas.cobranza_deuda as cd', 'cd.cobranza_id', '=', 'c.id')
                ->join('remesas.deuda as d', 'cd.deuda_id', '=', 'd.id')
                ->where('d.rut_afiliado', (int) $busqueda['rutAfiliado']),
            TipoCalculo::RitCausa => $builder
                ->join('cobranzas.cobranza_causa as cc', 'cc.cobranza_id', '=', 'c.id')
                ->join('pjud.causa as ca', 'cc.causa_id', '=', 'ca.id')
                ->leftJoin('gui.tribunal as t', 'ca.tribunal_id', '=', 't.id')
                ->where('ca.rit', $busqueda['ritCausa'])
                ->where('ca.tribunal_id', (int) $busqueda['tribunalId'])
                ->select(
                    'c.id',
                    'e.empresa',
                    'c.producto_id',
                    'c.rut_empleador',
                    'ca.rit',
                    't.tribunal',
                ),
        };
        $valoresFiltro = $busqueda['filters'] ?? [];
        foreach ($this->filtros() as $field => $value) {
            $builder->when($valoresFiltro[$field] ?? false, $value);
        }
        //array_map(function ($item) {}, $busqueda['filters']);

        return $builder->get()->toArray();
    }

    private function filtros()
    {
        return [
            'categoria_id' => fn (Builder $query, array $id) => $query->whereIn('c.categoria_id', $id),
            'cliente_id' => fn (Builder $query, array $id) => $query->whereIn('e.spensiones_empresa_id', $id),
        ];
    }
    public function getDocumentosByCobranza(int $cobranza): array
    {
        $builder = DB::table('cobranzas.cobranza_deuda as cd')
            ->join('remesas.deuda as d', 'd.id', '=', 'cd.deuda_id')
            ->select(
                'cd.cobranza_id',
                'd.remesa_id',
                'd.resolucion as documento',
                'd.periodo',
                'd.numero_interno',
                DB::raw('SUM(d.monto) as capital'),
                DB::raw("format('%s/%s/%s/%s', d.remesa_id ,d.resolucion, d.numero_interno, d.periodo ) as id")
            )
            ->groupBy('cd.cobranza_id', 'd.remesa_id', 'd.resolucion', 'd.numero_interno', 'd.periodo')
            ->where('cd.cobranza_id', $cobranza)
            ->get();

        return $builder->toArray();
    }

    public function getAfiliadosByDocumento(int $remesa, string $resolucion, string $periodo, string $interno): array
    {
        $builder = DB::table('remesas.deuda as d')
            ->join('remesas.afiliado as a', function ($join) {
                $join
                    ->on('a.remesa_id', '=', 'd.remesa_id')
                    ->on('a.resolucion_id', '=', 'd.resolucion')
                    ->on('a.rut', '=', 'd.rut_afiliado');
            })
            ->join('gui.cliente as c', 'c.id', '=', 'd.tipo_producto')
            ->leftJoin('recaudacion.deuda_estado as de', 'd.id', '=', 'de.deuda_id')
            ->join('gui.estado_documento as ed', 'ed.id', '=', 'de.estado_id')
            ->where('d.remesa_id', $remesa)
            ->where('d.resolucion', $resolucion)
            ->where('d.periodo', $periodo)
            ->where('d.numero_interno', $interno)
            ->select(
                'd.id',
                'd.tipo_producto as producto_uid',
                'c.sp_id',
                'd.rut_afiliado',
                'd.periodo',
                'd.monto',
                'a.nombre',
                'a.ap_paterno',
                'a.ap_materno',
                'de.estado_id as estado_id',
                'ed.estado as estado',
                DB::raw('array_to_json(array(select to_jsonb(da.*) from remesas.aperturacion da where da.deuda_id = d.id)) as aperturacion'),
            )
            ->get();
            
        return $builder->toArray();
    }

    public function getEmpleadorByRut(int $rut): array
    {
        return (array)DB::table('remesas.empleador as r')
            ->where('r.rut', $rut)
            ->select('r.rut','r.razon_social')
            ->first();
    }

    public function getAfiliadoByRut(array $rutAfiliados, int $rutEmpleador): array
    {

        return DB::table('remesas.deuda as d')
            ->leftJoin('remesas.afiliado as a', 'a.rut', '=', 'd.rut_afiliado')
            ->leftJoin('recaudacion.deuda_estado as de', 'd.id', '=', 'de.deuda_id')
            ->whereIn('d.rut_afiliado', $rutAfiliados)
            ->where('d.rut_empleador', $rutEmpleador)
            ->select(DB::raw('distinct on (d.rut_afiliado) d.rut_afiliado'),'d.rut_afiliado', 'a.nombre', 'a.ap_paterno', 'a.ap_materno',
                DB::raw('0 as monto'),
                'd.rut_empleador',
                'de.estado_id'
            )
            ->orderBy(DB::raw('d.rut_afiliado, length(a.nombre)'), 'desc')
            ->get()
            ->toArray();
    }

    public function getDeudaByAfiliado(int $rutAfiliado, int $rutEmpleador): array
    {
        
        return DB::table('remesas.deuda as d')
            ->select(
                DB::raw('distinct on(d.id) d.id'),
                'cd.cobranza_id',
                'd.resolucion',
                'd.periodo',
                'd.numero_interno',
                'd.monto',
                'c.sp_id',
                'd.tipo_producto as producto_uid',
                'd.rut_afiliado',
                'de.estado_id as estado_id',
                'ed.estado as estado',
                DB::raw('array_to_json(array(select to_jsonb(da.*) from remesas.aperturacion da where da.deuda_id = d.id)) as aperturacion')
            )
            ->leftJoin('cobranzas.cobranza_deuda as cd', 'd.id', '=', 'cd.deuda_id')
            ->leftJoin('gui.cliente as c', 'c.id', '=', 'd.tipo_producto')
            ->leftJoin('recaudacion.deuda_estado as de', 'd.id', '=', 'de.deuda_id')
            ->leftJoin('gui.estado_documento as ed', 'ed.id', '=', 'de.estado_id')
            ->where('d.rut_afiliado', $rutAfiliado)
            ->where('d.rut_empleador', $rutEmpleador)
            ->where('cd.cobranza_id', '>', 0)
            ->orderBy('d.id', 'desc')
            ->orderBy('d.periodo', 'desc')
            ->orderBy('cd.cobranza_id', 'desc')
            ->get()
            ->toArray();
    }

    public function getById(int $cobranzaId): object
    {
        $builder = DB::table('cobranzas.cobranza as c')
            ->leftJoin('cobranzas.cobranza_agencia as ca', 'c.id', '=', 'ca.cobranza_id')
            ->leftJoin('gui.agencia as a', 'ca.agencia_id', '=', 'a.id')
            ->leftJoin('gui.empresa as e', 'c.cliente', '=', 'e.id')
            ->leftJoin('remesas.empleador as re', 're.rut', '=', 'c.rut_empleador')
            ->select(
                'c.id',
                'ca.agencia_id',
                'a.agencia',
                'c.cliente',
                'c.producto_id',
                'e.alias',
                'c.rut_empleador',
                're.razon_social',
            )
            ->where('c.id', $cobranzaId);
        return $builder->first();
    }
}

/**
 * DEtalle: Cobranza, resolucion, interno, perido, monto
 * select *
 * from remesas.deuda d
 * left join cobranzas.cobranza_deuda cd on (cd.deuda_id = d.id)
 * where d.rut_afiliado = :rutAfiliado
 * and d.rut_empleador = :rutEmpleador
 * and cd.cobranza_id is not null
 * order by d.periodo desc
 */
