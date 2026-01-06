<?php

namespace Src\Caja\Domain\Contracts;

use Src\Calculo\Domain\Enums\TipoPago;

interface PagosRepositoryContract
{
    public function listar($filter): array;
    public function guardar(TipoPago $tipoPago, string $preingreso, string $fecha, int $usuarioId, array $pago, array $calculos, array $detalle):bool;

    public function guardarEstado(array $deudas, string $fecha, int $estadoId):bool;
    public function getComprobanteById(int $comprobanteId):object;
    public function getComprobanteDetalleById(int $comprobanteId):array;
    public function getComprobantesByPagoId(int $pagoId): array;
}
