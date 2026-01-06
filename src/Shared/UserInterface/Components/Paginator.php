<?php

namespace Src\Shared\UserInterface\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class Paginator extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public LengthAwarePaginator $records)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $page_total = $this->records->lastPage();
        $page_last = min($page_total, max(5, $this->records->currentPage() + 2));
        $page_first = min($page_total - 4, max(1, $this->records->currentPage() - 2));
        $page_crt = $this->records->currentPage();

        return view(
            view: 'cds::paginator',
            data: [
                'current_page' => $page_crt,
                'page_first' => (int) max(2, $page_first),
                'last' => (int) min($page_last, $page_total),
                'page_total' => (int) $this->records->lastPage(),
                'per_page' => $this->records->perPage(),
                'records' => $this->records,
            ]);
    }
}
