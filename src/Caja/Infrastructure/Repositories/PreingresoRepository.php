<?php

namespace Src\Caja\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Src\Caja\Domain\Contracts\PreingresoRepositoryContract;
use Src\Calculo\Domain\Enums\TipoCalculo;

class PreingresoRepository implements PreingresoRepositoryContract
{


    public function guardar(TipoCalculo $tipoCalculo, array $params, string $vencimiento, string $fechaCalculo, int $usuarioId, array $deudas): string
    {
        $uuid = Uuid::uuid7();
        DB::table('recaudacion.preingreso')
            ->insert([
                'uuid' => $uuid,
                'vencimiento' => $vencimiento,
                'fecha_calculo' => $fechaCalculo,
                'usuario_id' => $usuarioId,
                'tipo_calculo' => $tipoCalculo,
                'params' => json_encode($params),
                'factores' => json_encode($deudas),
            ]);
        return $uuid->toString();
    }

    public function guardarDetalle(string $preingresoId, array $detalle): void
    {
        $fecha = date('Y-m-d H:i:s');
        $datos = array_map(
            fn ($item) => [
                'preingreso_id' => $preingresoId,
                'deuda_id' => $item['deuda_id'],
                'capital' => $item['capital'],
                'reajuste' => $item['reajuste'],
                'intereses' => $item['intereses'],
                'recargo' => $item['recargo'],
                'apago' => $item['deuda_actualizada'],
                'fondo_id' => $item['fondo'],
                'cobranza_id' => $item['cobranza_id'],
            ],
            $detalle
        );
        //dd($datos);
        DB::table('recaudacion.preingreso_detalle')->insert($datos);
        $this->guardarEstado($detalle, $fecha, 150);
    }

    public function guardarEstado(array $deudas, string $fecha, int $estadoId): bool
    {
        $registros = array_map(
            fn($deuda) => ['deuda_id' => $deuda['deuda_id'],'estado_id' => $estadoId, 'fecha' => $fecha],
            $deudas
        );
        return DB::table('recaudacion.deuda_estado')
            ->upsert(
                $registros,
                ['deuda_id'],
                ['fecha', 'estado_id']
            );
    }
}

//'capital' => $deuda,
//            'reajuste' => $factores->factorReajuste * $deuda * $uf, // round
//            'intereses' => $reajuste * ($factores->factorInteres - 1), // round
//            'recargo' => $reajuste * $factores->recargo, // round
//            'deuda_actualizada' => ($factores->factorGeneral * $deuda * $uf), // + ($factores->recargo * $deuda)//round
//  preingreso_id uuid,
//	deuda_id bigint,
//	capital numeric,
//	reajuste numeric,
//	interes numeric,
//	recargo numeric,
//	apago numeric
