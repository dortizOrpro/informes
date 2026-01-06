<nav class="flex justify-between bg-base-200 border-base-300 border-y">
    <div class="px-4 border-e border-base-300 flex-1">
        <label class="label text-sm">
            {{ ($paginator->currentPage() - 1)* $paginator->perPage()  + 1  }}
            - {{  ($paginator->currentPage() - 1)* $paginator->perPage()  + $paginator->count()  }}
            de {{ $paginator->total()  }} registros
        </label>
    </div>

    <div class="px-4 flex border-e border-base-300">
        <label class="label text-sm">página</label>
        <div class="dropdown dropdown-top">
            <label tabindex="0" role="button" class="label text-sm">{{ $paginator->currentPage()}}
                <x-mary-icon name="carbon.caret-down" class="ps-1"/>
            </label>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 z-[1] w-24 p-1 border border-base-300">

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true" class="border-b-2 border-base-300 border-dotted">

                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <li @if((int)$page === $paginator->currentPage())class="bg-base-200"@endif>
                                <button wire:click="gotoPage({{ $page }}, 'page')" class="text-sm">{{ $page }}</button>
                            </li>
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </div>
        <label class="label text-sm">
            de <span class="ms-2 text-sm">{{ $paginator->lastPage() }}</span>
        </label>
    </div>
    <div class="gap-0 grid grid-cols-2">
        @if($paginator->onFirstPage())
            <span class="btn btn-ghost btn-sm h-full btn-disabled">
                <x-mary-icon name="carbon.caret-left"/>
            </span>
        @else
            <button class="btn btn-ghost btn-sm h-full" wire:click="previousPage('page')">
                <x-mary-icon name="carbon.caret-left"/>
            </button>
        @endif

        @if(!$paginator->hasMorePages())
            <span class="btn btn-ghost btn-sm h-full btn-disabled">
                <x-mary-icon name="carbon.caret-right"/>
            </span>
        @else
            <button class="btn btn-ghost btn-sm h-full" wire:click="nextPage('page')" >
                <x-mary-icon name="carbon.caret-right"/>
            </button>
        @endif

    </div>
</nav>

