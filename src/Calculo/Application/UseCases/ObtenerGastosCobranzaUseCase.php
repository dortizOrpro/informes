<?php

namespace Src\Calculo\Application\UseCases;

use Src\Calculo\Domain\Contracts\IndicadoresRepositoryContract;

readonly class ObtenerGastosCobranzaUseCase
{
    public function __construct(private IndicadoresRepositoryContract $indicadoresRepository) {}

    public function run(int $cobranza): int
    {
        return $this->indicadoresRepository->getGastosByCobranza($cobranza);
    }
}
