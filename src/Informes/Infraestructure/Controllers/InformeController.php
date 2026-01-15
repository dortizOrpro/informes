<?php

namespace Src\Informes\Infraestructure\Controllers;

class InformeController
{
    public function __invoke()
    {
        return view('pages.informes.inicio', [
            'actions' => config('informes'),
        ]);
    }
}
