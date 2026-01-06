<?php

namespace Src\Caja\Application\UseCases;

use Src\Caja\Domain\Contracts\PagosRepositoryContract;
use Src\Calculo\Domain\Enums\TipoPago;

readonly class GuardarPagoUseCase
{
    public function __construct(private PagosRepositoryContract $pagosRepository) {

    }

    public function run(
        TipoPago $tipoPago,
        string $preingreso,
        string $fecha,
        int $usuarioId,
        array $pago,
        array $calculos,
        array $detalle,
        array $deudas
    ): bool
    {
        $paso01 = $this->pagosRepository->guardar(
            tipoPago: $tipoPago,
            preingreso: $preingreso,
            fecha: $fecha,
            usuarioId: $usuarioId,
            pago: $pago,
            calculos: $calculos,
            detalle: $detalle
        );
        return $paso01 && $this->pagosRepository->guardarEstado($deudas,  $fecha,200);
    }
}
