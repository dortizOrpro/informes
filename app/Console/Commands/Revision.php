<?php

namespace App\Console\Commands;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Console\Command;
use Src\Caja\Application\UseCases\GenerarComprobateUseCase;
use Src\Caja\Application\UseCases\ListarAfiliadosPorRutUseCase;
use Src\Caja\Application\UseCases\ListarComprobantesUseCase;
use Src\Caja\Application\UseCases\ListarDeudaPorAfiliadoUseCase;
use Src\Caja\Infrastructure\Repositories\CobranzasRepository;
use Src\Calculo\Application\UseCases\EstadoIndicadoresUseCase;
use Src\Calculo\Application\UseCases\ObtenerGastosCobranzaUseCase;
use Src\Calculo\Infrastructure\Repositories\IndicadoresRepository;

class Revision extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:revision';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(EstadoIndicadoresUseCase $uc)
    {
        $v = $uc->run('2025-10-10');
        dd($v);

//        $pdf = PDF::loadView('caja::comprobante.index');
//        $pdf->setPaper('Letter', 'portrait');
//        $pdf->save(storage_path('comprobante.pdf'));
    }
}
