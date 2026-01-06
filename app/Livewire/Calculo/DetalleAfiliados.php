<?php

namespace App\Livewire\Calculo;

use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Src\Caja\Application\UseCases\CargarAfiliadosPorDocumentoUseCase;

class DetalleAfiliados extends Component
{
    public object $documento;

    public int $tick = 0;

    // #[On('caja.actualizar-documento.{documento.id}')]
    public function algo()
    {
        $this->tick = time();
        Log::info('RENDER DETALLE AFILIADOS POR DOCUMENTO');
    }

    public function render(CargarAfiliadosPorDocumentoUseCase $uc): View
    {
        return view('livewire.calculo.detalle-afiliados',
            [
                'afiliados' => $uc->run(
                    $this->documento->remesa_id,
                    $this->documento->documento,
                    $this->documento->periodo,
                    $this->documento->numero_interno
                ),
            ]
        );
    }
}
