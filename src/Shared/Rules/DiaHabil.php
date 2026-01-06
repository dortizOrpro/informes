<?php

namespace Src\Shared\Rules;

use Illuminate\Support\Carbon;
use Src\Support\Util;

class DiaHabil
{
    public function validate($attribute, $value, $parameters, $validator): bool
    {
        $result = Util::dia_inhabil($value);

        if (is_string($result)) {
            $fecha = Carbon::parse($value)->format('d-m-Y');
            $validator->setCustomMessages([
                $attribute => "La :attribute $fecha no es valida. Es $result.",
            ]);
        }

        return ! is_string($result);
    }
}
