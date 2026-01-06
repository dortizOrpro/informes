<?php

namespace Src\Shared\UserInterface\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sweetalert extends Component
{

    public function render():View|string
    {
        return view('cds::sweetalert');
    }
}
