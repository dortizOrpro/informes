<?php

namespace Src\Calculo\Domain\Entities;

class HonorarioCliente
{
    public function __construct(
        public float $honorarios,
        public float $procuraduria,
    ) {}
}
