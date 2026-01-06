<?php

namespace App\Livewire\Caja\Afiliados;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use Src\Caja\Application\UseCases\ListarDeudaPorAfiliadoUseCase;

class Periodo extends Component
{
    public object $periodo;

    public function seleccionar(): void
    {

        $carga = [
            'id' => $this->periodo->id,
            'cobranza_id' => $this->periodo->cobranza_id,
            'monto' => $this->periodo->monto,
            'periodo' => $this->periodo->periodo,
            'sp_id' => $this->periodo->sp_id,
            'producto_uid' => $this->periodo->producto_uid,
            'documento_id' => $this->periodo->id,
            'origen' => 'periodo-afiliado',
            'estado_id' => $this->periodo->estado_id,
            'aperturacion' => $this->periodo->aperturacion
        ];
        Log::debug("Cargando periodo", $carga);
        $this->dispatch('parametros.agregarAfiliado', $carga);
    }

    #[On('actualizar.periodo-afiliado.{periodo.id}')]
    public function render() {
        return view('livewire.caja.afiliados.periodo',
        [
            'factores' => array_column(Session::get('factores') ?? [], 'id')
        ]);
    }
}
