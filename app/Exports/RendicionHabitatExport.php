<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings
};

class RendicionHabitatExport implements FromCollection, WithHeadings
{
    protected Collection $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection(): Collection
    {
        return $this->data->map(fn ($r) => [
            $r['fec_deposito'] ?? '',
            $r['nro_docto_deposito'] ?? '',
            $r['monto_total_fondo'] ?? 0,
            $r['excepciones'] ?? '',
            $r['recargo_afp'] ?? 0,
            $r['interes'] ?? 0,
            $r['usuario_preconciliacion'] ?? '',
            $r['codigo_eejj'] ?? '',
            $r['nro_rendicion'] ?? '',
            $r['tipo_proceso'] ?? '',
            $r['monto_nominal_pagado'] ?? 0,
            $r['monto_nominal_obligatorio'] ?? 0,
            $r['monto_nominal_voluntario'] ?? 0,
            $r['nominal_voluntario_colectivo'] ?? 0,
            $r['monto_nominal_ahorro_voluntario'] ?? 0,
            $r['monto_nominal_indemnizacion'] ?? 0,
            $r['monto_nominal_dep_convenido'] ?? 0,
            $r['monto_nominal_trabajo_pesado'] ?? 0,
            $r['monto_nominal_afiliado_voluntario'] ?? 0,
            $r['monto_nominal_sis'] ?? 0,
            $r['nro_doc_consignacion'] ?? '',
            $r['fec_pago'] ?? '',
            $r['fec_retiro_consignacion'] ?? '',
            $r['fec_giro_cheque'] ?? '',
            $r['nro_cheque'] ?? '',
            $r['monto_cheque'] ?? 0,
            $r['fec_rendicion'] ?? '',
            $r['rut_deudor'] ?? '',
            $r['dv'] ?? '',
            $r['razon_social'] ?? '',
            $r['rit_rol'] ?? '',
            $r['cod_tribunal'] ?? '',
            $r['nombre_tribunal'] ?? '',
            $r['resolucion'] ?? '',
            $r['nud'] ?? '',
            $r['periodo'] ?? '',
            $r['monto_costas_procesales'] ?? 0,
            $r['monto_costas_personales'] ?? 0,
            $r['nro_de_afiliados'] ?? 0,
            $r['tipo_pago'] ?? '',
            $r['eejj_tipo_documento_pago'] ?? '',
        ]);
    }

    public function headings(): array
    {
        return [
            'Fec_deposito',
            'Nro_docto_deposito',
            'Monto_Total_Fondo',
            'Excepciones',
            'Recargo_AFP',
            'Interes',
            'Usuario_Preconciliacion',
            'Codigo_Eejj',
            'Nro_Rendicion',
            'Tipo_Proceso',
            'Monto_Nominal_Pagado',
            'Monto_Nominal_Obligatorio',
            'Monto_Nominal_Voluntario',
            'Nominal_Voluntario_Colectivo',
            'Monto_Nominal_Ahorro_Voluntario',
            'Monto_Nominal_Indemnizacion',
            'Monto_Nominal_Dep.Convenido',
            'Monto_Nominal_Trabajo_Pesado',
            'Monto_Nominal_Afiliado_Voluntario',
            'Monto_Nominal_Sis',
            'Nro_doc.Consignacion',
            'Fec_Pago',
            'Fec_retiro_consignacion',
            'Fec_giro_cheque',
            'Nro_cheque',
            'Monto_Cheque',
            'Fec_Rendicion',
            'Rut_Deudor',
            'DV',
            'Razon Social',
            'RIT/ROL',
            'Cod_Tribunal',
            'Nombre Tribunal',
            'Resolucion',
            'NUD',
            'Periodo',
            'Monto_Costas_Procesales',
            'Monto_Costas_Personales',
            'Nro_de_afiliados',
            'Tipo_Pago',
            'EEJJTipo Documento Pago',
        ];
    }
}
