<?php

namespace Src\Caja\Application\UseCases;

use Src\Caja\Domain\Contracts\PreingresoRepositoryContract;
use Src\Calculo\Application\UseCases\ActualizarDeudaUseCase;
use Src\Calculo\Application\UseCases\CalcularHonorariosUseCase;
use Src\Calculo\Domain\Contracts\IndicadoresRepositoryContract;
use Src\Calculo\Domain\Enums\TipoCalculo;

readonly class GuardarPreingresoUseCase
{
    public function __construct(
        private PreingresoRepositoryContract $preingresoRepository,
        private IndicadoresRepositoryContract $indicadoresRepository,
        private ActualizarDeudaUseCase $actualizarDeuda,
        private CalcularHonorariosUseCase $calcularHonorarios,
    ) {}

    public function run(TipoCalculo $tipoCalculo, array $params, string $vencimiento, string $fechaCalculo, int $usuarioId, array $deudas): string
    {
        $uf = $this->indicadoresRepository->getUfByDay($fechaCalculo);
        $uuid = $this->preingresoRepository->guardar($tipoCalculo, $params, $vencimiento, $fechaCalculo, $usuarioId, $deudas);
        // $sumaCobranzas = [];
        foreach ($deudas as $deuda) {

            $raw = $deuda['aperturacion'];

            $decoded = is_array($raw)
                ? $raw
                : json_decode($raw, true);

            $aperturacion = (is_array($decoded) && !empty($decoded))
                ? $decoded
                : [[
                    'fondo_id' => 'C',
                    'porcentaje' => 100,
                    'tipo_aperturacion' => 'CCO',
                    'monto' => $deuda['monto'],
                ]];
                
            foreach ($aperturacion as $apertura) {
                $items = array_merge(
                    [
                        'deuda_id' => $deuda['id'],
                        'cobranza_id' => $deuda['cobranza_id'],
                        'fondo_id' => $apertura['fondo_id'],
                    ],
                    $this->actualizarDeuda->run(
                        fechaPago: $fechaCalculo,
                        uf: $uf,
                        periodo: $deuda['periodo'],
                        administradora: $deuda['sp_id'],
                        // fondo: $apertura['fondo_id'],
                        deudas: [
                            [
                                'fondo_id' => $apertura['fondo_id'],
                                'monto' => $apertura['monto']
                            ]
                        ]
                    )
                );
                // $calculoTotal = end($items);
                // $sumaCobranzas[$deuda['producto_uid']] = ($sumaCobranzas[$deuda['producto_uid']] ?? 0) + $calculoTotal['deuda'];

                // foreach ($sumaCobranzas as $productoUid => $sumaCobranza) {
                //     $honorario = $this->calcularHonorarios->run(
                //         producto: $productoUid,
                //         tramo: 'A',
                //         total: round($sumaCobranza),
                //         fechaPago: $fechaCalculo,
                //         uf: $uf,
                //     );
                // }

                $resultados = array_filter(
                    $items,
                    fn($r) => is_array($r) && $r['fondo'] !== 'Total'
                );


                foreach ($resultados as $resultado) {
                    $detalle = [
                        'deuda_id' => $deuda['id'],
                        'cobranza_id' => $deuda['cobranza_id'],
                        'fondo' => $resultado['fondo'],
                        'capital' => $resultado['capital'],
                        'reajuste' => $resultado['reajuste'],
                        'intereses' => $resultado['intereses'],
                        'recargo' => $resultado['recargo'],
                        'deuda_actualizada' => $resultado['deuda'],
                    ];

                    $this->preingresoRepository->guardarDetalle($uuid, [$detalle]);
                }

            }

        }
        return $uuid;
    }
}

//
//preingreso_id uuid,
//	deuda_id bigint,
//	capital numeric,
//	reajuste numeric,
//	interes numeric,
//	recargo numeric,
//	apago numeric
// int $deuda, string $fechaPago, float $uf, string $periodo, string $fondo, int $administradora
//"38057978": {
//    "id": 38057978,
//    "monto": 10964,
//    "sp_id": 1032,
//    "periodo": "2018-09-01",
//    "marcarTodo": true,
//    "cobranza_id": 8017856,
//    "documento_id": "1032/000000001115736/000000000000029881/2018-09-01",
//    "producto_uid": "657"
//  },
