<?php

namespace App\Livewire\Calculo;

use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Src\Caja\Application\UseCases\CargarCobranzasPorCriterioUseCase;
use Src\Calculo\Domain\Enums\TipoCalculo;
use Src\Gui\Infrastructure\Repositories\GuiRepository;
use Src\Shared\UserInterface\Components\Filter;

class DetalleCobranzas extends Component
{
    public array $cobranzas = [];

    #[Reactive]
    public TipoCalculo $tipoCalculo = TipoCalculo::nulo;

    public array $params = [];
    public array $filters = [];

    //#[On('caja.actualizarListado')]
    public function actualizar($params, CargarCobranzasPorCriterioUseCase $uc): void
    {
        Log::info("Actualizando listado de cobranzas", $params);
        $this->tipoCalculo = TipoCalculo::from($params['tipoCalculo']);
        $this->cobranzas =$uc->run(TipoCalculo::from($params['tipoCalculo']), $params);
    }

//    #[On('caja.resetListado')]
//    public function resetListado(): void
//    {
//        $this->cobranzas = [];
//        //$this->tipoCalculo = TipoCalculo::nulo;
//    }

    private function defineFilters()
    {
        $cliente = (new GuiRepository())->list('empresa');
        return [
            [
                    'name'=> 'categoria_id',
                    'type'=> 'multicheck',
                    'label'=> 'Tipo de cliente',
                    'options'=> [
                        ['id' => 'DNPA', 'name' => 'DNPA'],
                        ['id' => 'DNP', 'name' => 'DNP'],
                    ]
                ],
            [
                'name'=> 'cliente_id',
                'type'=> 'multicheck',
                'label'=> 'Cliente',
                'options'=> $cliente
            ],
         ];
    }

    public function mount() {
        $this->filters = $this->defineFilters();
    }
    #[On('side-filter.filtro_calculo')]
    public function onFilter($filter) {
        Log::info("Actualizando listado de cobranzas", $filter);
        $this->params['filters'] = $filter;
    }
    public function render(CargarCobranzasPorCriterioUseCase $uc): View
    {
        $this->cobranzas =$uc->run($this->tipoCalculo, $this->params);
        return view('livewire.calculo.detalle-cobranzas');
    }
}
