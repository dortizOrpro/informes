<?php

namespace App\Services;

use App\Exports\RendicionAfcExport;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class RendicionesAFCService
{
    public function exportarExcel($fecha, $clienteId): string
    {
        $data = collect([
            [
                'agencia_pago' => 'SANTIAGO',
                'ingreso_caja' => 'CAJA01',
                'numero_resolucion' => 'RES-2025-001',
                'periodo' => '04/2025',
                'rut' => '12345678-9',
                'nombre' => 'EMPRESA DEMO SPA',
                'capital' => 150000,
                'interes' => 5000,
                'reajuste' => 3000,
                'recargo' => 0,
                'emi' => 'EMI01',
                'nro_afiliado' => 'AF123456',
                'rut_afiliado' => '11111111-1',
                'nombre_afiliado' => 'JUAN PEREZ',
                'monto_fondo' => 158000,
            ],
        ]);

        $path = 'exports/afc_rendicion_' . now()->timestamp . '.xlsx';

        Excel::store(
            new RendicionAfcExport($data),
            $path,
            'public'
        );

        return Storage::disk('public')->path($path);
    }
}
