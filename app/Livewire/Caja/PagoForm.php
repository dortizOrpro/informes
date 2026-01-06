<?php

namespace App\Livewire\Caja;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Ramsey\Uuid\Uuid;
use Src\Caja\Application\UseCases\GuardarPagoUseCase;
use Src\Caja\Application\UseCases\GuardarPreingresoUseCase;
use Src\Calculo\Domain\Enums\TipoPago;

class PagoForm extends Component
{
    public bool $state = true;
    public string $preingreso = "demo";
    public string $rut;
    public string $nombres;
    public string $apPaterno;
    public string $apMaterno;

    public string $telefono;
    public string $email;

    public array $metodosPago = [];
    public array $bancos = [];
    public array $clientes = [];
    public TipoPago $tipoPago;

    public array $calculos = [];
    public array $detalles = [];
    public int $totalPago = 0;

    public function mount()
    {
        $this->metodosPago = [
            [ 'id' => TipoPago::efectivo, 'name' => 'Efectivo'],
            [ 'id' => TipoPago::transferencia, 'name' => 'Transferencia'],
            [ 'id' => TipoPago::cheque, 'name' => 'Cheque'],
            [ 'id' => TipoPago::enCliente, 'name' => 'Pago en cliente'],
            [ 'id' => TipoPago::consignacion, 'name' => 'Consignación'],
        ];
        $this->bancos = [
            ['id'=>1, 'name'=>'De Chile'],
            ['id'=>9, 'name'=>'Internacional'],
            ['id'=>14, 'name'=>'Scotiabank Chile'],
            ['id'=>16, 'name'=>'De Credito E Inversiones'],
            ['id'=>28, 'name'=>'Bice'],
            ['id'=>31, 'name'=>'Hsbc Bank'],
            ['id'=>37, 'name'=>'Santander-Chile'],
            ['id'=>39, 'name'=>'Itaú Chile'],
            ['id'=>49, 'name'=>'Security'],
            ['id'=>51, 'name'=>'Falabella '],
            ['id'=>53, 'name'=>'Ripley '],
            ['id'=>55, 'name'=>'Consorcio'],
            ['id'=>59, 'name'=>'Btg Pactual Chile'],
            ['id'=>62, 'name'=>'Tanner Digital'],
            ['id'=>12, 'name'=>'Del Estado De Chile'],

        ];
        $this->clientes =[
            [
                "id" => 1000,
                "name" => "Previred"
            ],
        [
            "id" => 1005,
            "name" => "A.F.P. Habitat S.A."
        ],
        [
            "id" => 1008,
            "name" => "A.F.P. Provida S.A."
        ],
        [
            "id" => 1032,
            "name" => "A.F.P. Planvital S.A."
        ],
        [
            "id" => 1033,
            "name" => "A.F.P. Capital S.A."
        ],
        [
            "id" => 1034,
            "name" => "A.F.P. Modelo S.A."
        ],
        [
            "id" => 1035,
            "name" => "A.F.P. Uno S.A."
        ],
        [
            "id" => 1099,
            "name" => "A.F.C. Chile S.A."
        ]
    ];
;
    }
    public function cancel()
    {
        $this->dispatch('parametros.pago-cerrar',0 );
    }

    public function rules()
    {
        return [
            'rut' => 'required|rut',
            'nombres' => 'required|string',
            'apPaterno' => 'required|string',
            'apMaterno' => 'required|string',
            'telefono' => 'required|numeric',
            'email' => 'required|email',
            'tipoPago' => 'required',
        ];
    }
    public function guardar(GuardarPagoUseCase  $useCase)
    {
        $pago = $this->validate($this->rules());
        $deudas = array_map(
            fn($deuda) => ['deuda_id' => $deuda['id']],
            Cache::get($this->preingreso)
        );
        $status = $useCase->run(
            tipoPago: $this->tipoPago,
            preingreso: $this->preingreso,
            fecha: date('Y-m-d H:i:s'),
            usuarioId: 9999,
            pago: $pago,
            calculos: $this->calculos,
            detalle: $this->detalles,
            deudas: $deudas,
        );

        Log::info("Guardar Pago", $pago);
        $this->dispatch('parametros.pago-cerrar', $status ? 200:500);

    }
    public function render()
    {
        return view('livewire.caja.pago-form');
    }
}
