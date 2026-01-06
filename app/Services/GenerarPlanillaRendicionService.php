<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class GenerarPlanillaRendicionService
{
    /**
    * Genera un archivo de texto plano con el contenido recibido.
    *
    * @param array $lineas
    * @return string Ruta del archivo
    */

    public function generarPDF($fecha): string
    {
        $fecha = Carbon::parse($fecha)->format('d/m/Y');

        $pdf = Pdf::loadView('livewire.rendiciones.planillas.pdf.planilla',
            [
                'fecha'=> $fecha,
            ]
        )->setPaper('a4', 'landscape');

        $fileName = 'planilla_' . time() . '.pdf';
        $filePath = 'pdf/' . $fileName; 

        Storage::disk('public')->put($filePath, $pdf->output());

        return storage_path('app/public/' . $filePath);
    }
}
