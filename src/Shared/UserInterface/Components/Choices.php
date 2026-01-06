<?php

namespace Src\Shared\UserInterface\Components;

use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Choices extends Component
{
    public string $uuid;

    public function __construct(
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $hint = null,
        public ?string $hintClass = 'label-text-alt text-gray-400 py-1 pb-0',
        public ?bool $searchable = false,
        public ?bool $single = false,
        public ?bool $compact = false,
        public ?string $compactText = 'selected',
        public ?bool $allowAll = false,
        public ?string $debounce = '250ms',
        public ?int $minChars = 0,
        public ?string $allowAllText = 'Select all',
        public ?string $removeAllText = 'Remove all',
        public ?string $optionValue = 'id',
        public ?string $optionLabel = 'name',
        public ?string $optionSubLabel = '',
        public ?string $optionAvatar = 'avatar',
        public ?bool $valuesAsString = false,
        public ?string $height = 'max-h-64',
        public Collection|array $options = new Collection,
        public ?string $noResultText = 'No results found.',
        // Validations
        public ?string $errorField = null,
        public ?string $errorClass = 'text-red-500 label-text-alt p-1',
        public ?bool $omitError = false,
        public ?bool $firstErrorOnly = false,
        // slots
        public mixed $item = null,
        public mixed $selection = null,
        public mixed $prepend = null,
        public mixed $append = null
    ) {
        $this->uuid = 'mary'.hash('sha256', serialize($this));

        if (($this->allowAll || $this->compact) && ($this->single || $this->searchable)) {
            throw new Exception('`allow-all` and `compact` does not work combined with `single` or `searchable`.');
        }
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

    public function isRequired(): bool
    {
        return $this->attributes->has('required') && $this->attributes->get('required') == true;
    }

    public function getOptionValue($option): mixed
    {
        $value = data_get($option, $this->optionValue);

        if ($this->valuesAsString) {
            return "'$value'";
        }

        return is_numeric($value) && ! str($value)->startsWith('0') ? $value : "'$value'";
    }

    public function render(): View|Closure|string
    {
        return view('cds::choices-offline');
    }
}
