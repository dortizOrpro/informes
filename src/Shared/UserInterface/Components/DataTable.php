<?php

namespace Src\Shared\UserInterface\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Mary\View\Components\Table;

class DataTable extends Table // extends Component
{
    public function render(): View|Closure|string
    {
        return view('cds::data-table');
    }
}
