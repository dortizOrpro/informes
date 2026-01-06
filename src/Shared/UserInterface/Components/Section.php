<?php

namespace Src\Shared\UserInterface\Components;

class Section
{
    private array $entries = [];

    public string $description;

    public ?string $icon = null;

    private \stdClass $data;

    /**
     * Create a new class instance.
     */
    public function __construct(string $name)
    {
        $this->description = ucfirst($name);
    }

    public static function make(string $name): Section
    {
        return new self($name);
    }

    public function description(string $description): Section
    {
        $this->description = $description;

        return $this;
    }

    public function icon(string $icon): Section
    {
        $this->icon = $icon;

        return $this;
    }

    public function addEntry(TextEntry $entry): Section
    {
        $this->entries[] = $entry;

        return $this;
    }

    public function entries(array $entries): Section
    {
        $this->entries = array_merge($this->entries, $entries);

        return $this;
    }

    public function getEntries(): array
    {
        return $this->entries;
    }

    public function data($data): Section
    {
        $this->data = $data;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }
}
