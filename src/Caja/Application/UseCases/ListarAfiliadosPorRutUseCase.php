<?php

namespace Src\Caja\Application\UseCases;

use Src\Caja\Domain\Contracts\CobranzasRepositoryContract;
use Src\Calculo\Domain\Enums\TipoCalculo;

readonly class ListarAfiliadosPorRutUseCase
{
    public function __construct(private CobranzasRepositoryContract $cobranzasRepository) {}

    public function run(array $rutAfiliados, int $rutEmpleador): array
    {
        return $this->cobranzasRepository->getAfiliadoByRut($rutAfiliados, $rutEmpleador);
    }
}
