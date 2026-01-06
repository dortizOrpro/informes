<?php

namespace Src\Caja\Application\UseCases;

use Src\Caja\Domain\Contracts\CobranzasRepositoryContract;

readonly class ListarDeudaPorAfiliadoUseCase
{
    public function __construct(private CobranzasRepositoryContract $cobranzasRepository) {}

    public function run(int $rutAfiliado, int $rutEmpleador): array
    {
        return $this->cobranzasRepository->getDeudaByAfiliado($rutAfiliado, $rutEmpleador);
    }
}
