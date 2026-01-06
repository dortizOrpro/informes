<?php

namespace Src\Calculo\Domain\Enums;

enum TipoCalculo: int
{
    case nulo = 0;
    case RutDeudor = 1;
    case RutAfiliado = 2;
    case RitCausa = 3;
    case Preingreso = 4;
    case Cobranza = 5;
}
