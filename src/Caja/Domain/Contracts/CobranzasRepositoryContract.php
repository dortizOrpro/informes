<?php

namespace Src\Caja\Domain\Contracts;

use Src\Calculo\Domain\Enums\TipoCalculo;

interface CobranzasRepositoryContract
{
    public function getByRut(int $rut): array;
    public function getById(int $cobranzaId): object;
    public function getEmpleadorByRut(int $rut): array;

    public function getByCriterio(TipoCalculo $criterio, array $busqueda): array;

    public function getDocumentosByCobranza(int $cobranza): array;

    public function getAfiliadosByDocumento(int $remesa, string $resolucion, string $periodo, string $interno): array;

    public function getAfiliadoByRut(array $rutAfiliados, int $rutEmpleador): array;
    public function getDeudaByAfiliado(int $rutAfiliado, int $rutEmpleador): array;
}
