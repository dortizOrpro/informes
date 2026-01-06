<?php

namespace Src\Caja\Infrastructure\Controllers;

use Src\Caja\Application\UseCases\ListarComprobantesUseCase;

class PagosController
{
    public function __invoke()
    {
        return view('pages.pagos.index');
    }
}
