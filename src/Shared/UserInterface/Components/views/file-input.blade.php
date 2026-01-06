<div
    x-data="{
                        progress: 0,
                        file: @entangle($attributes->wire('model')),
                        get processing () {
                            return this.progress > 0 && this.progress < 100
                        },
                        refreshImage() {
                            this.progress = 1
                        },
                     }"

    x-on:livewire-upload-progress="progress = $event.detail.progress;"

    {{ $attributes->whereStartsWith('class') }}
>
    <!-- STANDARD LABEL -->
    @if($title)
        <label for="{{ $uuid }}" class="ps-0 pt-0 mb-0 label label-text !pb-1 font-semibold">
                            <span>
                                {{ $title }}
                                @if($attributes->get('required'))
                                    <span class="text-error">*</span>
                                @endif
                            </span>
        </label>
    @endif
    @if($description)
        <div class="text-sm font-normal pb-4">{{ $description }}</div>
    @endif
    <!-- PROGRESS BAR  -->
    @if(! $hideProgress && $slot->isEmpty())
        <div class="h-1 -mt-6 mb-5">
            <progress
                x-cloak
                :class="!processing && 'hidden'"
                :value="progress"
                max="100"
                class="progress progress-primary h-1 w-100"></progress>
        </div>
    @endif

    <!-- FILE INPUT -->
    <div class="indicator">
        <span x-show="progress > 0 && processing" class="indicator-item badge badge-neutral" x-text="progress + '%'" >99+</span>
    <label class="cds-file-label" for="{{ $uuid }}">Agregar</label>
    </div>
    <input class="cds-file"
           id="{{ $uuid }}"
           type="file"
           x-ref="file"
           @change="refreshImage()"

        {{
            $attributes->whereDoesntStartWith('class')->class([
                "file-input file-input-bordered file-input-primary",
                "hidden" => $slot->isNotEmpty()
            ])
        }}
    />


</div>
