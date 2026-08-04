<?php

namespace Src\Procesos\Application\UseCases;

use Src\Procesos\Infraestructure\Repositories\CronologiaRepository;


class GenerarCronologiaUseCase
{
    public function __construct(private readonly CronologiaRepository $cronologiaRepository) {}

    public function run($params)
    {
        return $this->cronologiaRepository->getCronologia($params);
    }
}
