<?php

namespace App\Services;

use App\Exports\RendicionUnoExport;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class RendicionesUnoService
{
    public function exportarExcel($fecha, $clienteId)
    {
        $data = collect([
            [
                'rut_empleador'   => '0077451786-3',
                'rut_afiliado'    => '021449857-K',
                'periodo_pagado'  => '01-04-2025',
                'nro_planilla'    => '2013202504231970',
                'monto_planilla'  => 222463,
            ],
            [
                'rut_empleador'   => '0077451786-3',
                'rut_afiliado'    => '022023511-4',
                'periodo_pagado'  => '01-04-2025',
                'nro_planilla'    => '2013202504231970',
                'monto_planilla'  => 222463,
            ],
            [
                'rut_empleador'   => '0076950491-5',
                'rut_afiliado'    => '020909123-2',
                'periodo_pagado'  => '01-10-2024',
                'nro_planilla'    => '2013202410073990',
                'monto_planilla'  => 91943,
            ],
        ]);

        $path = 'exports/rendicion_' . now()->timestamp . '.xlsx';

        Excel::store(
            new RendicionUnoExport($data, $fecha),
            $path,
            'public' 
        );

        return Storage::disk('public')->path($path);
        
    }
}
