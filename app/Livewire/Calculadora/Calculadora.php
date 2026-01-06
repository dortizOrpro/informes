<?php

namespace App\Livewire\Calculadora;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Src\Calculo\Application\UseCases\ActualizarDeudaUseCase;
use Src\Calculo\Application\UseCases\EstadoIndicadoresUseCase;
use Src\Calculo\Domain\Enums\ModoCalculo;

class Calculadora extends Component
{
    public string $periodo;

    public string $fechaPago;

    public string $capital01 = '0';
    public string $capital02 = '0';

    public ?string $administradora = null;

    public ?string $fondo01 = null;
    public ?string $fondo02 = null;

    public ?string $pct01 = '0';
    public ?string $pct02 = '0';

    private array $resultado;

    public string $uf = "0";
    public ModoCalculo $modoCalculo = ModoCalculo::fondo;

    public function mount(EstadoIndicadoresUseCase $ufUseCase)
    {
        $this->periodo = '2023-01';
        $this->fechaPago = date('Y-m-d');
        $this->uf = $ufUseCase->run($this->fechaPago)->uf;
    }

    public function updatedFechaPago(EstadoIndicadoresUseCase $ufUseCase)
    {
        $this->uf = $ufUseCase->run($this->fechaPago)->uf;
    }
    public function calcular(ActualizarDeudaUseCase $uc, EstadoIndicadoresUseCase $ufUseCase): void
    {
        $rules = match ($this->modoCalculo) {
            ModoCalculo::fondo => [
                'capital01' => 'required|integer|gt:0',
                'capital02' => 'integer|gte:0',
            ],
            ModoCalculo::porcentaje => [
                'capital01' => 'required|integer|gt:0',
                'pct01' => 'required|integer|gt:0',
                'pct02' => 'required|integer|gte:0',
            ]
        };

        $this->validate(
            array_merge(
                [
                    'periodo' => 'required|date',
                    'fechaPago' => 'required|date',
                    'administradora' => 'required',
                    'fondo01' => 'required|string',
                    'fondo02' => 'string',
                ],
                $rules,
            )
        );
        $deudas = [
            [
                'fondo_id' => $this->fondo01,
                'monto' => $this->modoCalculo === ModoCalculo::porcentaje ?  ($this->capital01 * (float) $this->pct01 / 100)  : $this->capital01,
            ],
            [
                'fondo_id' => $this->fondo02,
                'monto' => $this->modoCalculo === ModoCalculo::porcentaje ?  ($this->capital01 * (float) $this->pct02 / 100)  : $this->capital02,
            ]
        ];
        $uf = $ufUseCase->run($this->fechaPago)->uf;
        $this->resultado = $uc->run($this->fechaPago, $uf, $this->periodo,$this->administradora,$deudas);
        //dd($resultado);
//        $uf = $ufUseCase->run($this->fechaPago);
//        $fondo01 = $uc->run((int)$this->capital01, $this->fechaPago, $uf, $this->periodo, $this->fondo01, $this->administradora);
//        $fondo02 = $uc->run((int)$this->capital02, $this->fechaPago, $uf, $this->periodo, $this->fondo02, $this->administradora);
//
//        $this->resultado = [
//            'uf' => (float)$uf,
//            'capital' => (float)$this->fondo01 + (float)$this->fondo02,
//            'reajuste' => (float)$fondo01['reajuste'] + (float)$fondo02['reajuste'],
//            'intereses'=> (float)$fondo01['intereses'] + (float)$fondo02['intereses'],
//            'recargo'=> (float)$fondo01['recargo'] + (float)$fondo02['recargo'],
//            'deuda_actualizada'=> (float)$fondo01['deuda_actualizada'] + (float)$fondo02['deuda_actualizada'],
//        ];

    }

    public function truncateFloat(float $valor): float
    {
        return round(floor($valor * 100) / 100, 0);
    }

    public function render()
    {
        return view('livewire.calculo.calculadora',
            [
                'resultados' => $this->resultado ?? [],
                'fondos' => [
                    [
                        'id' => 'A',
                        'name' => 'Fondo A',
                    ],
                    [
                        'id' => 'B',
                        'name' => 'Fondo B',
                    ],
                    [
                        'id' => 'C',
                        'name' => 'Fondo C',
                    ],
                    [
                        'id' => 'D',
                        'name' => 'Fondo D',
                    ],
                    [
                        'id' => 'E',
                        'name' => 'Fondo E',
                    ],
                    [
                        'id' => 'CIC',
                        'name' => 'Fondo CIC',
                    ],
                ],
                'modo' => [
                    [
                        'id' => ModoCalculo::fondo,
                        'name' => 'Fondo',
                    ],
                    [
                        'id' => ModoCalculo::porcentaje,
                        'name' => 'Porcentaje',
                    ]
                ],
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
            ]);
    }
}
