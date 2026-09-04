<?php

namespace Src\Informes\Infraestructure\Controllers;

class CarteraTramitacionController
{
    public function __invoke()
    {
        return view('pages.informes.cartera-tramitacion.inicio');
    }
}