<?php

namespace Src\Procesos\Application\UseCases;

use Src\Procesos\Infraestructure\Repositories\CarteraTramitacionRepository;

class GenerarCarteraTramitacionUseCase
{
    public function __construct(
        private readonly CarteraTramitacionRepository $repository
    ) {}

    public function run($params)
    {
        return $this->repository->generar($params);
    }
}