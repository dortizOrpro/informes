<a
    href="{{ route($action['route']) }}"
    class="block text-decoration-none text-reset"
>
    <div class="card mb-2 hover:bg-base-200 transition">
        <div class="flex items-center gap-4 p-3">

            <div class="flex-shrink-0">
                <x-icon name="{{ $action['icon'] }}" class="w-8 h-8" />
            </div>

            <div class="flex flex-col">
                <h6 class="font-semibold mb-1">
                    {{ $action['title'] }}
                </h6>
                <p class="text-sm text-gray-500">
                    {{ $action['description'] }}
                </p>
            </div>

        </div>
    </div>
</a>