<?php

namespace Src\Shared\UserInterface\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

trait Sweetalert
{
    public function sweetalert($type, $options): void
    {
        $this->dispatch('swal',
            array_merge($options, ['icon' => $type, ])
        );
    }
}
