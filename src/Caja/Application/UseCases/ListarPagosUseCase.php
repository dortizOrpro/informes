<?php

namespace Src\Caja\Application\UseCases;

use Src\Caja\Domain\Contracts\PagosRepositoryContract;

readonly class ListarPagosUseCase
{
    public function __construct(private PagosRepositoryContract $pagosRepository) {

    }

    public function run():array {
        return $this->pagosRepository->listar(null);
    }
}
