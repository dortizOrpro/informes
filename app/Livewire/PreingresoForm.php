<?php

namespace App\Livewire;

use Livewire\Component;

class PreingresoForm extends Component
{
    // public bool $state = true;

    public $nota = false;
    public $mostrarCopia = false;

    public $emailPreingreso, $asunto, $para, $copia_nombre, $copia_email, $nota_texto, $motivo = '';
    public string $email;

    public function getEmailIconProperty()
    {
        return $this->emailPreingreso && filter_var($this->emailPreingreso, FILTER_VALIDATE_EMAIL)
        ? 'o-check-circle'
        : null;
    }


    public function render()
    {
        return view('livewire.preingreso-form');
    }
}
