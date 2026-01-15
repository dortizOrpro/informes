<?php

namespace Src\Shared\UserInterface\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionListItem extends Component
{
    public function __construct(
        public array $action
    ) {}

    public function render(): View|Closure|string
    {
        return view('cds::action-list-item');
    }
}
