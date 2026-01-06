<?php

namespace Src\Caja\Infrastructure\Controllers;

use Src\Caja\Application\UseCases\ListarComprobantesUseCase;

class PagoController
{

    private function headers(): array
    {
        return [
            ['key'=> 'id','label'=>'N°'],
            ['key'=> 'cobranza_id','label'=>'N° Cobranza'],
            ['key'=> 'agencia_id','label'=>'Agencia'],
            ['key'=> 'cliente','label'=>'Cliente'],
            ['key'=> 'apago','label'=>'Total'],
        ];
    }
    public function __invoke(int $id, ListarComprobantesUseCase $useCase)
    {
        $comprobantes = $useCase->run($id);
        return view(
            'pages.pago.index',
            [
                'id' => $id,
                'comprobantes' => $comprobantes,
                'headers' => $this->headers()
            ]
        );
    }
}
