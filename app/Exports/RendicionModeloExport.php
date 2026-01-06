<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RendicionModeloExport implements FromCollection, WithHeadings
{
    protected Collection $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection(): Collection
    {
        return $this->data->map(fn ($r) => [
            $r['rut_empleador_1'] ?? '',
            $r['rut_empleador_2'] ?? '',
            $r['periodo'] ?? '',
            $r['monto_tot_renta_imp'] ?? 0,
            $r['monto_cotizacion'] ?? 0,
            $r['intereses'] ?? 0,
            $r['reajustes'] ?? 0,
            $r['total_fdo_pensiones'] ?? 0,
            $r['rut_afiliado'] ?? '',
            $r['nombre'] ?? '',
            $r['renta_imponible'] ?? 0,
            $r['cotizacion'] ?? 0,
            $r['fecha_deposito'] ?? '',
            $r['llave'] ?? '',
            $r['fecha_deposito_2'] ?? '',
        ]);
    }

    public function headings(): array
    {
        return [
            'Rut_Empleador_1',
            'Rut_Empleador_1',
            'periodo',
            'Monto_tot_renta_imp',
            'Monto Cotizacion',
            'Interses',
            'Reajuestes',
            'Total Fdo Pensiones',
            'rut_afiliado',
            'nombre',
            'renta imponible',
            'cotizacion',
            'fecha_deposito',
            'llave',
            'fecha_deposito',
        ];
    }
}
