<?php

namespace Src\Calculo\Domain\Entities;

class ValorSp
{
    public function __construct(
        public string $fechaPago,
        public string $periodo,
        public string $fondo,
        public string $administradora,
        public float $rentabilidad,
        public float $interes,
        public float $factorReajuste,
        public float $factorInteres,
        public float $recargo,
        public float $factorGeneral,
        public bool  $existe

    ) {}
}
