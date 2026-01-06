<nav class="flex justify-between bg-base-200 border-base-300 border-y">
    <!-- INICIO {{ $page_total }} -->
    <div class="px-4 border-e border-base-300 flex-1">
        <label class="label text-sm">
            {{ ($current_page- 1)* $per_page  + 1  }} - {{  ($current_page- 1)* $per_page  + $records->count()  }}
            de {{ $records->total()  }} registros
        </label>
    </div>

    <div class="px-4 flex border-e border-base-300">
{{--        <label class="label text-sm">página</label>--}}
        <div class="dropdown dropdown-top">
            <label tabindex="0" role="button" class="label text-sm ps-2">página {{ $current_page}}
                <x-mary-icon name="carbon.caret-down" class="ps-1"/>
            </label>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 z-[1] w-24 p-1 border border-base-300">
                @if($last < $page_total)
                    <li class="border-b-2 border-base-300 border-dotted">
                        <button wire:click="gotoPage({{ $page_total }}, 'page')" class="text-sm">{{ $page_total }}</button>
                    </li>
                @endif
                @foreach(range($last, $page_first) as $pagina)
                    <li @if((int)$pagina === $current_page)class="bg-base-200"@endif>
                        <button wire:click="gotoPage({{ $pagina }}, 'page')" class="text-sm">{{ $pagina }}</button>
                    </li>
                @endforeach
                    <li class="border-t-2 border-base-300 border-dotted">
                        <button wire:click="gotoPage({{ 1 }}, 'page')" class="text-sm">{{ 1 }}</button>
                    </li>
            </ul>
        </div>
        <label class="label text-sm">
            de <span class="ms-2 text-sm">{{ $page_total}}</span>
        </label>
    </div>

    <div class="gap-0 grid grid-cols-2">
        <button class="btn btn-ghost btn-sm h-full" @if($current_page > 1) wire:click="previousPage('page')" @else disabled @endif>
            <x-mary-icon name="carbon.caret-left"/>
        </button>
        <button class="btn btn-ghost btn-sm h-full" @if($current_page < $page_total) wire:click="nextPage('page')" @else disabled @endif>
            <x-mary-icon name="carbon.caret-right"/>
        </button>

    </div>
</nav>

