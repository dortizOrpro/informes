<?php

namespace App\Livewire\Procesos\ActividadesMasivas;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\FichaGeneratorService;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Mary\Traits\Toast;
use Spatie\SimpleExcel\SimpleExcelReader;
use Src\Procesos\Infraestructure\Services\ActividadService;
use Src\Procesos\Application\UseCases\GuardarActividadMasivaUseCase;

class Parametros extends Component
{
    use WithFileUploads;
    use Toast;
    public ?string $tipo = null;
    public ?string $actividad = null;
    public $excelCobranzas;
    public $deshabilitado = true;
    public $actividades = [];

    public function render()
    {
        return view('livewire.procesos.actividadesMasivas.inicio',
            [
                'tipos'=> [
                    [
                        'id'=> 'P',
                        'name' => 'Administrativa'
                    ],
                    [
                        'id'=> 'J',
                        'name' => 'Judicial'
                    ],
                ]
            ]);
    }

    public function updatedTipo($value, ActividadService $service)
    {
        $this->deshabilitado = true;
        $actividades = $service->actividadesByTipo($value);
        $this->actividades = $actividades;
        $this->deshabilitado = empty($actividades);
    }

    public function procesar(GuardarActividadMasivaUseCase $uc)
    {
        $strUid = uniqid(date('YmdHis'), true) . '.xlsx';
        $this->excelCobranzas->storeAs('actividades', $strUid );
        $excel = SimpleExcelReader::create(Storage::path('actividades/' . $strUid));

        $rows = $excel->useHeaders(['cobranza_id', 'fecha'])->getRows();
       
        // $rows->each(fn($row) => $uc->run($this->actividad, $this->tipo, $row));

        $resultado = $uc->run($this->actividad, $this->tipo, $rows);

        match ($resultado['code']) {
            200 => $this->success(
                title: 'Guardado',
                description: $resultado['message'].' en '.$resultado['total'].' cobranzas',
                position: 'toast-bottom toast-start',
                timeout: 5000
            ),
            500 => $this->error(
                title: 'Se produjo un error',
                description: $resultado['message'],
                position: 'toast-bottom toast-start',
                timeout: 15000
            ),
        };
    }

}
