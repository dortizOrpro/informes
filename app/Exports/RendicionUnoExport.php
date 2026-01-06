<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithStyles,
    WithCustomStartCell
};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class RendicionUnoExport implements FromCollection, WithStyles, WithCustomStartCell
{
    protected Collection $data;
    protected string $fecha;

    public function __construct(Collection $data, string $fecha)
    {
        $this->data  = $data;
        $this->fecha = $fecha;
    }

    public function startCell(): string
    {
        return 'A3';
    }

    public function collection(): Collection
    {
        return $this->data->map(fn ($r) => [
            $r['rut_empleador'],
            $r['rut_afiliado'],
            $r['periodo_pagado'],
            $r['nro_planilla'],
            $r['monto_planilla'],
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $lastDataRow = 3 + $this->data->count();
        $lastRow     = max($lastDataRow, 35);

        $sheet->mergeCells('B1:E1');
        $sheet->setCellValue('B1', 'RENDICION ' . $this->fecha);
        $sheet->getStyle('B1')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9EEF3'],
            ],
        ]);

        $headers = [
            'A2' => "RUT\nEMPLEADOR",
            'B2' => "RUT AFILIADO",
            'C2' => "PERIODO\nPAGADO",
            'D2' => "NRO PLANILLA",
            'E2' => "MONTO PLANILLA",
        ];

        foreach ($headers as $cell => $text) {
            $sheet->setCellValue($cell, $text);
        }

        $sheet->getStyle('A2:E2')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
                'wrapText'   => true,
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9EEF3'],
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
        ]);

        $sheet->getStyle("A2:E{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
        ]);

        $sheet->getStyle("A3:D{$lastRow}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle("E3:E{$lastRow}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        foreach (['A' => 18, 'B' => 18, 'C' => 16, 'D' => 22, 'E' => 18] as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        $sheet->getRowDimension(2)->setRowHeight(30);
    }
}
