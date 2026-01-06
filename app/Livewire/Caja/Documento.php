<?php

namespace App\Livewire\Caja;

use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Src\Caja\Application\UseCases\CargarAfiliadosPorDocumentoUseCase;

class Documento extends Component
{
    public bool $expandida = false;
    public bool $marcarTodo = true;

    public object $documento;

    public function expandir(): void
    {
        $this->expandida = ! $this->expandida;
    }

    public function agregar(): void
    {
        $this->marcarTodo = ! $this->marcarTodo;
        $this->dispatch('parametros.agregarDocumento', ['documento' => $this->documento, 'marcarTodo' => !$this->marcarTodo ]);
    }

    #[On('actualizar.documento-afiliado.{documento.id}')]
    public function render(CargarAfiliadosPorDocumentoUseCase $uc): View
    {
        $suma = array_reduce(
            array_filter(
                Session::get('factores'),
                fn ($seleccionado) => $seleccionado['documento_id'] === $this->documento->id,
            ),
            fn ($suma, $e) => $suma + $e['monto'],
            0
        );

        return view('livewire.caja.documento', [
            'seleccionado' => (int) $this->documento->capital === (int) $suma,
        ]);
    }
}
