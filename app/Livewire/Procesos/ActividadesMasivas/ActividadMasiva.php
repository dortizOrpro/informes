<?php

namespace App\Livewire\Procesos\ActividadesMasivas;


use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActividadMasiva extends Component
{
    use WithFileUploads;

    public function render()
    {
        return view('livewire.procesos.actividadesMasivas.parametros');
    }
}
