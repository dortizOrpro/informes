<?php

namespace Src\Shared\UserInterface\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Mary\View\Components\Main as MaryMain;

class Main extends MaryMain
{
    public function render(): View|Closure|string
    {
        return view('cds::main');
    }
}
