<?php

namespace Src\Shared\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class Rit // implements ValidationRule
{
    public function validate($attribute, $value, $parameters, $validator): bool
    {
        $check = $this->checkRit($value);
        if (is_string($check)) {
            $validator->setCustomMessages([
                $attribute => 'El :attribute no es valido: '.$check.'.',
            ]);
        }

        return ! is_string($check);
    }

    private function checkRit(mixed $value): string|bool
    {
        $arrRit = explode('-', $value);
        $estructura = (count($arrRit) === 3);
        $errores = match ($estructura) {
            true => [
                $this->checkTipo($arrRit[0]) ?: 'letra de causa no valida',
                $this->checkRol($arrRit[1]) ?: 'rol no valido',
                $this->checkEra($arrRit[2]) ?: 'era debe estar entre 1980 y '.date('Y'),
            ],
            false => ['estructura no valida'],
        };

        $errores = array_filter($errores, fn ($error) => is_string($error));

        return count($errores) === 0 ?: implode(', ', $errores);
    }

    private function checkTipo(?string $tipo): bool
    {
        return strlen($tipo) === 1 && in_array($tipo, ['A', 'D', 'P', 'C', 'R', 'E'], true);
    }

    private function checkRol(?string $rol): bool
    {
        return strlen($rol) >= 1 && is_numeric($rol) && (int) $rol > 0;
    }

    private function checkEra(?string $era): bool
    {
        return strlen($era) === 4 && is_numeric($era) && (int) $era <= (int) date('Y') && (int) $era >= 1980;
    }
}
