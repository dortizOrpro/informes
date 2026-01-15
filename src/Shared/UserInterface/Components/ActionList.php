<?php

namespace Src\Shared\UserInterface\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class ActionList extends Component
{
    public Collection $actions;

    public function __construct(
        $actions = [],
        public ?string $title = null,
        public ?string $subtitle = null,
    ) {
        $this->actions = collect($actions);
    }

    public function render(): View|Closure|string
    {
        return view('cds::action-list');
    }
}
