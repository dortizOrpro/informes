<?php

namespace Src\Shared\UserInterface\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Mary\View\Components\Nav as MaryNav;

class Nav extends MaryNav // Component
{
    public function render(): View|Closure|string
    {
        return view('cds::nav');
    }
}
