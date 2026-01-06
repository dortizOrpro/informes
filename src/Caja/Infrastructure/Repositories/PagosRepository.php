<?php

namespace Src\Caja\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Src\Caja\Domain\Contracts\PagosRepositoryContract;
use Src\Calculo\Domain\Enums\TipoPago;

class PagosRepository implements PagosRepositoryContract
{

    public function listar($filter): array
    {
        return DB::table('recaudacion.pago')
            ->get()
            ->toArray();
    }

    public function guardar(TipoPago $tipoPago, string $preingreso, string $fecha, int $usuarioId, array $pago, array $calculos, array $detalle): bool
    {

        $registro = [
            'preingreso_id' => $preingreso,
            'rut' => (int)$pago['rut'],
            'nombres' => $pago['nombres'],
            'apaterno' => $pago['apPaterno'],
            'amaterno' => $pago['apMaterno'],
            'telefono' => $pago['telefono'],
            'email' => $pago['email'],
            'fecha' => $fecha,
            'agencia_id' => $pago['agencia_id'] ?? 0,
            'usuario_id' => $usuarioId,
            'tipopago_id' => $tipoPago,
            'detalles' => json_encode($detalle),
            'calculos' => json_encode($calculos),
        ];
        $id = DB::table('recaudacion.pago')->insertGetId($registro);
        DB::insert(
            '
            INSERT INTO recaudacion.comprobante (pago_id, cobranza_id, apago, honorarios, gastos)
            select
                p.id,
                cd.cobranza_id,
                sum(pd.apago) as pago,
                0 as honorarios,
                0 as gastos
            from recaudacion.pago p,
                 recaudacion.preingreso_detalle pd,
                 cobranzas.cobranza_deuda cd
            where p.id = :PAGO_ID
              and p.preingreso_id = pd.preingreso_id
              and cd.deuda_id = pd.deuda_id
              and cd.cobranza_id = pd.cobranza_id 
            group by p.id, cd.cobranza_id',
            ['PAGO_ID' => $id]
        );

        return $id;
    }

    public function guardarEstado(array $deudas, string $fecha, int $estadoId): bool
    {
        $registros = array_map(
            fn($deuda) => ['deuda_id' => $deuda['deuda_id'],'estado_id' => $estadoId, 'fecha' => $fecha],
            $deudas
        );
        return DB::table('recaudacion.deuda_estado')
            ->upsert(
                $registros,
                ['deuda_id'],
                ['fecha', 'estado_id']
            );
    }

    public function getComprobanteById(int $comprobanteId):object
    {


        $builder = DB::table('recaudacion.comprobante as c')
                    ->leftJoin('recaudacion.pago as p', 'p.id', '=', 'c.pago_id')
                    ->leftJoin('recaudacion.preingreso as pi', 'p.preingreso_id', '=', 'pi.uuid')
                    ->select(
                        'c.id as comprobante_id',
                        'c.cobranza_id',
                        'c.apago',
                        DB::raw("p.calculos->>'iva' as iva"),
                        DB::raw("p.calculos->>'gastos' as gastos"),
                        DB::raw("p.calculos->>'capital' as capital"),
                        DB::raw("p.calculos->>'recargo' as recargo"),
                        DB::raw("p.calculos->>'reajuste' as reajuste"),
                        DB::raw("p.calculos->>'subtotal' as subtotal"),
                        DB::raw("p.calculos->>'intereses' as intereses"),
                        DB::raw("p.calculos->>'honorarios' as honorarios"),
                        DB::raw("p.calculos->>'procuraduria' as procuraduria"),
                        'c.pago_id',
                        'p.tipopago_id',
                        'p.fecha',
                        'p.usuario_id',
                        'pi.id as preingreso_id',
                        'pi.uuid as preingreso_uuid'
                    )
                    ->where('c.id', $comprobanteId);
        
        return $builder->first();
    }

    public function getComprobanteDetalleById(int $comprobanteId): array
    {
        $builder = DB::table('recaudacion.comprobante as c')
            ->leftJoin('recaudacion.pago as p', 'p.id', '=', 'c.pago_id')
            ->leftJoin('recaudacion.preingreso_detalle as pd', function ($join) {
                $join->on('pd.preingreso_id', '=', 'p.preingreso_id')
                ->on('pd.cobranza_id', '=', 'c.cobranza_id');
            })
            ->leftJoin('remesas.deuda as d', 'pd.deuda_id', '=', 'd.id')
            ->selectRaw(
                'd.resolucion,d.periodo, sum(pd.capital) capital,sum(pd.intereses)intereses,sum(pd.reajuste)reajuste,sum(pd.recargo)recargo,sum(pd.apago)apago',
            )
            ->groupBy('d.resolucion','d.periodo')
            ->where('c.id', $comprobanteId);
        return $builder->get()->toArray();
    }

    public function getComprobantesByPagoId(int $pagoId): array
    {
        $builder = DB::table('recaudacion.comprobante as c')
            ->where('c.pago_id', $pagoId);
        return $builder->get()->toArray();
    }
}
