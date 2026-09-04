<?php

namespace Src\Procesos\Application\UseCases;

use Src\Procesos\Infraestructure\Repositories\SemanalOperacionesRepository;

class GenerarSemanalOperacionesUseCase
{
    public function __construct(
        private readonly SemanalOperacionesRepository $repository
    ) {}

    public function run($params)
    {
        return $this->repository->generar($params);
    }
}