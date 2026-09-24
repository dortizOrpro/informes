<?php

namespace App\Livewire\Informes\ReporteEscritos;

use Livewire\Component;
use Src\Procesos\Application\UseCases\GenerarReporteEscritosUseCase;

class ReporteEscritos extends Component
{
    public string $fecha_inicio = '';
    public string $fecha_fin = '';

    public function generar(GenerarReporteEscritosUseCase $uc)
    {
        $this->validate([
            'fecha_inicio' => [
                'required',
                'date',
                'before_or_equal:fecha_fin',
            ],
            'fecha_fin' => [
                'required',
                'date',
                'after_or_equal:fecha_inicio',
            ],
        ], [
            'fecha_inicio.required' => 'Debe ingresar la fecha desde.',
            'fecha_fin.required' => 'Debe ingresar la fecha hasta.',
            'fecha_inicio.before_or_equal' => 'La fecha desde debe ser menor o igual a la fecha hasta.',
            'fecha_fin.after_or_equal' => 'La fecha hasta debe ser mayor o igual a la fecha desde.',
        ]);

        return $uc->run([
            'fecha_ini' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
        ]);
    }

    public function reiniciar(): void
    {
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
    }

    public function render()
    {
        return view('livewire.informes.reporte-escritos.parametros');
    }
}