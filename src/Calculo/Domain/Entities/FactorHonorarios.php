<?php

namespace Src\Calculo\Domain\Entities;

class FactorHonorarios
{
    public function __construct(
        public string $producto,
        public string $tramo,
        public string $tramoMoneda,
        public float $tramoMinimo,
        public float $tramoMaximo,
        public float $porcentaje,
        public string $topeMoneda,
        public float $topeMinimo,
        public float $topeMaximo,
        public float $procuraduria,
    ) {}
}
