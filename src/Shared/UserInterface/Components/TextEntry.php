<?php

namespace Src\Shared\UserInterface\Components;

class TextEntry
{
    public string $label;

    private ?\Closure $_formatter = null;

    /**
     * Create a new class instance.
     */
    public function __construct(public string $data)
    {
        //
    }

    public static function make(string $data): TextEntry
    {
        return new self($data);
    }

    public function label(string $label): TextEntry
    {
        $this->label = $label;

        return $this;
    }

    public function formatter(\Closure $formatter): TextEntry
    {
        $this->_formatter = $formatter;

        return $this;
    }

    public function hasFormmater(): bool
    {
        return ! is_null($this->_formatter);
    }

    public function format($data): string
    {
        $function = $this->_formatter;

        return $function($data);
    }
}
