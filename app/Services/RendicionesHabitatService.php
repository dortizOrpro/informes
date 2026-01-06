<?php

namespace App\Services;

use App\Exports\RendicionHabitatExport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class RendicionesHabitatService
{
    public function exportarExcel($fecha, $cliente): string
    {
        $data = collect([
            [
                'fec_deposito' => '2025-12-09',
                'nro_docto_deposito' => '123456',
                'monto_total_fondo' => 5000000,
                'excepciones' => '',
                'recargo_afp' => 0,
                'interes' => 0,
                'usuario_preconciliacion' => 'sistema',
                'codigo_eejj' => 'EEJJ01',
                'nro_rendicion' => 'RND-2025-01',
                'tipo_proceso' => 'NORMAL',
                'monto_nominal_pagado' => 5000000,
                'monto_nominal_obligatorio' => 4800000,
                'monto_nominal_voluntario' => 0,
                'nominal_voluntario_colectivo' => 0,
                'monto_nominal_ahorro_voluntario' => 0,
                'monto_nominal_indemnizacion' => 0,
                'monto_nominal_dep_convenido' => 0,
                'monto_nominal_trabajo_pesado' => 0,
                'monto_nominal_afiliado_voluntario' => 0,
                'monto_nominal_sis' => 200000,
                'nro_doc_consignacion' => '',
                'fec_pago' => '2025-12-09',
                'fec_retiro_consignacion' => '',
                'fec_giro_cheque' => '',
                'nro_cheque' => '',
                'monto_cheque' => 0,
                'fec_rendicion' => '2025-12-09',
                'rut_deudor' => '12345678',
                'dv' => '9',
                'razon_social' => 'EMPRESA DE PRUEBA SPA',
                'rit_rol' => 'C-123-2025',
                'cod_tribunal' => '001',
                'nombre_tribunal' => 'JUZGADO LABORAL',
                'resolucion' => 'PAGADO',
                'nud' => 'NUD123',
                'periodo' => '202504',
                'monto_costas_procesales' => 0,
                'monto_costas_personales' => 0,
                'nro_de_afiliados' => 5,
                'tipo_pago' => 'TRANSFERENCIA',
                'eejj_tipo_documento_pago' => 'DEP',
            ],
        ]);

        $path = 'exports/habitat_rendicion_' . now()->timestamp . '.xlsx';

        Excel::store(
            new RendicionHabitatExport($data),
            $path,
            'public'
        );

        return Storage::disk('public')->path($path);
    }
}
