<?php

namespace App\Livewire\Caja;

use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;

class Cobranza extends Component
{
    public object $cobranza;

    public bool $expandida = false;
    public bool $marcarTodo = true;

    public function expandir(): void
    {
        $this->expandida = ! $this->expandida;
    }

    public function agregar(): void
    {
        $this->marcarTodo = ! $this->marcarTodo;
        $this->dispatch('parametros.agregarCobranza', ["cobranza_id"=> $this->cobranza->id, 'marcarTodo' => !$this->marcarTodo ]);
    }

    public function render(): View
    {
        return view('livewire.caja.cobranza');
    }
}
