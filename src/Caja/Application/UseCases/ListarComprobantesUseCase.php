<?php

namespace Src\Caja\Application\UseCases;

use Src\Caja\Domain\Contracts\CobranzasRepositoryContract;
use Src\Caja\Domain\Contracts\PagosRepositoryContract;

readonly class ListarComprobantesUseCase
{
    public function __construct(
        private CobranzasRepositoryContract $cobranzasRepository,
        private PagosRepositoryContract $pagosRepository,
    ) {

    }

    public function run(int $pagoId):array {
        $comprobantes = $this->pagosRepository->getComprobantesByPagoId($pagoId);
        $listado = array_map(
            fn($comprobante) => array_merge(
                (array)$this->cobranzasRepository->getById($comprobante->cobranza_id),
                (array)$comprobante
            ),
            $comprobantes
        );
        return $listado;
    }
}
