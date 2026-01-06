<?php

namespace App\Livewire\Component;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SideFilter extends Component
{
    public array $form = [];
    public string $name;
    public string $label = '';
    public string $description = '';
    public array $values = [];

    public function mount()
    {
        Log::info($this->form);
        foreach ($this->form as $item) {
            $this->values[$item['name']] = $item['type'] === 'multicheck' ? [] : null;
        }
    }
    public function filtrar() {
        $this->dispatch('side-filter.' . $this->name, $this->values);
    }

    public function limpiar()
    {
        $this->values = [];
        $this->dispatch('side-filter.' . $this->name, $this->values);
    }
    public function render()
    {
        return view('livewire.component.side-filter');
    }
}
