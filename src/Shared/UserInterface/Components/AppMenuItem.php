<?php

namespace Src\Shared\UserInterface\Components;

use Illuminate\View\Component;

class AppMenuItem extends Component
{
    public string $uuid;

    public function __construct(
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $link = null,
        public ?string $target = null,
    ) {
        $this->uuid = 'cds'.hash('sha256', serialize($this));
    }

    public function render()
    {
        return view('cds::app-menu-item');
    }
}
