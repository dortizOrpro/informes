<?php

namespace Src\Informes\Infraestructure\Controllers;

class CronologiaController
{
    public function __invoke()
    {
        return view('pages.informes.cronologias.inicio');
    }
}
