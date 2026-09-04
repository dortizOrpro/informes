<?php

namespace App\Livewire\Informes\CarteraTramitacion;

use Src\Procesos\Application\UseCases\GenerarCarteraTramitacionUseCase;

use Livewire\Component;

class CarteraTramitacion extends Component
{
    public string $fecha_inicio = '';
    public string $fecha_fin = '';

    public array $clientes = [];
    public $cliente = 0;

    public function mount(): void
    {
        $this->clientes = [
            ['id' => 0, 'name' => 'Seleccionar Cliente...'],
            ['id' => '78236399', 'name' => 'SUCC'],
        ];
    }

    public function generar(GenerarCarteraTramitacionUseCase $uc)
    {
        if ($this->cliente == 0) {
            return;
        }

        $this->validate([
            'fecha_inicio' => [
                'nullable',
                'date',
                'before_or_equal:fecha_fin',
            ],
            'fecha_fin' => [
                'nullable',
                'date',
                'after_or_equal:fecha_inicio',
            ],
        ], [
            'fecha_inicio.before_or_equal' => 'La fecha desde debe ser menor o igual a la fecha hasta.',
            'fecha_fin.after_or_equal' => 'La fecha hasta debe ser mayor o igual a la fecha desde.',
        ]);

        return $uc->run([
            'fecha_ini' => $this->fecha_inicio ?: null,
            'fecha_fin' => $this->fecha_fin ?: null,
            'cliente' => $this->cliente,
        ]);
    }

    public function reiniciar(): void
    {
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
        $this->cliente = 0;
    }

    public function render()
    {
        return view('livewire.informes.cartera-tramitacion.parametros');
    }
}
