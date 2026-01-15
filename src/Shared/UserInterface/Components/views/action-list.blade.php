<div class="space-y-4">

    <!-- @if($title || $subtitle)
        <x-cds::header
            :title="$title"
            :subtitle="$subtitle"
            separator
        >
        </x-cds::header>
    @endif -->
    <div class="p-5">
        <div class="card bg-base-100 p-5 bg-base-200 m-5">
            @foreach($actions as $action)
                <div class="border-b border-base-300 last:border-b-0">
                    <x-cds::action-list-item :action="$action"/>
                </div>
            @endforeach
        </div>
    </div>

</div>
