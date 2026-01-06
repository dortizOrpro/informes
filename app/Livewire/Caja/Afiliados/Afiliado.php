<?php

namespace App\Livewire\Caja\Afiliados;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use Src\Caja\Application\UseCases\ListarDeudaPorAfiliadoUseCase;

class Afiliado extends Component
{
    public object $afiliado;
    public bool $expandida = false;

    public function expandir() {
        $this->expandida = !$this->expandida;
    }

    public function eliminar()
    {
        $this->dispatch('afiliado.eliminar',$this->afiliado->rut_afiliado);
    }


    public function seleccionar(ListarDeudaPorAfiliadoUseCase $uc)
    {
        $deudas = $uc->run($this->afiliado->rut_afiliado, $this->afiliado->rut_empleador);
        $carga = array_map(
            fn($item) => [
                'id' => $item->id,
                'cobranza_id' => $item->cobranza_id,
                'monto' => $item->monto,
                'periodo' => $item->periodo,
                'sp_id' => $item->sp_id,
                'producto_uid' => $item->producto_uid,
                'documento_id' => $item->id,
                'origen' => 'periodo-afiliado',
                'estado_id' => $item->estado_id,
                'aperturacion'=> $item->aperturacion
            ],
            $deudas,
        );
        $this->dispatch('parametros.agregarDeudas', $carga);
    }

    public function render()
    {
        return view('livewire.caja.afiliados.afiliado',[
            'factores' => array_column(Session::get('factores') ?? [], 'id')
        ]);
    }
}
