<?php

namespace Src\Procesos\Infraestructure\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ActividadRepository
{
    public function getActividades(array $options = []): array
    {
        return DB::table('actividades.codigo as act')
            ->select('act.id', 'act.codigo as name', 'act.tipo')
            ->where('act.habilitada', true)
            ->where('act.id', '>', 1000)
            ->orderBy('act.id', 'ASC')
            ->get()->toArray();
    }

    public function guardarActividadMasiva($actividad_id, $tipo, $rows)
    {
        $total = 0;
        $result = ['code' => 200, 'message' => 'Actividad guardada'];
        foreach ($rows as $row) {
            try {
                $uuid = Uuid::uuid5(Uuid::NAMESPACE_URL,
                    implode('/', [
                        ($row["fecha"])->format('Y-m-d'),
                        (int) $row['cobranza_id'],
                        $actividad_id,
                        9999,
                        Str::of($tipo)->substr(0, 1)->upper()->toString(),
                    ])
                )->toString(); 
                    

                $arrRegistro = [
                    'fecha' => ($row["fecha"])->format('Y-m-d'),
                    'tipo' => Str::of($tipo)->substr(0, 1)->upper()->toString(),
                    'descripcion' => '',
                    'digitado' => date('Y-m-d H:i:s'),
                    'codigo_id' => $actividad_id,
                    'estado_id' => 1,
                    'cobranza_id' =>  (int) $row['cobranza_id'],
                    'usuario_id' => 9999,
                    'uuid'=> $uuid,
                ];

                DB::table('actividades.actividad')->updateOrInsert(
                        $arrRegistro,
                        [
                            'descripcion' => 'Actividad Masiva',
                        ]
                );
                
                $total++;

            } catch (\Exception $e) {
                $result = ['code' => 500, 'message' => $e->getMessage()];
            }
        }
        $result['total'] = $total;
        return $result;
        // $this->guardarVariables($uuid, $actividad->usuario_id, $actividad->variables);

    }

    private function guardarVariables(string $actividadUuid, int $usuarioId, array $variables): void
    {
        DB::table('actividades.variable')->updateOrInsert(
            ['actividad_uuid' => $actividadUuid],
            [
                'variables' => json_encode($variables),
                'usuario_id' => $usuarioId,
            ]
        );
    }


}
