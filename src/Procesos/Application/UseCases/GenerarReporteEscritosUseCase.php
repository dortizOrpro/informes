<?php

namespace Src\Procesos\Application\UseCases;

use Src\Procesos\Infraestructure\Repositories\ReporteEscritosRepository;

class GenerarReporteEscritosUseCase
{
    public function __construct(
        private readonly ReporteEscritosRepository $repository
    ) {}

    public function run($params)
    {
        return $this->repository->generar($params);
    }
}