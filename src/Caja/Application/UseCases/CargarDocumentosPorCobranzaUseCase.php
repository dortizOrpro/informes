<?php

namespace Src\Caja\Application\UseCases;

use Src\Caja\Domain\Contracts\CobranzasRepositoryContract;

readonly class CargarDocumentosPorCobranzaUseCase
{
    public function __construct(private CobranzasRepositoryContract $cobranzasRepository) {}

    public function run(int $cobranza): array
    {
        return $this->cobranzasRepository->getDocumentosByCobranza($cobranza);
    }
}
