<?php
namespace Src\Rendicion\Infrastructure\Controllers;

use Illuminate\Http\Request;

class RendicionController
{
    public function __invoke()
    {
        return view('pages.rendicion.index');
    }
}
