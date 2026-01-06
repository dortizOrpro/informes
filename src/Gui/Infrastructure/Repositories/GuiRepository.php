<?php

namespace Src\Gui\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Src\Gui\Domain\Contracts\GuiRepositoryContract;

class GuiRepository implements GuiRepositoryContract
{
    public function list(string $grupo): array
    {
        $builder = match ($grupo) {
            'comuna' => DB::table('gui.cut_comuna')->select('id', 'comuna as name')->get(),
            'agencia' => DB::table('gui.agencia')->select('id', 'agencia as name')->get(),
            'empresa' => DB::table('gui.empresa')
                ->select('spensiones_empresa_id as id', 'alias as name')
                ->where('spensiones_empresa_id','>',0)
                ->distinct()
                ->get(),
            'tribunal' => DB::table('gui.tribunal')
                ->where('id', '>', 0)
                ->select('id', 'tribunal as name')
                ->get(),
        };

        return $builder->toArray();
    }
}
