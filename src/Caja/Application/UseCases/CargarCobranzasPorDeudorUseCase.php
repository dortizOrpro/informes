<?php

namespace Src\Caja\Application\UseCases;

use Src\Caja\Domain\Contracts\CobranzasRepositoryContract;

readonly class CargarCobranzasPorDeudorUseCase
{
    public function __construct(private CobranzasRepositoryContract $cobranzasRepository) {}

    public function run(int $rut): array
    {
        return $this->cobranzasRepository->getByRut($rut);
    }
}
