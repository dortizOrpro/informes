<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Spatie\SimpleExcel\SimpleExcelReader;
use Src\Informes\Infraestructure\Repositories\FichasRepository;

class FichaGeneratorService
{

    private $total = 0;
    private $zip;
    private $cliente, $resolucion, $estado, $criterio, $tipo, $ruta;
    private FichasRepository $repositorio;

    public function __construct(FichasRepository $repositorio)
    {
        $this->zip = new \ZipArchive();
        $this->repositorio = $repositorio;
    }

    public function generarFichas($criterios)
    {
        $this->setDatos($criterios);

        $zipFile  = 'fichas_' . now()->format('YmdHis') . '.zip';
        $zipPath  = Storage::disk('public')->path($zipFile);

        try {
            Storage::disk('public')->put($zipFile, '');
            $this->zip->open($zipPath, \ZipArchive::CREATE);

            $excel = SimpleExcelReader::create($this->ruta);

            $ids = $this->repositorio->{$this->criterio}($excel, $criterios);

            collect($ids)->each(fn($id) => $this->agregarFicha($id));

            $this->zip->close();
            $this->reset();

            return (object)[
                'total'   => $this->total,
                'archivo' => $zipFile,
            ];

        } catch (\Throwable $e) {
            Log::error('Error generando fichas: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }

    private function agregarFicha(int $id)
    {
        $contenido = Http::get("https://concob.orpro.cl/informe/mostrar/ficha_cobranza?cobranza_id={$id}")->body();
        $this->zip->addFromString("Ficha_{$id}.pdf", $contenido);
        $this->total++;
    }

    private function setDatos($datos)
    {

        $this->ruta = $datos['excel'];

        $this->criterio = match ($datos['criterio']) {
            1 => 'getById',
            2 => 'getByRutEmpleador',
            3 => 'getByCliente',
            4 => 'getByResolucion',
            5 => 'getByRitJuzgado',
        };
    }

    private function reset()
    {
        $this->cliente = $this->resolucion = $this->estado = $this->criterio = $this->tipo = $this->ruta = null;
    }

}
