<?php

namespace Src\Procesos\Infraestructure\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Src\Domain\Contracts\CronologiaRepositoryContract;

class CronologiaRepository implements CronologiaRepositoryContract
{
    private function filename($salida, $extra): string
    {
        $format = $salida === 1 ? 'DAT' : 'xlsx';

        $nombre = match ((int)$extra['cliente']) {
            76762250 => "MODELO_0%s.$format",
            98000000 => "BANSA_0%s.$format",
            98001200 => "PLA_000%s.$format",
            77601648 => "CRONOAFC.$format",
            76960424 => "CRONOLOGIA_UNOJ_%s.$format",
            78236399 => "SUCC_000%s.$format",

        };

        return vsprintf($nombre, [$extra['tipo']]);
    }

    private function tipoSalida($salida): string
    {
        $salida = match ((int)$salida) {
            1 => "dat",
            2 => "excel",
        };
        return $salida;
    }

    public function getCronologia($params)
    {
        $tipo = $params['extras']['tipo'];
        $cliente = $params['extras']['cliente'];
        $salida = $this->tipoSalida($params['salida']);

        $sql = file_get_contents(
            resource_path('sql/cronologias/dat/'.$params['cliente'].'.sql')
        );

        $data = DB::select($sql);

        $name = $this->filename($params['salida'], $params['extras']);

        if ($salida === 'dat') {
            $this->salidaDat($name, $data);
        } else {
            $this->salidaExcel($name, $data);
        }
 
        return Storage::disk('public')->download(
            path: $name,
            name: $name
        );

    }

    private function salidaDat($name, $data)
    {
        $archivo = new \SplFileObject(Storage::disk('public')->path($name),'w');
        array_map(
            fn($row) => $archivo->fwrite(implode('', (array)$row) . PHP_EOL),
            $data
        );
    }

    private function salidaExcel($name, $data)
    {
        $filePath = Storage::disk('public')->path($name);
    
        $writer = SimpleExcelWriter::create($filePath);
    
        foreach ($data as $row) {
            $writer->addRow((array)$row);
        }
    
        $writer->close();
    }
}

