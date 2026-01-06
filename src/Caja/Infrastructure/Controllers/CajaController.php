<?php

namespace Src\Caja\Infrastructure\Controllers;

class CajaController
{
    public function __invoke()
    {
        return view('pages.caja.index');
    }
}
