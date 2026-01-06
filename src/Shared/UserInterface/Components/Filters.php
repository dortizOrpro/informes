<?php

namespace Src\Shared\UserInterface\Components;

use Illuminate\View\Component;

class Filters extends Component
{
    public bool $show = false;

    public function __construct(public array $form, public string $name, public string $label = '', public string $description = '')
    {
        //
    }

    public function render()
    {
        return view('cds::filters');
    }
}
