<?php

namespace Src\Shared\UserInterface\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Header extends Component
{
    public string $anchor = '';

    public function __construct(
        public ?string $title = null,
        public ?string $subtitle = null,
        public ?bool $separator = false,
        public ?string $progressIndicator = null,
        public string $progressIndicatorClass = 'progress-primary',
        public ?string $link = null,
        public ?string $iconLink = null,
        public ?string $tooltipLink = '',
        public ?string $size = 'text-2xl',
        public bool $withAnchor = false,

        // Icon
        public ?string $icon = null,
        public ?string $iconClasses = null,

        // Slots
        public mixed $middle = null,
        public mixed $actions = null,
    ) {
        $this->anchor = Str::slug($title);
    }

    public function render(): View|Closure|string
    {
        return view('cds::header');
    }
}
