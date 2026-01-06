<?php

namespace App\Livewire\Caja\Afiliados;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Src\Caja\Application\UseCases\ListarAfiliadosPorRutUseCase;

class Listado extends Component
{
    #[Modelable]
    public array $afiliados = [];

    public int $tick;
    public int $rutEmpleador;

    #[On('afiliado.eliminar')]
    public function afiliadoEliminar(int $rutAfiliado) {
        Log::info("Eliminando afiliado $rutAfiliado");
        $this->afiliados = array_filter($this->afiliados, fn($afiliado) => $afiliado !== $rutAfiliado);
    }
    public function render(ListarAfiliadosPorRutUseCase $uc)
    {
        $listado = $uc->run($this->afiliados, $this->rutEmpleador);
        return view('livewire.caja.afiliados.listado',
        [
            'listado' => $listado,
        ]);
    }
}
