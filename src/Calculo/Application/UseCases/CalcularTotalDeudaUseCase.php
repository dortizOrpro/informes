<?php

namespace Src\Calculo\Application\UseCases;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Src\Calculo\Domain\Contracts\IndicadoresRepositoryContract;

readonly class CalcularTotalDeudaUseCase
{
    public function __construct(
        private ActualizarDeudaUseCase $actualizarDeuda,
        private CalcularHonorariosUseCase $calcularHonorarios,
        private ObtenerGastosCobranzaUseCase $obtenerGastosCobranza,
        private IndicadoresRepositoryContract $indicadoresRepository,
    ) {
        //
    }

    public function run(array $valores, string $fechaPago): object
    {
        // dd($valores, $fechaPago);
        $totalPago = 0;
        $honorarios = 0;
        $procuraduria = 0;
        $calculos = [
            'capital' => 0,
            'reajuste' => 0,
            'intereses' => 0,
            'recargo' => 0,
            'honorarios' => 0,
            'gastos' => 0,
        ];
        $cobranzas = array_unique(array_column($valores, 'cobranza_id'));
        $sumaCobranzas = [];
        $uf = $this->indicadoresRepository->getUfByDay($fechaPago);

        foreach ($valores as $factor) {
            // Descomponer deuda aperturada y calculary
            // Si no hay aperturacion calcular todo con Fondo C

            // $aperturacion = is_array($factor['aperturacion'])  && (count($factor['aperturacion']) > 0)? $factor['aperturacion'] : [
            //     [
            //         'fondo_id' => 'C',
            //         'porcentaje' => 100,
            //         'tipo_aperturacion' => 'CCO',
            //         'monto' => $factor['monto'],
            //     ]
            // ];
            $factor['aperturacion'] = is_string($factor['aperturacion'])
            ? (json_decode($factor['aperturacion'], true) ?: [])
            : (is_array($factor['aperturacion']) ? $factor['aperturacion']: []);

            if (empty($factor['aperturacion']) || !is_array($factor['aperturacion']) || count($factor['aperturacion']) === 0 || $factor['estado_id'] !== 100) {

                continue;
            }
            $aperturacion = $factor['aperturacion'];

            Log::debug('calcularTotalDeuda:', $aperturacion);

            $calculo_general = $this->actualizarDeuda->run($fechaPago, $uf, $factor['periodo'], $factor['sp_id'], $aperturacion);
            $calculoTotal = end($calculo_general);
//            $totalPago =  $calculos['deuda'];
            $calculos = [
                'capital' => $calculos['capital'] + (float) $calculoTotal['capital'],
                'reajuste' => $calculos['reajuste'] + (float) $calculoTotal['reajuste'],
                'intereses' => $calculos['intereses'] + $calculoTotal['intereses'],
                'recargo' => $calculos['recargo'] + $calculoTotal['recargo'],
            ];
            $totalPago = $totalPago + $calculoTotal['deuda'];
            $sumaCobranzas[$factor['producto_uid']] = ($sumaCobranzas[$factor['producto_uid']] ?? 0) + $calculoTotal['deuda'];

            //dd($calculos);
//            foreach ($calculoTotal as $calculo) {
//                //$calculo = $this->actualizarDeuda->run($deuda['monto'], $fechaPago, $uf, $factor['periodo'], $deuda['fondo_id'], $factor['sp_id']);
//                //(string $fechaPago, float $uf, string $periodo, int $administradora, array $deudas)
//
//                $calculos = [
//                    'capital' => $calculos['capital'] + (float) $calculo['capital'],
//                    'reajuste' => $calculos['capital'] + (float) $calculo['reajuste'],
//                    'intereses' => $calculos['intereses'] + $calculo['intereses'],
//                    'recargo' => $calculos['recargo'] + $calculo['recargo'],
//                ];
//                $totalPago = $totalPago + $calculo['deuda'];
//            }
// TODO: Calcular los honorarios con la suma del total x cobranza fuera del loop por valores
//            $honorarios = $this->calcularHonorarios->run(
//                producto: $factor['producto_uid'],
//                tramo: 'A',
//                total: round($calculo['deuda_actualizada']),
//                fechaPago: $fechaPago,
//                uf: $uf,
//            );

        } // endforeach

        foreach ($sumaCobranzas as $productoUid => $sumaCobranza) {
            $honorario = $this->calcularHonorarios->run(
                producto: $productoUid,
                tramo: 'A',
                total: round($sumaCobranza),
                fechaPago: $fechaPago,
                uf: $uf,
            );
            $honorarios += $honorario->honorarios;
            $procuraduria += $honorario->procuraduria;

        }

        $calculos['subtotal'] = $totalPago;
        $calculos['gastos'] = $totalPago === 0 ? 0 : array_reduce(
            $cobranzas,
            fn ($carry, $cobranza) => $carry + $this->obtenerGastosCobranza->run($cobranza),
            0
        );
        $calculos['honorarios'] = $honorarios;
        $calculos['procuraduria'] = $procuraduria; //$honorarios;
        $calculos['iva'] = round((($honorarios + $procuraduria) * 0.19),0);

        //dd($calculos);
        return (object) [
            'calculos' => $calculos,
            'totalPago' => $totalPago + $calculos['gastos'] + $calculos['honorarios'] + $calculos['iva'],
        ];
    }
}
