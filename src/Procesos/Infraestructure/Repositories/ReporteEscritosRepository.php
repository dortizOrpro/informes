<?php

namespace Src\Procesos\Infraestructure\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ReporteEscritosRepository
{
    public function generar($params)
    {
        $sql = file_get_contents(
            resource_path('sql/reporte-escritos/reporte-escritos.sql')
        );

        $data = DB::select($sql, [
            'fecha_ini' => Carbon::parse($params['fecha_ini'])
                ->startOfDay()
                ->format('Y-m-d H:i:s'),

            'fecha_fin' => Carbon::parse($params['fecha_fin'])
                ->endOfDay()
                ->format('Y-m-d H:i:s'),
        ]);

        $name = 'REPORTE_ESCRITOS_' .
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