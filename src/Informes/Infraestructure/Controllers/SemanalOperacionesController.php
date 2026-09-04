<?php

namespace Src\Informes\Infraestructure\Controllers;

class SemanalOperacionesController
{
    public function __invoke()
    {
        return view('pages.informes.semanal-operaciones.inicio');
    }
}