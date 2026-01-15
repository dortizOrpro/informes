<?php

namespace App\Livewire\Informes\Fichas;

use Livewire\Component;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\On;
use App\Services\FichaGeneratorService;
use Illuminate\Support\Facades\Storage;
use Mary\Traits\Toast;

class Criterio extends Component
{
    use Toast;
    public ?string $estado = null;
    public ?string $tipo = null;
    public ?string $resolucion = null;
    public ?string $administradora = null;
    public int $criterio;

    public $rutaExcel;

    #[On('generarFichas')]
    public function generarFichas($ruta)
    {
        $service = app(FichaGeneratorService::class);

        $this->rutaExcel = $ruta;
    
        $fullPath = storage_path('app/public/' . $ruta);
        
        $datos = [
            'criterio' => $this->criterio,
            'resolucion'=> $this->resolucion,
            'cliente'=> $this->administradora,
            'tipo' => $this->tipo,
            'estado'=> $this->estado,
            'excel'=> $fullPath,
        ];

        $resultado = $service->generarFichas($datos);

        if ($resultado->total < 1) {
            
            $this->warning(
                position: 'toast-bottom toast-start',
                title: 'Fichas Masivas',
                timeout: 8000,
                description: 'No se encontraron fichas para los criterios seleccionados.',
            );
            return;
        }

        $this->success(
            position: 'toast-bottom toast-start',
            title: 'Fichas Masivas',
            timeout: 8000,
            description: 'Se generaron '.$resultado->total.' fichas.',
        );
        
        Storage::disk('public')->delete($fullPath);

        return response()->download(storage_path("app/public/{$resultado->archivo}"));


    }

    public function mount( $criterio)
    {
        $this->criterio = $criterio;
    }

    public function render()
    {
        return view('livewire.informes.fichas.criterios',
            [
                'administradoras' => [
                    [
                        'id' => 1033,
                        'name' => 'A.F.P. Capital',
                    ],
                    [
                        'id' => 1003,
                        'name' => 'A.F.P. Cuprum',
                    ],
                    [
                        'id' => 1005,
                        'name' => 'A.F.P. Habitat',
                    ],
                    [
                        'id' => 1034,
                        'name' => 'A.F.P. Modelo',
                    ],
                    [
                        'id' => 1032,
                        'name' => 'A.F.P. PlanVital',
                    ],
                    [
                        'id' => 1008,
                        'name' => 'A.F.P. ProVida',
                    ],
                    [
                        'id' => 1035,
                        'name' => 'A.F.P. Uno',
                    ],
                    [
                        'id' => 1099,
                        'name' => 'Fondo De Cesantia III',
                    ],
                ],
                'estados' => [
                    [
                        'id'=> null,
                        'name' => 'Todas'
                    ],
                    [
                        'id'=> 200,
                        'name' => 'Vigentes'
                    ],
                    [
                        'id'=> 400,
                        'name' => 'Suspendidas'
                    ],
                    [
                        'id'=> 500,
                        'name' => 'Incobrable'
                    ],
                    [
                        'id'=> 900,
                        'name' => 'Terminadas'
                    ]
                ],
                'tipos'=> [
                    [
                        'id'=> null,
                        'name' => 'Todas'
                    ],
                    [
                        'id'=> 'DNPA',
                        'name' => 'DNPA'
                    ],
                    [
                        'id'=> 'DNP',
                        'name' => 'DNP'
                    ],
                ]
            ]);
    }

}
