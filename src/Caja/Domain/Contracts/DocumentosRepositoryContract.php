<?php

namespace Src\Caja\Domain\Contracts;

interface DocumentosRepositoryContract
{
    public function getByCobranza(int $cobranza): array;
}
