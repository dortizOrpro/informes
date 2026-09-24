<?php

namespace Src\Informes\Infraestructure\Controllers;

class ReporteEscritosController
{
    public function __invoke()
    {
        return view('pages.informes.reporte-escritos.inicio');
    }
}