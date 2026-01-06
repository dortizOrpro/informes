<li>
    <button class="my-0.5 py-1.5 px-4 hover:text-inherit whitespace-nowrap items-center justify-center"
       id="{{ $uuid }}"
       @if($target)
           target="{{$target}}"
       @endif
       @if($link)
           href="{{$link}}"
        @endif
        onclick="window.open('{{ $link }}','{{ $target }}')"
    >


        <span class="mary-hideable whitespace-nowrap truncate">
            <div class="text-center">
                <x-icon :name="$icon" class="h-12 w-12"/>
            </div>
            <label class=" text-base text-center">{{ $label }}</label>
        </span>
    </button>
</li>
