<?php

namespace App\Services;

use App\Exports\RendicionModeloExport;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class RendicionesModeloService
{
    public function exportarExcel($fecha, $clienteId): string
    {
        $data = collect([
            [
                'rut_empleador_1' => '0076123456-7',
                'rut_empleador_2' => '000000761234567',
                'periodo' => '202504',
                'monto_tot_renta_imp' => 1200000,
                'monto_cotizacion' => 120000,
                'intereses' => 2500,
                'reajustes' => 1500,
                'total_fdo_pensiones' => 124000,
                'rut_afiliado' => '12345678-9',
                'nombre' => 'JUAN PEREZ',
                'renta_imponible' => 1200000,
                'cotizacion' => 120000,
                'fecha_deposito' => '2025-04-30',
                'llave' => '13910117',
                'fecha_deposito_2' => '2025-04-30',
            ],
        ]);

        $timestamp = now()->timestamp;

        $excelRelativePath = "exports/modelo_rendicion_{$timestamp}.xlsx";

        Excel::store(
            new RendicionModeloExport($data),
            $excelRelativePath,
            'public'
        );

        $excelPath = Storage::disk('public')->path($excelRelativePath);

        $txtPath = $this->generarTxt($data);

        $zipRelativePath = "exports/rendicion_{$timestamp}.zip";
        $zipPath = Storage::disk('public')->path($zipRelativePath);

        $zip = new \ZipArchive();

        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            throw new \RuntimeException('No se pudo crear el archivo ZIP');
        }

        $zip->addFile($excelPath, basename($excelPath));
        $zip->addFile($txtPath, basename($txtPath));
        $zip->close();

        return $zipPath;
    }

    private function generarTxt($datos): string
    {
        $lineasDetalle = [];

        foreach ($datos as $dato) {
            $lineasDetalle[] = $this->generarDetalle($dato);
        }

        $contenido = implode("\r\n", $lineasDetalle);

        $nombre = 'exports/modelo_rendicion_' . now()->timestamp . '.txt';

        Storage::disk('public')->put($nombre, $contenido);

        return Storage::disk('public')->path($nombre);
    }

    private function generarDetalle($dato)
    {
        // dd($dato['rut_empleador_1']);
        [$rutNumero, $dv] = explode('-', $dato['rut_empleador_1']);
        $rutNumero = ltrim($rutNumero, '0'); 
        $rutNumero = str_pad($rutNumero, 9, '0', STR_PAD_LEFT);

        $dato['razon_social'] = 'INVERSIONES E INMOBILIARIAS AL';
        $sumInteresReajuste = $dato['intereses']+$dato['reajustes'];

        $anio = substr($dato['periodo'], 0, 4);
        $mes  = substr($dato['periodo'], 4, 2);

        $periodo = $mes . $anio;

        $fechaFormateada = Carbon::createFromFormat('Y-m-d', $dato['fecha_deposito'])->format('dmY');
        
        $tipoRegistro   = '1';
        $correlativo    = str_pad(2, 13, '0', STR_PAD_LEFT);
        $registro       = str_pad(1, 8, '0', STR_PAD_LEFT);
        $razonSocial    = str_pad(substr($dato['razon_social'], 0, 30), 30, ' '); 
        $codigoInterno  = str_pad(0, 17, '0', STR_PAD_LEFT);
        $montoCotizacion = str_pad($dato['monto_cotizacion'], 10, '0', STR_PAD_LEFT);
        $recargo        = str_pad(0, 10, '0', STR_PAD_LEFT);
        $reajuste        = str_pad(0, 10, '0', STR_PAD_LEFT);
        $interesReajuste = str_pad($sumInteresReajuste, 10, '0', STR_PAD_LEFT);
        $total          = str_pad($dato['total_fdo_pensiones'], 10, '0', STR_PAD_LEFT);
        $filler1        = str_pad(0, 30, '0', STR_PAD_LEFT);
        $filler2        = 'X';
        $filler3        = ' ';
        $filler4        = str_pad(0, 16, '0', STR_PAD_LEFT);
        $totalRenta     = str_pad($dato['monto_tot_renta_imp'], 10, '0', STR_PAD_LEFT);
        $filler5        = str_pad(0, 10, '0', STR_PAD_LEFT);
        $fechaPago      = $fechaFormateada;
        $filler6        = '0000';
        $filler7        = '2';
        $filler8        = str_pad(substr('', 0, 40), 40, ' '); 
        $filler9        = str_pad(0, 155, '0', STR_PAD_LEFT);

        $linea  = $tipoRegistro;
        $linea .= $correlativo;
        $linea .= $registro;
        $linea .= $razonSocial;
        $linea .= $rutNumero;
        $linea .= $dv;
        $linea .= $codigoInterno;
        $linea .= $montoCotizacion;
        $linea .= $recargo;
        $linea .= $reajuste;
        $linea .= $interesReajuste;
        $linea .= $total;
        $linea .= $filler1;
        $linea .= $filler2;
        $linea .= $filler3;
        $linea .= $periodo;
        $linea .= $filler4;
        $linea .= $totalRenta;
        $linea .= $filler5;
        $linea .= $fechaPago;
        $linea .= $filler6;
        $linea .= $filler7;
        $linea .= $filler8;
        $linea .= $filler9;

        return $linea;
    }
}
