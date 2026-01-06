<?php

namespace App\Livewire\Caja\Pago;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Src\Caja\Application\UseCases\GenerarComprobateUseCase;

class Comprobantes extends Component
{
    public array $comprobantes = [];
    public array $headers = [];

    public function descargar(int $id, GenerarComprobateUseCase $useCase) {
        $comprobante = $useCase->run($id);
        return Storage::download(
            $comprobante,
            "comprobante_$id.pdf",
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="comprobante_'.$id.'.pdf"'
            ]
        );
    }
    public function render()
    {
        return view('livewire.caja.pago.comprobantes');
    }
}
