<?php

namespace App\Livewire\Informes\Fichas;

use Livewire\Component;
use Livewire\WithFileUploads;

class Ficha extends Component
{
    use WithFileUploads;
    public string $fecha;

    public int $criterio = 0;
    public array $criterios;

    public $excelCobranzas;

    public function mount(): void
    {
        $this->criterios =[
            [
                'id' => 0, 
                'name' => 'Seleccionar criterio...'
            ],
            [
                "id" => 1,
                "name" => "Cobranza",
                "disabled" => false
            ],
            [
                "id" => 2,
                "name" => "RUT Empleador",
                "disabled" => false
            ],
            [
                "id" => 3,
                "name" => "Resolución", 
                "disabled" => false
            ],
            [
                "id" => 4,
                "name" => "RIT - Código juzgado",
                "disabled" => false
            ],
            [
                "id" => 5,
                "name" => "Cliente",
                "disabled" => true
            ]
        ];
    }

    public function generar()
    {
        $this->validate([
            'excelCobranzas' => 'required|file|mimes:xlsx,xls',
        ]);

        $path = $this->excelCobranzas->store('fichas', 'public');

        $this->dispatch('generarFichas', ruta: $path);
    }

    public function render()
    {
        return view('livewire.informes.fichas.parametros');
    }
}
