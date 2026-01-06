<?php

namespace Src\Caja\Domain\Contracts;

use Src\Calculo\Domain\Enums\TipoCalculo;

interface PreingresoRepositoryContract
{
    public function guardar(TipoCalculo $tipoCalculo, array $params, string $vencimiento,  string $fechaCalculo, int $usuarioId,array $deudas): string;
    public function guardarDetalle(string $preingresoId, array $detalle): void;
}
