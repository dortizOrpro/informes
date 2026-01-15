<?php

namespace Src\Procesos\Infraestructure\Services;

use Closure;
use Src\Procesos\Infraestructure\Repositories\ActividadRepository;

readonly class ActividadService
{
    public function __construct(
        private ActividadRepository $actividadRepository
    ) {
        //
    }

    public function actividadesByTipo(string $categoria): array
    {
        $actividades = $this->actividadRepository->getActividades();

        return collect($actividades)->where('tipo', $categoria)->toArray();
    }

   
}
