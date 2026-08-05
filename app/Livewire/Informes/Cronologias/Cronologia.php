<?php

namespace App\Livewire\Informes\Cronologias;


use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Src\Procesos\Application\UseCases\GenerarCronologiaUseCase;

class Cronologia extends Component
{
    use WithFileUploads;
    public string $fecha_inicio, $fecha_fin = "";

    public int $criterio, $salida = 0;
    public array $criterios, $salidas, $clientes;
    public $cliente;

    public $excelCobranzas;

    public function mount(): void
    {

        $this->salidas = [
            ['id' => 0, 'name' => 'Seleccionar formato...'],
            ['id' => 1 , 'name' => 'Salida cliente'],
            ['id' => 2 , 'name' => 'Salida Excel'],
        ];

        $this->clientes = [
            ['id' => 0, 'name' => 'Seleccionar Cliente...'],
            // ['id' => 'CronologiaProvida.76265736.0', 'name' => 'Provida'],

            // ['id' => 'CronologiaGenerico.76762250.01', 'name' => 'Modelo - formato 1'],
            // ['id' => 'CronologiaGenerico.76762250.03', 'name' => 'Modelo - formato 3'],
            // ['id' => 'CronologiaGenerico.76762250.04', 'name' => 'Modelo - formato 4'],            
            
            ['id' => 'cronologia.78236399.1', 'name' => 'SUCC - formato 1'],
            ['id' => 'cronologia.78236399.3', 'name' => 'SUCC - formato 3'],
            ['id' => 'cronologia.78236399.4', 'name' => 'SUCC - formato 4'],

            // ['id' => 'CronologiaGenerico.98000000.01', 'name' => 'Capital - formato 1'],

            // ['id' => 'CronologiaGenerico.98001200.01', 'name' => 'Planvital - formato 1'],
            // ['id' => 'CronologiaGenerico.98001200.03', 'name' => 'Planvital - formato 3'],
            // ['id' => 'CronologiaGenerico.98001200.04', 'name' => 'Planvital - formato 4'],

            // ['id' => 'CronologiaGenerico.76960424.01', 'name' => 'Uno - formato 1'],
            // ['id' => 'CronologiaGenerico.76960424.04', 'name' => 'Uno - formato 4'],

            // ['id' => 'CronologiaGenerico.77601648.00', 'name' => 'AFC Chile'],
            // ['id' => 'CronologiaHabitat.98000100.0', 'name' => 'Habitat'],
        ];
    }

    public function generar(GenerarCronologiaUseCase $uc)
    {

        if (
            $this->cliente > 0 &&
            $this->salida > 0 &&
            !is_null($this->fecha_inicio) &&
            !is_null($this->fecha_fin)
        ) {
            return $uc->run([
                'cliente'   => $this->cliente,
                'salida'    => $this->salida,
                'fecha_ini' => $this->fecha_inicio,
                'fecha_fin' => $this->fecha_fin,
                'extras' => array_combine(['clase','cliente','tipo'], explode('.', $this->cliente))
            ]);
        }

        // $this->validate([
        //     'excelCobranzas' => 'required|file|mimes:xlsx,xls',
        // ]);

        // $path = $this->excelCobranzas->store('fichas', 'public');

        // $this->dispatch('generarFichas', ruta: $path);
    }

    public function render()
    {
        return view('livewire.informes.cronologias.parametros');
    }
}
