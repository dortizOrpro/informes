<?php

namespace Src\Calculo\Domain\Entities;

class EstadoIndicadores
{
    public function __construct(
        public float $uf,
        public bool $hasUf,
        public bool $hasTablaSp
    )
    {
        //
    }
}
