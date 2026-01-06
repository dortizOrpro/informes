<?php

namespace Src\Caja\Application\UseCases;

use Src\Caja\Domain\Contracts\CobranzasRepositoryContract;
use Src\Calculo\Domain\Enums\TipoCalculo;

readonly class CargarCobranzasPorCriterioUseCase
{
    public function __construct(private CobranzasRepositoryContract $cobranzasRepository) {}

    public function run(TipoCalculo $criterio, array $busqueda): array
    {
        return $this->cobranzasRepository->getByCriterio($criterio, $busqueda);
    }
}
