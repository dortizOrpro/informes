<?php

namespace App\Livewire\Calculo;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Src\Caja\Application\UseCases\CargarAfiliadosPorDocumentoUseCase;
use Src\Caja\Application\UseCases\CargarDocumentosPorCobranzaUseCase;
use Src\Caja\Application\UseCases\GuardarPreingresoUseCase;
use Src\Calculo\Application\UseCases\CalcularTotalDeudaUseCase;
use Src\Calculo\Application\UseCases\EstadoIndicadoresUseCase;
use Src\Calculo\Domain\Enums\TipoCalculo;
use Src\Shared\UserInterface\Traits\Sweetalert;
use Src\Support\Util;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Mary\Traits\Toast;

class Parametros extends Component
{
    use Toast;
    use Sweetalert;
    public bool $bloqueado = false;

    public string $fechaPago;
    public string $fechaCalculo;

    public string $valor;

    public int $aux;

    public string $email;

    public float $uf = 0;

    public int $deudorId;

    public string $uuid = '';

    public $preingreso;

    public $totales = [];

    public float $totalPago = 0;

    public array $tribunales = [];

    public array $cobranzas = [];

    public array $factores = [];
    public array $empleador = [];

    public array $params = [];
    public array $afiliados = [];
    /**
     * Parametros de búsqueda
     */
    public string $rutEmpleador = '';
    public string $rutAfiliado = '';
    public string $ritCausa = '';
    public int $tribunalId;
    public string $cobranzaId = '8017856';
    public int $tick = 0;
    public bool $pagar = false;

    public $modalPreIngreso = false;
    public $nota = false;
    public $mostrarCopia = false;
    public int $hasTabla = 1;

    public bool $isSoloCalculo = false;

    public $emailPreingreso, $asunto, $para, $copia_nombre, $copia_email, $nota_texto, $motivo = '';

    public array $tiposCalculos = [
        ['id' => TipoCalculo::nulo, 'name' => 'Seleccionar tipo calculo...'],
        ['id' => TipoCalculo::RutDeudor, 'name' => 'R.U.T. Deudor'],
        ['id' => TipoCalculo::RutAfiliado, 'name' => 'R.U.T. Afiliado'],
        ['id' => TipoCalculo::RitCausa, 'name' => 'R.I.T. Causa'],
        //['id' => TipoCalculo::Preingreso, 'name' => 'Preingreso'],
        ['id' => TipoCalculo::Cobranza, 'name' => 'Cobranza'],
    ];

    public array $calculos = [];

    public TipoCalculo $tipoCalculo;

    public string $tipoCalculoLabel = '';

    public function mount(EstadoIndicadoresUseCase $uc): void
    {

        $this->fechaPago = date('Y-m-d');
        $this->fechaCalculo = $this->diaSiguiente($this->fechaPago);
        $estadoIndicador = $uc->run($this->fechaCalculo);
        //dd($estadoIndicador);
        $this->uf = $estadoIndicador->uf;
        $this->tribunales = Util::gui('tribunal');
        $this->tipoCalculo = TipoCalculo::nulo;
        $this->resetCalculos();
    }

    private function resetCalculos(): void
    {
        $this->calculos = [
            'capital' => 0,
            'reajuste' => 0,
            'intereses' => 0,
            'recargo' => 0,
            'honorarios' => 0,
            'gastos' => 0,
        ];
        $this->resetValidation();
        $this->totalPago = 0;
        $this->params = [];
        $this->afiliados = [];
        $this->bloqueado = false;
        $this->fechaPago = date('Y-m-d');
        $this->fechaCalculo = $this->diaSiguiente($this->fechaPago);
        Session::put('factores', []);
    }

    public function updatedFechaPago(string $fecha, EstadoIndicadoresUseCase $uc, CalcularTotalDeudaUseCase $useCase): void
    {
        $estadoIndicadores = $uc->run($fecha);
        $this->bloqueado = true;
        $this->fechaCalculo = $this->diaSiguiente($this->fechaPago);
        $this->uf = $estadoIndicadores->uf; // $uc->run($this->fechaCalculo);
        $this->hasTabla = $estadoIndicadores->hasTablaSp ? 1 : 0;
//        if($this->uf <= 0) {
//            $this->bloqueado = true;
//            $this->addError('uf','No hay U.F. para la fecha seleccionada');
//        }
        $this->validate(
            [
                'fechaPago' => 'required|date|dia_habil',
                'uf' => 'required|gt:0',
                'hasTabla' => 'required|gt:0',
            ],
            [
                'uf'=>'No hay U.F. para la fecha seleccionada',
                'hasTabla'=>'No hay tabla para la fecha seleccionada',
            ]
        );


        $calculo = $useCase->run($this->factores, $this->fechaCalculo);
        $this->isSoloCalculo = Carbon::parse($this->fechaCalculo)->lt(Carbon::now());
        Log::info("Validacion", [$this->isSoloCalculo]);
        $this->calculos = $calculo->calculos;
        $this->totalPago = $calculo->totalPago;
        $this->bloqueado = $this->isSoloCalculo;
        Log::info("Validacion2", [$this->bloqueado]);
        Session::put('factores', $this->factores);
    }

    private function diaSiguiente(string $fecha): string
    {
        $fechaIni = $fecha;
        do {
            $fechaIni = Carbon::parse($fechaIni)->add('1 day')->format('Y-m-d');
        } while(
            Util::dia_inhabil($fechaIni)
        );
        //$fechaIni = Carbon::parse($fecha)->add('1 day')->format('Y-m-d');

        return $fechaIni;
    }
    public function updatedTipoCalculo(TipoCalculo $valor): void
    {
        $this->tipoCalculoLabel = collect($this->tiposCalculos)->firstWhere('id', $valor)['name'];
        $this->rutEmpleador = '';
        $this->rutAfiliado = '';
        $this->ritCausa = '';
        $this->tribunalId = 0;
        $this->cobranzaId = '';
        $this->cobranzas = [];
        $this->afiliados = [];
        $this->resetCalculos();
    }

    public function buscar(): void
    {
        $this->resetValidation();
        $this->factores = [];
        $reglas = [
            'tipoCalculo' => Rule::enum(TipoCalculo::class)->except(TipoCalculo::nulo),
            'rutEmpleador' => [
                Rule::excludeIf($this->tipoCalculo !== TipoCalculo::RutDeudor && $this->tipoCalculo !== TipoCalculo::RutAfiliado),
                Rule::requiredIf($this->tipoCalculo === TipoCalculo::RutDeudor),
                'rut'
            ],
            'rutAfiliado' => [
                Rule::excludeIf($this->tipoCalculo !== TipoCalculo::RutAfiliado),
                Rule::requiredIf($this->tipoCalculo === TipoCalculo::RutAfiliado),
                'rut'
            ],
            'ritCausa' => [
                Rule::excludeIf($this->tipoCalculo !== TipoCalculo::RitCausa),
                Rule::requiredIf($this->tipoCalculo === TipoCalculo::RitCausa),
                'rit'
            ],
            'tribunalId' => [
                Rule::excludeIf($this->tipoCalculo !== TipoCalculo::RitCausa),
                Rule::requiredIf($this->tipoCalculo === TipoCalculo::RitCausa),
                'gt:0'
            ],
            'cobranzaId' => [
                Rule::excludeIf($this->tipoCalculo !== TipoCalculo::Cobranza),
                Rule::requiredIf($this->tipoCalculo === TipoCalculo::Cobranza),
                'int',
                'gt:0'
            ],
        ];
        $busqueda = $this->validate($reglas);
        $this->params = $busqueda;
        Log::info("Validacion", $busqueda);
        match ($this->tipoCalculo) {
            TipoCalculo::RutAfiliado => $this->addAfiliado((int) $busqueda['rutAfiliado']),
            default => fn() => $this->afiliados = []
        };

        //$this->dispatch('caja.actualizarListado', $busqueda);
    }

    public function addAfiliado(int $rutAfiliado): void
    {
        $this->afiliados[] = $rutAfiliado;
        $this->tick = time();
    }

    /***
     * TODO: solo un metodo agregar documentos... el evento que llama llena el array de deudas a sumar
     * y vuelve via "origen"
     */
    #[On('parametros.agregarAfiliado')]
    public function agregarAfiliado(array $afiliado, CalcularTotalDeudaUseCase $useCase): void
    {
        Log::debug('agregarAfiliado', $afiliado);
        $origen = $afiliado['origen'];
        $this->agregar([$afiliado], $useCase);
        $this->dispatch("actualizar.$origen." . $afiliado['documento_id']);
    }

    #[On('parametros.agregarDeudas')]
    public function agregar(
        array $deudas,
        CalcularTotalDeudaUseCase $useCase
    ): void
    {
        Log::debug('parametros.agregarDeudas', $deudas);
        foreach ($deudas as $deuda) {
            $id = $deuda['id'];
            $marcar = $deuda['marcarTodo'] ?? null;
            match ($marcar) {
                true => $this->agregarFactor($id, $deuda),
                false => $this->quitarFactor($id, $deuda),
                default => $this->flipFactor($id, $deuda),
            };
        }

        $calculo = $useCase->run($this->factores, $this->fechaCalculo);
        $this->calculos = $calculo->calculos;
        $this->totalPago = $calculo->totalPago;
        Log::debug('parametros.agregarDeudas.factores', (array)$calculo);
        Session::put('factores', $this->factores);
    }

    #[On('parametros.agregarCobranza')]
    public function agregarCobranza(
        array $parametros, CargarDocumentosPorCobranzaUseCase $cargaCobranza,
        CargarAfiliadosPorDocumentoUseCase $cargaAfiliados,
        CalcularTotalDeudaUseCase $calcularTotalDeuda,
    ): void
    {
        $cobranzaId = $parametros['cobranza_id'];
        $marcarTodo = $parametros['marcarTodo'] ?? null;
        $documentos = $cargaCobranza->run($cobranzaId);
        array_map(
            fn ($documento) => $this->agregarDocumento(["documento" => (array) $documento,"marcarTodo"=>$marcarTodo], $cargaAfiliados, $calcularTotalDeuda),
            $documentos
        );
        Log::info('Agregar cobranza', $documentos);
    }

    #[On('parametros.agregarDocumento')]
    ////////////////CAMBIE LA FUNCION agregarDocumento PARA QUE NO CONSIDERE LOS AFILIADOS SIN APERTURACION(ES UN DDH momentaneo)
    public function agregarDocumento(
        array $parametros,
        CargarAfiliadosPorDocumentoUseCase $uc,
        CalcularTotalDeudaUseCase $useCase
    ): void {
        $documento = (object) $parametros['documento'];
        $marcarTodo = $parametros['marcarTodo'];
        $sinMdf = false;

        $afiliados = $uc->run(
            $documento->remesa_id,
            $documento->documento,
            $documento->periodo,
            $documento->numero_interno
        );

        $afiliadosConAperturacion = array_filter($afiliados, function ($afiliado) {
            $aperturacion = json_decode($afiliado->aperturacion ?? '[]', true);
            return is_array($aperturacion) && count($aperturacion) > 0 && (($afiliado->estado_id ?? 0) === 100);
        });

        $afiliadosSinAperturacion = array_filter($afiliados, function ($afiliado) {
            $aperturacion = json_decode($afiliado->aperturacion ?? '[]', true);
            return empty($aperturacion) || !is_array($aperturacion);
        });

        if (count($afiliadosSinAperturacion) > 0) {
            $sinMdf = true;
        }

        $carga = array_map(function ($afiliado) use ($documento, $marcarTodo) {
            return [
                'id' => $afiliado->id,
                'cobranza_id' => $documento->cobranza_id,
                'monto' => $afiliado->monto,
                'periodo' => $afiliado->periodo,
                'sp_id' => $afiliado->sp_id,
                'producto_uid' => $afiliado->producto_uid,
                'documento_id' => $documento->id,
                'marcarTodo' => $marcarTodo,
                'origen' => 'documento-documento',
                'estado_id' => $afiliado->estado_id,
                'aperturacion' => json_decode($afiliado->aperturacion, true),
            ];
        }, $afiliadosConAperturacion);

        if($sinMdf == true)
        {
            $this->warning(
                position: 'toast-bottom toast-start',
                title: 'Afiliados sin distribución de fondos',
                timeout: 8000,
                description: 'Existen afiliados sin distribución de fondos. Revise la selección antes de continuar.',
            );
        }

        $this->agregar($carga, $useCase);
        $this->dispatch('caja.actualizar-documento.' . $documento->id);
    }
    ////////////////CAMBIE LA FUNCION agregarDocumento PARA QUE NO CONSIDERE LOS AFILIADOS SIN APERTURACION(ES UN DDH momentaneo)
    // public function agregarDocumento(array $parametros, CargarAfiliadosPorDocumentoUseCase $uc, CalcularTotalDeudaUseCase $useCase): void
    // {
    //     $documento = $parametros['documento'];
    //     $marcarTodo = $parametros['marcarTodo'];
    //     Log::info('agregar', $documento);
    //     $documento = (object) $documento;
    //     $afiliados = $uc->run($documento->remesa_id, $documento->documento, $documento->periodo, $documento->numero_interno);
    //     $carga = array_map(
    //         function ($afiliado) use ($documento, $marcarTodo) {
    //             return [
    //                 'id' => $afiliado->id,
    //                 'cobranza_id' => $documento->cobranza_id,
    //                 'monto' => $afiliado->monto,
    //                 'periodo' => $afiliado->periodo,
    //                 'sp_id' => $afiliado->sp_id,
    //                 'producto_uid' => $afiliado->producto_uid,
    //                 'documento_id' => $documento->id,
    //                 'marcarTodo' => $marcarTodo,
    //                 'origen' => 'documento-documento',
    //                 'aperturacion' => json_decode($afiliado->aperturacion, true),
    //             ];
    //         },
    //         $afiliados
    //     );
    //     $this->agregar($carga, $useCase);
    //     $this->dispatch('caja.actualizar-documento.'.$documento->id);
    // }


    public function reiniciar(): void
    {
        $this->tipoCalculo = TipoCalculo::nulo;
        $this->updatedTipoCalculo(TipoCalculo::nulo);
        //$this->success('Reiniciando calculo','Todo reiniciado');
        //$this->sweetalert('Reiniciar', 'Calculo reiniciado','warning');
        $this->sweetalert('success', ['title' => 'Realizado', 'text'=> 'Pago registrado correctamente.']);
    }

    public function guardar(GuardarPreingresoUseCase $useCase): void
    {
        $this->preingreso = $useCase->run(
            tipoCalculo: $this->tipoCalculo,
            params: $this->params,
            vencimiento: $this->fechaPago,
            fechaCalculo: $this->fechaCalculo,
            usuarioId: 9999,
            deudas: $this->factores,
        );
        Cache::put($this->preingreso, $this->factores);
        $this->pagar = true;
    }

    public function abrirModalPreingreso()
    {
        if($this->totalPago == 0)
        {
            $this->addError('pre_ingreso', 'Ningún afiliado seleccionado para generar preingreso.');
            return;
        }

        $this->dispatch('abrirModal', [
            'tipoCalculo' => $this->tipoCalculo,
            'params'      => $this->params,
            'vencimiento' => $this->fechaPago,
            'fechaCalculo' => $this->fechaCalculo,
            'usuarioId'   => 9999,
            'deudas'      => $this->factores,
            'calulo'      => $this->calculos,
            'a_pago'      => $this->totalPago
        ]);
    }

    public function render()
    {
        return view('livewire.calculo.parametros');
    }

    private function agregarFactor(mixed $id, mixed $deuda): void
    {
        $this->factores[$id] = $deuda;
    }

    private function quitarFactor(mixed $id, mixed $deuda): void
    {
        unset($this->factores[$id]);
    }

    private function flipFactor(mixed $id, mixed $deuda): void
    {
        $ids = array_keys($this->factores);
        match (in_array($id, $ids)) {
            true => $this->quitarFactor($id, $deuda),
            false => $this->agregarFactor($id, $deuda),
        };
    }
    #[On('parametros.pago-cerrar')]
    public function pagoCerrar($status): void {
        $this->pagar = false;
        match ($status) {
            200 => $this->sweetalert('success', ['title' => 'Realizado', 'text'=> 'Pago registrado correctamente.']),
            500 => $this->sweetalert('error', ['text'=>'Error al registrar el pago.','title'=>'Error']),
            default => $this->warning('warning', 'Pago no registrado.'),
        };
        $this->redirect('/pagos');
    }

    #[On('preingreso.preingreso-cerrar')]
    public function preingresoCerrar(): void {
        $this->resetCalculos();
        $this->reiniciar();
    }


}
