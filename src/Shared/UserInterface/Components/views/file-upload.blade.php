<div class="max-w-96">
    @if($title !== '')
        <p class="text-sm font-semibold mb-2">{{ $title }}</p>
    @endif

        @if($description !== '')
            <p class="text-sm font-normal mb-4"> {{$description}} </p>
        @endif

    <label for="upfile" class="btn btn-sm btn-primary mb-4">Agregar
        <input type="file" wire:model="archivo" style="display: none" id="upfile">
    </label>
    <ul>

        <li wire:loading wire:target="archivo" class="px-4 py-2 mb-2 text-sm bg-base-200 flex justify-between w-full">
            <span class="truncate">Cargando...</span>
            <span class="btn btn-xs btn-ghost float-end">
                <span class="loading loading-spinner loading-xs"></span>
            </span>
        </li>
        @foreach($archivos as $key => $archi)
            <li class="px-4 py-2 mb-2 text-sm bg-base-200 flex justify-between" title="{{ $archi['filename'] }}" wire:key="{{ $key }}">
                <span class="truncate">
                    <x-icon name="filetype.s-{{ File::extension($archi['filename']) }}"/>
                    {{ $archi['filename']}}
                </span>
                <button class="btn btn-xs btn-ghost" wire:click="delete({{$key}})">x</button>
            </li>
        @endforeach
    </ul>
</div>

