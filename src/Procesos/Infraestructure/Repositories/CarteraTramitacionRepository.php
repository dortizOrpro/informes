<?php

namespace Src\Procesos\Infraestructure\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelWriter;

class CarteraTramitacionRepository
{
    public function generar($params)
    {
        $sql = file_get_contents(
            resource_path('sql/cartera-tramitacion/cartera-tramitacion.sql')
        );

        $data = DB::select($sql, [
            'fecha_ini' => $params['fecha_ini']
                ? Carbon::parse($params['fecha_ini'])->startOfDay()->format('Y-m-d H:i:s')
                : null,

            'fecha_fin' => $params['fecha_fin']
                ? Carbon::parse($params['fecha_fin'])->endOfDay()->format('Y-m-d H:i:s')
                : null,
        ]);

        $name = 'CARTERA_TRAMITACION_' .
            Carbon::parse($params['fecha_ini'])->format('Ymd') . '_' .
            Carbon::parse($params['fecha_fin'])->format('Ymd') .
            '.xlsx';

        $filePath = Storage::disk('public')->path($name);

        $writer = SimpleExcelWriter::create($filePath);

        foreach ($data as $row) {
            $writer->addRow((array) $row);
        }

        $writer->close();

        return Storage::disk('public')->download(
            path: $name,
            name: $name
        );
    }
}
