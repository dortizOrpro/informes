<?php

namespace Src\Shared\UserInterface\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormData extends Component
{
    public array $variables = [];

    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $content = [],
        public bool $debug = false
    ) {
        //
    }

    public function options(mixed $options): array
    {
        $result = match (is_string($options)) {
            true => $this->parse($options),
            false => $options,
        };

        return $result;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('cds::form-data',
            [
                'rows' => $this->content['rows'] ?? [],
                'title' => $this->content['title'] ?? '',
                'subtitle' => $this->content['subtitle'] ?? '',
            ]
        );
    }

    private function parse($options)
    {
        $parts = explode('>', $options);
        $args = explode(',', $parts[1]);

        return call_user_func_array($parts[0], $args);
    }
}
