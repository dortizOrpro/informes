<?php

namespace Src\Support;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
// use Src\Cobranzas\Domain\Contracts\CobranzaRepositoryContract;
// use Src\Gui\Domain\Contracts\GuiRepositoryContract;
use Src\Gui\Infrastructure\Repositories\GuiRepository;

readonly class Util
{
    public static function gui(string $grupo): array
    {
        $repository = new GuiRepository;

        return $repository->list($grupo);
    }

    public static function dia_inhabil(string $fecha): string|bool
    {
        $dia = Carbon::create($fecha);

        return match ($dia->isWeekend()) {
            true => 'dia '.$dia->dayName,
            false => self::esFeriado($fecha),
        };
    }

    private static function esFeriado(string $fecha)
    {
        $feriado = DB::table('gui.feriado')->where(['fecha' => $fecha])->first();

        return isset($feriado) ? 'feriado '.trim($feriado->descripcion) : false;
    }
}
