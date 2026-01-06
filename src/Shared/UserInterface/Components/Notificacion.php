<?php

namespace Src\Shared\UserInterface\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Notificacion extends Component
{
    public function __construct(
        public string $title = '',
        public string $subtitle = '',
        public string $type = 'info',
        public string $icon = 'carbon.circle-solid',
        public bool $dark = false
    ) {
        //
    }

    public function bgColor(): string
    {
        return 'bg-'.$this->type;
    }

    public function render(): View|Closure|string
    {
        return view('cds::notification',
            ['bgColor'.$this->bgColor()]
        );
    }
}
