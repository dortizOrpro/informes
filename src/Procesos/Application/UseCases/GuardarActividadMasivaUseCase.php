<?php

namespace Src\Procesos\Application\UseCases;


use Src\Procesos\Infraestructure\Repositories\ActividadRepository;


readonly class GuardarActividadMasivaUseCase
{
    public function __construct(
        private ActividadRepository $actividadRepository,
    ) {}

    public function run($actividad_id, $tipo, $rows)
    {

        $result = $this->actividadRepository->guardarActividadMasiva($actividad_id, $tipo, $rows);

        return $result;
    }
}
