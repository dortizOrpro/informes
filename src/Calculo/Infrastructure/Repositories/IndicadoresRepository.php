<?php

namespace Src\Calculo\Infrastructure\Repositories;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Src\Calculo\Domain\Contracts\IndicadoresRepositoryContract;
use Src\Calculo\Domain\Entities\FactorHonorarios;
use Src\Calculo\Domain\Entities\ValorSp;

class IndicadoresRepository implements IndicadoresRepositoryContract
{
    public function getUfByDay(string $date): float
    {
        $resultado = DB::table('recaudacion.valor_uf')
            ->where('fecha', $date)
            ->get();

        return $resultado[0]->valor ?? 0;
    }

    public function getValorSp(string $fechaPago, string $periodo, string $fondo, int $administradora): ValorSp
    {
        $resultado = DB::table('recaudacion.reajuste_afpafc')
            ->where('fecha_pago', $fechaPago)
            ->where('periodo', Carbon::create($periodo)->setDay(1)->format('Y-m-d'))
            ->where('fondo', $fondo)
            ->where('sp_id', $administradora)
            ->get();

        return new ValorSp(
            fechaPago: $fechaPago,
            periodo: $periodo,
            fondo: $fondo,
            administradora: $administradora,
            rentabilidad: $resultado[0]->rentabilidad ?? 0,
            interes: $resultado[0]->interes ?? 0,
            factorReajuste: $resultado[0]->factor_reajuste ?? 0,
            factorInteres: $resultado[0]->factor_interes ?? 0,
            recargo: $resultado[0]->recargo ?? 0,
            factorGeneral: $resultado[0]->factor_rir ?? 0,
            existe: $resultado[0]->existe ?? 0,
        );
    }

    public function getFactorHonorarios(string $producto, string $tramo, float $factorBusqueda): FactorHonorarios
    {
        $factor = DB::table('recaudacion.factor_honorarios')
            ->where('producto', $producto)
            ->where('tramo', $tramo)
            ->where('tramo_minimo', '<=', $factorBusqueda)
            ->where('tramo_maximo', '>', $factorBusqueda)
            ->first();

        return new FactorHonorarios(
            producto: $producto,
            tramo: $tramo,
            tramoMoneda: $factor->tramo_moneda ?? 'CLP',
            tramoMinimo: $factor->tramo_minimo ?? 0,
            tramoMaximo: $factor->tramo_maximo ?? PHP_FLOAT_MAX,
            porcentaje: ($factor->porcentaje ?? 0) / 100,
            topeMoneda: $factor->tope_moneda ?? 'CLP',
            topeMinimo: $factor->tope_minimo ?? 0,
            topeMaximo: $factor->tope_maximo ?? PHP_FLOAT_MAX,
            procuraduria: $factor->procuraduria ?? 0,
        );
    }

    public function getGastosByCobranza(int $cobranzaId): int
    {
        $gasto = DB::table('encargos.encargo_gastos')
            ->where('cobranza_id', $cobranzaId)
            ->first();

        return $gasto?->valor ?? 0;
    }
}
