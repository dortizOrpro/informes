<div class="collapse bg-base-200" x-data="{ opened: {{ $opened ? 'true' : 'false' }} }">
    <input type="checkbox" {{ $opened ? 'checked': ''}} "/>
    <div class="collapse-title font-medium text-lg bg-base-300 py-2 border-b-1 border-base-200">
        @if(!is_null($section->icon))
            <x-mary-icon :name="$section->icon" :label="$section->description"/>
        @else
            <span class="inline-flex items-center gap-1 w-5"></span>
            <label>{{ $section->description }}</label>
        @endif
    </div>
    <div class="collapse-content">
        @foreach($entries as $entry)
            <div class="flex gap-4">
                <div class="flex-none w-1/4 text-end">{{ $entry->label }}</div>
                <div class="flex-none w-3/4">{{ $entry->value }}</div>
            </div>
        @endforeach

    </div>
</div>
