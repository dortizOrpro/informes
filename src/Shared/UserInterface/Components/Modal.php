<?php

namespace Src\Shared\UserInterface\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public function __construct(
        public ?string $id = '',
        public ?string $title = null,
        public ?string $subtitle = null,
        public ?string $boxClass = null,
        public ?bool $separator = false,
        public ?bool $persistent = false,
        public ?string $clickExit = null,

        // Slots
        public ?string $actions = null
    ) {
        //
    }

    public function render(): View|Closure|string
    {
        return view('cds::modal');
    }
}
