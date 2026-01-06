<?php

namespace Src\Shared\UserInterface\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Selectize extends Component
{
    public string $uuid;

    public function __construct(
        public ?string $label = null,
        public ?string $optionValue = 'id',
        public ?string $optionLabel = 'name',
        public ?string $name = '',
        public Collection|array $options = new Collection,
        public ?string $icon = null,
        public ?string $iconRight = null,
        public ?string $hint = null,
        public ?bool $clearable = false,
        public ?string $prefix = null,
        public ?string $suffix = null,
        public mixed $append = null,
        public mixed $prepend = null,
        public ?bool $omitError = false,
        public ?string $errorClass = 'text-red-500 label-text-alt p-1',
        public ?bool $firstErrorOnly = false,
        public ?string $rightContent = null,
        public ?string $classRight = null,
    ) {
        $this->uuid = 'cds'.hash('sha256', serialize($this));

    }

    public function modelName(): ?string
    {
        return $this->attributes->whereStartsWith('wire:model')->first();
    }

    public function errorFieldName(): ?string
    {
        return $this->errorField ?? $this->modelName();
    }

    public function isReadonly(): bool
    {
        return $this->attributes->has('readonly') && $this->attributes->get('readonly') == true;
    }

    public function isDisabled(): bool
    {
        return $this->attributes->has('disabled') && $this->attributes->get('disabled') == true;
    }
    //
    //    public function isLive(): string
    //    {
    //        return is_null($this->attributes->whereStartsWith('wire:model.live')->first()) ? 'false' : 'true';
    //    }
    //
    //    public function getOptionValue($option): mixed
    //    {
    //        $value = data_get($option, $this->optionValue);
    //
    //        if ($this->valuesAsString) {
    //            return "'$value'";
    //        }
    //
    //        return is_numeric($value) && ! str($value)->startsWith('0') ? $value : "'$value'";
    //    }

    public function render()
    {
        return view('cds::selectize');
    }
}
