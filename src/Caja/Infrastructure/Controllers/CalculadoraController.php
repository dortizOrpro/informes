<?php

namespace Src\Caja\Infrastructure\Controllers;

class CalculadoraController
{
    public function __invoke()
    {
        return view('pages.calculadora.index');
    }
}
