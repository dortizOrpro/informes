<?php

namespace App\Livewire\Caja;

use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class Afiliado extends Component
{
    public object $afiliado;

    public object $documento;

    #[Modelable]
    public int $tick;

    public function seleccionar(): void
    {

        $carga = [
            'id' => $this->afiliado->id,
            'cobranza_id' => $this->documento->cobranza_id,
            'monto' => $this->afiliado->monto,
            'periodo' => $this->afiliado->periodo,
            'sp_id' => $this->afiliado->sp_id,
            'producto_uid' => $this->afiliado->producto_uid,
            'documento_id' => $this->documento->id,
            'origen' => 'documento-afiliado',
            'estado_id' => $this->afiliado->estado_id,
            'aperturacion' => json_decode($this->afiliado->aperturacion, true),
        ];

        $this->dispatch('parametros.agregarAfiliado', $carga);
    }

    public function render(): View
    {
        $icono = [
            150 => 'carbon.locked',
            200 => 'carbon.pricing-container',
            300 => 'carbon.pricing-container',
            400 => 'carbon.pricing-container',
            500 => 'carbon.pricing-container',
        ];
        return view('livewire.caja.afiliado',
            [
                'icono' => $icono,
                'factores' => array_column(Session::get('factores') ?? [], 'id')
            ]
        );
    }
}
