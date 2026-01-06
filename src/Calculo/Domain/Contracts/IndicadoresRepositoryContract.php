<?php

namespace Src\Calculo\Domain\Contracts;

use Src\Calculo\Domain\Entities\FactorHonorarios;
use Src\Calculo\Domain\Entities\ValorSp;

interface IndicadoresRepositoryContract
{
    public function getUfByDay(string $date): float;

    public function getValorSp(string $fechaPago, string $periodo, string $fondo, int $administradora): ValorSp;

    public function getFactorHonorarios(string $producto, string $tramo, float $factorBusqueda): FactorHonorarios;

    public function getGastosByCobranza(int $cobranzaId): int;
}
