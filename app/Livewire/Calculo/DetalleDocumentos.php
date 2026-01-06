<?php

namespace App\Livewire\Calculo;

use Livewire\Component;
use Src\Caja\Application\UseCases\CargarDocumentosPorCobranzaUseCase;

class DetalleDocumentos extends Component
{
    public int $cobranza;

    public function render(CargarDocumentosPorCobranzaUseCase $uc)
    {
        return view('livewire.calculo.detalle-documentos',
            [
                'documentos' => $uc->run($this->cobranza),
            ]
        );
    }
}
