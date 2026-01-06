<?php

namespace Src\Shared\UserInterface\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FileInput extends Component
{
    public string $uuid = '';

    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?bool $separator = false,
        public ?string $progressIndicator = null,
        public ?bool $withAnchor = false,
        public ?string $size = 'text-4xl',
        public ?bool $hideProgress = false,
        public ?bool $omitError = false,
        public ?string $hint = null,

    ) {
        $this->uuid = 'cds'.hash('sha256', serialize($this));
    }

    public function progressTarget(): ?string
    {
        if ($this->progressIndicator == 1) {
            return $this->attributes->whereStartsWith('progress-indicator')->first();
        }

        return $this->progressIndicator;
    }

    public function modelName(): ?string
    {
        return $this->attributes->whereStartsWith('wire:model')->first();
    }

    public function errorFieldName(): ?string
    {
        return $this->errorField ?? $this->modelName();
    }

    public function render(): View|Closure|string
    {
        return view('cds::file-input');
    }
}
