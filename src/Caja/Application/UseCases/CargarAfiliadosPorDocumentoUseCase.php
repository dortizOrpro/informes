<?php

namespace Src\Caja\Application\UseCases;

use Src\Caja\Domain\Contracts\CobranzasRepositoryContract;

readonly class CargarAfiliadosPorDocumentoUseCase
{
    public function __construct(private CobranzasRepositoryContract $cobranzasRepository) {}

    public function run(int $remesa, string $resolucion, string $periodo, string $interno): array
    {
        return $this->cobranzasRepository->getAfiliadosByDocumento($remesa, $resolucion, $periodo, $interno);
    }
}
