<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RendicionAfcExport implements FromCollection, WithHeadings
{
    protected Collection $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection(): Collection
    {
        return $this->data->map(fn ($r) => [
            $r['agencia_pago'] ?? '',
            $r['ingreso_caja'] ?? '',
            $r['numero_resolucion'] ?? '',
            $r['periodo'] ?? '',
            $r['rut'] ?? '',
            $r['nombre'] ?? '',
            $r['capital'] ?? 0,
            $r['interes'] ?? 0,
            $r['reajuste'] ?? 0,
            $r['recargo'] ?? 0,
            $r['emi'] ?? '',
            $r['nro_afiliado'] ?? '',
            $r['rut_afiliado'] ?? '',
            $r['nombre_afiliado'] ?? '',
            $r['monto_fondo'] ?? 0,
        ]);
    }

    public function headings(): array
    {
        return [
            'Agencia Pago',
            'Ingreso  Caja',
            'Numero Resolucion',
            'Periodo (MM/AAAA)',
            'Rut',
            'Nombre',
            'Capita',
            'Interes',
            'Reajuste',
            'Recargo',
            'Emi',
            'No. De Afiliado',
            'Rut Afiliado',
            'Nombre Afiliado',
            'Monto fondo',
        ];
    }
}
