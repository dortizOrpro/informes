<?php

namespace Src\Shared\UserInterface\Components;

use Livewire\Wireable;

class Filter implements Wireable
{
    public function __construct(
        public string $name,
        public string $label,
        public string $type,
        public array $options = [],
        public ?string $pattern = null
    ) {
        //
    }

    public function toLivewire(): array
    {
        return (array) $this;
    }

    /**
     * @return void
     */
    public static function fromLivewire($value) {}
}
