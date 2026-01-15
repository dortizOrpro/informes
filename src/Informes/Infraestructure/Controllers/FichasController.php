<?php

namespace Src\Informes\Infraestructure\Controllers;

class FichasController
{
    public function __invoke()
    {
        return view('pages.informes.fichas.inicio');
    }
}
