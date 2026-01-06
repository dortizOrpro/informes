<?php

namespace Src\Shared\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Log;
use Illuminate\Translation\PotentiallyTranslatedString;

class Rut // implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    //    public function validate(string $attribute, mixed $value, Closure $fail): void
    //    {
    //        if (! $this->checkRut($value)) {
    //            $fail('El :attribute no es valido.');
    //        }
    //    }

    public function validate($attribute, $value, $parameters, $validator): bool
    {
        $check = $this->checkRut($value);
        if (! $check) {
            $validator->setCustomMessages([
                $attribute => 'El :attribute no es valido.',
            ]);
        }

        return $check;
    }

    public static function rutToint(string $value): int
    {
        $arrRut = explode('-', str_replace('.', '', $value));

        return (int) $arrRut[0];
    }

    private function checkRut(string $value): bool
    {
        $arrRut = explode('-', str_replace('.', '', $value));

        return (count($arrRut) === 2)
            && is_numeric($arrRut[0])
            && (self::dv((int) $arrRut[0]) === $arrRut[1]);
    }

    public static function rule(): Rut
    {
        return new self;
    }

    public static function format(int $value): string
    {
        return vsprintf('%s-%s', [
            number_format($value, 0, ',', '.'),
            self::dv($value),
        ]);
    }

    public static function dv(int $intRut): string
    {
        $intMlt = 0;
        $intSum = 0;
        $intNum = $intRut;
        while ($intNum > 0) {
            $intSum += ($intNum % 10) * (2 + ($intMlt % 6));
            $intNum = floor($intNum / 10);
            $intMlt++;
        }
        $intDigit = 11 - ($intSum % 11);

        return match ($intDigit) {
            11 => 0,
            10 => 'K',
            default => $intDigit
        };
    }
}
