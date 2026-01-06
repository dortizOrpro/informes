<?php

namespace App\Livewire\Rendiciones;

use App\Services\GenerarPlanillaRendicionService;
use App\Services\RendicionesAFCService;
use App\Services\RendicionesHabitatService;
use App\Services\RendicionesModeloService;
use App\Services\RendicionesPreviredService_capital;
use App\Services\RendicionesUnoService;
use Livewire\Component;

class Parametros extends Component
{
    public string $fecha;

    public $tipoArchivo, $cliente;
    public array $clientes;

    public array $servicios = [
        1032 => [ 
            1 => ['class' => RendicionesPreviredService_capital::class, 'method' => 'generarArchivo', 'params' => ['fecha', 'cliente']],
            2 => ['class' => GenerarPlanillaRendicionService::class, 'method' => 'generarPDF', 'params' => ['fecha']],
        ],
        1033 => [ 
            1 => ['class' => RendicionesPreviredService_capital::class, 'method' => 'generarArchivo', 'params' => ['fecha', 'cliente']],
            2 => ['class' => GenerarPlanillaRendicionService::class, 'method' => 'generarPDF', 'params' => ['fecha']],
        ],
        1035 => [ 
            1 => ['class' => RendicionesUnoService::class, 'method' => 'exportarExcel', 'params' => ['fecha', 'cliente']],
            2 => ['class' => GenerarPlanillaRendicionService::class, 'method' => 'generarPDF', 'params' => ['fecha']],
        ],
        1005 => [ 
            1 => ['class' => RendicionesHabitatService::class, 'method' => 'exportarExcel', 'params' => ['fecha', 'cliente']],
            2 => ['class' => GenerarPlanillaRendicionService::class, 'method' => 'generarPDF', 'params' => ['fecha']],
        ],
        1034 => [ 
            1 => ['class' => RendicionesModeloService::class, 'method' => 'exportarExcel', 'params' => ['fecha', 'cliente']],
            2 => ['class' => GenerarPlanillaRendicionService::class, 'method' => 'generarPDF', 'params' => ['fecha']],
        ],
        1099 => [ 
            1 => ['class' => RendicionesAFCService::class, 'method' => 'exportarExcel', 'params' => ['fecha', 'cliente']],
            2 => ['class' => GenerarPlanillaRendicionService::class, 'method' => 'generarPDF', 'params' => ['fecha']],
        ]
    ];

    public array $tiposArchivo = [
        ['id' => 0, 'name' => 'Seleccionar tipo archivo...'],
        ['id' => 1, 'name' => 'Rendición'],
        ['id' => 2, 'name' => 'Planilla'],
    ];

    public function mount(): void
    {
        $this->clientes =[
            [
                'id' => 0, 
                'name' => 'Seleccionar cliente...'
            ],
            [
                "id" => 1032,
                "name" => "A.F.P. Planvital S.A.",
                "disabled" => false
            ],
            [
                "id" => 1033,
                "name" => "A.F.P. Capital S.A.",
                "disabled" => false
            ],
            [
                "id" => 1035,
                "name" => "A.F.P. Uno S.A.", 
                "disabled" => false
            ],
            [
                "id" => 1005,
                "name" => "A.F.P. Habitat S.A.",
                "disabled" => false
            ],
            [
                "id" => 1034,
                "name" => "A.F.P. Modelo S.A.",
                "disabled" => false
            ],
            [
                "id" => 1099,
                "name" => "A.F.C. Chile S.A.",
                "disabled" => false
            ],
            [
                "id" => 1008,
                "name" => "A.F.P. Provida S.A.",
                "disabled" => true
            ]
        ];
    }

    public function generar()
    {
        $cliente = $this->cliente;
        $tipoArchivo = $this->tipoArchivo;
        $fecha = $this->fecha;

        if (isset($this->servicios[$cliente][$tipoArchivo])) {
            $config = $this->servicios[$cliente][$tipoArchivo];
            $service = new $config['class']();

            $params = array_map(fn($p) => $this->$p, $config['params']);
            $ruta = $service->{$config['method']}( ...$params );
        }else{
            return;
        }
        
        return response()->download($ruta)->deleteFileAfterSend(true);
    }

    public function render()
    {
        return view('livewire.rendiciones.parametros');
    }
}
