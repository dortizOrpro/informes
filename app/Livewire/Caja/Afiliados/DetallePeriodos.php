<?php

namespace App\Livewire\Caja\Afiliados;

use Livewire\Attributes\On;
use Livewire\Component;
use Src\Caja\Application\UseCases\ListarDeudaPorAfiliadoUseCase;

class DetallePeriodos extends Component
{
    public int $rutAfiliado;
    public int $rutEmpleador;


    public function render(ListarDeudaPorAfiliadoUseCase $uc)
    {
        return view('livewire.caja.afiliados.detalle-periodos',
        [
            'periodos' => $uc->run($this->rutAfiliado, $this->rutEmpleador)
        ]
        );
    }
}
