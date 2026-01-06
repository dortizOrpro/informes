<?php

namespace Src\Calculo\Application\UseCases;

use Src\Calculo\Domain\Contracts\IndicadoresRepositoryContract;

readonly class ActualizarDeudaUseCase
{
    public function __construct(private IndicadoresRepositoryContract $indicadoresRepository) {}

    public function run(string $fechaPago, float $uf, string $periodo, int $administradora, array $deudas): array
    {
        $resultado  = [];
        foreach ($deudas as $deuda) {
            $factores = $this->indicadoresRepository->getValorSp($fechaPago, $periodo, $deuda['fondo_id'], $administradora);
            $reajuste = $factores->factorReajuste * (float)$deuda['monto'] * $uf;
            $resultado[]= [
                'fondo' => $deuda['fondo_id'],
                'capital' => $deuda['monto'],
                'reajuste' => $reajuste - $deuda['monto'],
                'intereses' => $reajuste * $factores->factorInteres,
                'recargo' => $reajuste * $factores->recargo,
                'deuda' => $factores->factorGeneral * (float)$deuda['monto'] * $uf,
            ];
        }
        $resultado[] = [
            'fondo' => "Total",
            'capital' => (float) array_sum(array_column($resultado, 'capital')),
            'reajuste' => (float) array_sum(array_column($resultado, 'reajuste')),
            'intereses' => (float) array_sum(array_column($resultado, 'intereses')),
            'recargo' => (float) array_sum(array_column($resultado, 'recargo')),
            'deuda' => (float) array_sum(array_column($resultado, 'deuda')),
        ];

        return $resultado;
    }

//    public function run(int $deuda, string $fechaPago, float $uf, string $periodo, string $fondo, int $administradora): array
//    {
//        $factores = $this->indicadoresRepository->getValorSp($fechaPago, $periodo, $fondo, $administradora);
//        $reajuste = $factores->factorReajuste * $deuda * $uf;
//
//        return array_merge([
//            'uf' => $uf,
//            'capital' => $deuda,
//            'reajuste' => $factores->factorReajuste * $deuda * $uf,
//            'intereses' => $reajuste * $factores->factorInteres,
//            'recargo' => $reajuste * $factores->recargo,
//            'deuda_actualizada' => $factores->factorGeneral * $deuda * $uf,
//        ], [],
//        );
//    }
}
