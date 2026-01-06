<?php

namespace Src\Shared\UserInterface\Components;

use Illuminate\View\Component;

class Loading extends Component
{
    public function __construct(
        public ?bool $progress = false,

    ) {}

    public function render()
    {
        return view('cds::loading');
    }
}
