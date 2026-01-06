<?php

namespace App\Livewire\Caja;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Src\Caja\Application\UseCases\CargarCobranzasPorCriterioUseCase;
use Src\Calculo\Domain\Enums\TipoCalculo;

class Listado extends Component
{
    public TipoCalculo $tipoCalculo = TipoCalculo::nulo;
    public array $params = [];

    #[On('caja.actualizarListado')]
    public function actualizar($params, CargarCobranzasPorCriterioUseCase $uc): void
    {
        Log::info("Actualizando listado de cobranzas", $params);
        $this->tipoCalculo = TipoCalculo::from($params['tipoCalculo']);
        $this->params = $params;
    }

    #[On('caja.resetListado')]
    public function resetListado(): void
    {
        $this->tipoCalculo = TipoCalculo::nulo;
    }

    public function render()
    {
        return view('livewire.caja.listado');
    }
}
