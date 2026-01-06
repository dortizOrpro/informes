<?php

namespace Src\Caja\Infrastructure\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Src\Caja\Application\UseCases\GenerarComprobateUseCase;
use Src\Caja\Application\UseCases\ListarComprobantesUseCase;

class ComprobanteController
{
    public function __invoke(int $id, GenerarComprobateUseCase $useCase)
    {
        $comprobante = $useCase->run($id);
        return Response::download(
            Storage::path($comprobante)
//            "comprobante_$id.pdf",
//            [
//            //'Content-Type' => 'application/pdf',
//            'Content-Disposition' => 'inline; filename="comprobante_'.$id.'.pdf"'
//            ]
        );
//        return Storage::download(
//            $comprobante,
//            "comprobante_$id.pdf",
//            [
//                'Content-Type' => 'application/pdf',
//                'Content-Disposition' => 'inline; filename="comprobante_'.$id.'.pdf"'
//            ]
//        );
//        return Response::file(Storage::get($comprobante),
//        [
//            'Content-Type' => 'application/pdf',
//            'Content-Disposition' => 'inline; filename="comprobante_'.$id.'.pdf"'
//        ]);
    }
}
