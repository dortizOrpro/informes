<?php

namespace Src\Shared\UserInterface\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SectionList extends Component
{
    private $data;

    /**
     * Create a new class instance.
     */
    public function __construct(public Section $section, public bool $opened = false)
    {
        $this->data = $this->section->getData();
    }

    private function getValue(TextEntry $entry): ?string
    {
        $value = $this->data->{$entry->data} ?? null;
        if ($entry->hasFormmater()) {
            $value = $entry->format($value);
        }

        return $value;
    }

    public function render(): View
    {
        $entries = array_map(fn (TextEntry $entry) => (object) [
            'label' => $entry->label,
            'value' => $this->getValue($entry),
        ],
            $this->section->getEntries()
        );

        return view('cds::section-list', [
            'entries' => $entries,
        ]);
    }
}
