<?php

namespace Src\Calculo\Domain\Enums;

enum TipoPago: int
{
    case efectivo = 1;
    case transferencia = 2;
    case tarjeta = 3;
    case cheque = 4;
    case enCliente = 5;

    case consignacion = 6;

}
