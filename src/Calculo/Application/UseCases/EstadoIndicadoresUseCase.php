<?php

namespace Src\Calculo\Application\UseCases;

use Src\Calculo\Domain\Contracts\IndicadoresRepositoryContract;
use Src\Calculo\Domain\Entities\EstadoIndicadores;

readonly class EstadoIndicadoresUseCase
{
    public function __construct(private IndicadoresRepositoryContract $indicadoresRepository) {}

    public function run(string $fecha): EstadoIndicadores
    {
        $uf = $this->indicadoresRepository->getUfByDay($fecha);
        $valor = $this->indicadoresRepository->getValorSp($fecha,'2020-01-01','A',1035);
        //dd($uf, $valor);
        return new EstadoIndicadores(
            uf:  $uf,
            hasUf: ($uf > 0),
            hasTablaSp: ($valor->factorGeneral > 0)
        );
    }
}
