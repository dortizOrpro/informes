<?php

namespace Src\Calculo\Application\UseCases;

use Src\Calculo\Domain\Contracts\IndicadoresRepositoryContract;
use Src\Calculo\Domain\Entities\HonorarioCliente;

readonly class CalcularHonorariosUseCase
{
    public function __construct(private IndicadoresRepositoryContract $indicadoresRepository) {}

    public function run(string $producto, string $tramo, int $total, string $fechaPago, float $uf, string $moneda = 'CLF'): HonorarioCliente
    {
        // $uf = $this->indicadoresRepository->getUfByDay($fechaPago);
        $factorDiv = match ($moneda) {
            'CLF' => $uf,
            'CLP' => 1,
        };
        $precision = 2;
        $factorCalculado = $total / (float)$factorDiv;
        $factor = round($factorCalculado, $precision);
        //$factor = round(((float)$total / (int)$factorDiv));
        $factorHonorarios = $this->indicadoresRepository->getFactorHonorarios($producto, $tramo, $factor);
        $baseHonorarios = round($total * $factorHonorarios->porcentaje, 0);
        $honorario = match (true) {
            $baseHonorarios < $uf * $factorHonorarios->topeMinimo => round($uf * $factorHonorarios->topeMinimo),
            $baseHonorarios > $uf * $factorHonorarios->tramoMaximo => round($uf * $factorHonorarios->tramoMaximo),
            default => $baseHonorarios,
        };
        $procuradoria = $factorHonorarios->procuraduria * $honorario;

        return new HonorarioCliente(
            honorarios: $honorario,
            procuraduria: $procuradoria,
        );
//        return match (true) {
//            $honorarios < $uf * $factorHonorarios->topeMinimo => round($uf * $factorHonorarios->topeMinimo),
//            $honorarios > $uf * $factorHonorarios->tramoMaximo => round($uf * $factorHonorarios->tramoMaximo),
//            default => $honorarios,
//        };
    }
}
