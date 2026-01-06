<?php

namespace App\Livewire\Pagos;

use Livewire\Component;
use Src\Caja\Application\UseCases\ListarPagosUseCase;

class Listado extends Component
{
    private function headers():array
    {
        return [
            ['key' => 'id', 'label' => 'N°', 'class'=>'', 'sort' => true],
            ['key' => 'tipopago_id', 'label' => 'Tipo', 'class'=>'', 'sort' => true],
            ['key' => 'fecha', 'label' => 'Fecha', 'class'=>'', 'sort' => true],
            ['key' => 'usuario_id', 'label' => 'Usuario', 'class'=>'', 'sort' => true],
            ['key' => 'rut', 'label' => 'R.U.T.', 'class'=>'', 'sort' => true],
            ['key' => 'nombres', 'label' => 'Nombre', 'class'=>'', 'sort' => true],
            ['key' => 'total', 'label' => 'Total', 'class'=>'', 'sort' => true],
        ];
    }
    public function render(ListarPagosUseCase $useCase)
    {
        return view('livewire.pagos.listado',
        [
            'headers' => $this->headers(),
            'pagos'=> $useCase->run()
        ]
        );
    }
}
//id bigserial NOT NULL,
//	preingreso_id uuid NULL,
//	rut int4 NULL,
//	nombres text NULL,
//	apaterno text NULL,
//	amaterno text NULL,
//	telefono int4 NULL,
//	email text NULL,
//	total numeric NULL,
//	honorarios numeric NULL,
//	gastos numeric NULL,
//	tipopago_id int4 NULL,
//	fecha timestamp NULL,
//	agencia_id int4 NULL,
//	usuario int4 NULL
