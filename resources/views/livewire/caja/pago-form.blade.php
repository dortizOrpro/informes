<div>
    <x-cds::modal
        title="Ingresar pago"
        subtitle="Preingreso n° {{ $preingreso }}"
        box-class="bg-base-300 max-w-3/5 top-[2rem] absolute"
        wire:model="state"
        click-exit="$wire.cancel()"
        persistent="true"
    >
        <div style="max-height: calc(100vh - 16rem)" class="pb-16 px-2 overflow-y-scroll">
            <h1 class="text-sm font-bold">Datos del pagador</h1>
            <div class="grid grid-cols-7 gap-2 mb-4">
                <div>
                    <x-mary-input
                        class="text-end"
                        label="R.U.T."
                        type="text"
                        wire:model="rut"
                        :disabled="$errors->has('actividad_permitida')"
                    />
                </div>
                <div class="col-span-2">
                    <x-mary-input
                        class=""
                        label="Nombres"
                        type="text"
                        wire:model="nombres"
                        :disabled="$errors->has('actividad_permitida')"
                    />
                </div>
                <div class="col-span-2">
                    <x-mary-input
                        class=""
                        label="Apellido Paterno"
                        type="text"
                        wire:model="apPaterno"
                        :disabled="$errors->has('actividad_permitida')"
                    />
                </div>
                <div class="col-span-2">
                    <x-mary-input
                        class=""
                        label="Apellido Materno"
                        type="text"
                        wire:model="apMaterno"
                        :disabled="$errors->has('actividad_permitida')"
                    />
                </div>
            </div>


            <h1 class="text-sm font-bold">Datos de contacto</h1>
            <div class="grid grid-cols-7 gap-2 mb-4">
                <div>
                    <x-mary-input
                        class="text-end"
                        label="Telefono"
                        type="text"
                        wire:model="telefono"
                        :disabled="$errors->has('actividad_permitida')"
                    />
                </div>
                <div class="col-span-2">
                    <x-mary-input
                        class=""
                        label="Correo electrónico"
                        type="text"
                        wire:model="email"
                        :disabled="$errors->has('actividad_permitida')"
                    />
                </div>
            </div>

            <h1 class="text-sm font-bold mb-4">Registro del pago</h1>
            <div class="grid grid-cols-6 gap-2 mb-4">

                <div class="col-span-2">
                    <h1 class="mb-2 font-bold">Resumen de la deuda</h1>
                    <div class="p-0">
                        @foreach($calculos as $calculo => $valor)
                            <div class="flex justify-between px-4 py-1">
                                <span class="text-start capitalize">{{ $calculo }}</span>
                                <span class="flex justify-between">
                                    $ {{ Number::format($valor, precision: 0, locale:'de')}}
                                </span>
                            </div>
                        @endforeach
                        <hr class="mx-3">
                        <div class="flex justify-between  px-4 py-1">
                            <span class="text-start capitalize">Total a Pagar</span>
                            <span>$ {{ Number::format($totalPago, precision: 0,locale:'de')}}</span>
                        </div>

                    </div>
                </div>


                <div>
                    <h1 class="mb-2 font-bold">Método de pago</h1>
                    <x-radio label="" wire:model.live="tipoPago" :options="$metodosPago"/>
                </div>

                <div class="col-span-3">
                    <h1 class="mb-2 font-bold">Detalle del pago</h1>
                    @switch($tipoPago)
                        @case(\Src\Calculo\Domain\Enums\TipoPago::transferencia)
                    {{-- Transferencia --}}
                    <div class="flex gap-4 px-4 pt-2">
                        <div class="flex-none w-1/4 text-start pt-2">N° Transferencia</div>
                        <div class="flex-none w-3/4">
                            <x-mary-input wire:model="detalles.no_transferencia" class="input text-end" omit-error="true" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="flex gap-4 px-4 pt-2">
                        <div class="flex-none w-1/4 text-start pt-2">Banco</div>
                        <div class="flex-none w-3/4">
                            <x-select :options="$bancos" wire:model="detalles.banco_id"/>
                        </div>
                    </div>
                    <div class="flex gap-4 px-4 pt-2">
                        <div class="flex-none w-1/4 text-start pt-2">Comprobante</div>
                        <div class="flex-none w-3/4">
                            <x-file wire:model="detalles.evidencia"/>
                        </div>
                    </div>
                    {{-- Fin Transferencia --}}
                        @break
                    @case(\Src\Calculo\Domain\Enums\TipoPago::cheque)
                    {{-- Cheque --}}
                    <div class="flex gap-4 px-4 pt-2">
                        <div class="flex-none w-1/4 text-start pt-2">N° Cheque</div>
                        <div class="flex-none w-3/4">
                            <x-mary-input wire:model="detalles.no_cheque" class="input text-end" omit-error="true" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="flex gap-4 px-4 pt-2">
                        <div class="flex-none w-1/4 text-start pt-2">Banco</div>
                        <div class="flex-none w-3/4">
                            <x-select :options="$bancos" wire:model="detalles.banco_id"/>
                        </div>
                    </div>
                    <div class="flex gap-4 px-4 pt-2">
                        <div class="flex-none w-1/4 text-start pt-2">Vencimiento</div>
                        <div class="flex-none w-3/4">
                            <x-mary-input wire:model="detalles.vencimiento" type="date" class="input text-end" omit-error="true" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="flex gap-4 px-4 pt-2">
                        <div class="flex-none w-1/4 text-start pt-2">Imagen cheque</div>
                        <div class="flex-none w-3/4">
                            <x-file wire:model="detalles.evidencia">
                            </x-file>
                        </div>
                    </div>
                    {{-- Fin Cheque --}}
                            @break
                    @case(\Src\Calculo\Domain\Enums\TipoPago::enCliente)
                    {{-- Pago en Cliente --}}
                    <div class="flex gap-4 px-4 pt-2">
                        <div class="flex-none w-1/4 text-start pt-2">Cliente</div>
                        <div class="flex-none w-3/4">
                            <x-select :options="$clientes" wire:model="detalles.cliente_id"/>
                        </div>
                    </div>
                    <div class="flex gap-4 px-4 pt-2">
                        <div class="flex-none w-1/4 text-start pt-2">Fecha de pago</div>
                        <div class="flex-none w-3/4">
                            <x-mary-input wire:model="detalles.fecha_pago" type="date" class="input text-end" omit-error="true" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="flex gap-4 px-4 pt-2">
                        <div class="flex-none w-1/4 text-start pt-2">Archivo pago</div>
                        <div class="flex-none w-3/4">
                            <x-file wire:model="detalles.evidencia"/>
                        </div>
                    </div>
                    {{-- Fin Pago en Cliente --}}
                        @break

                    {{-- Pago Consignacion --}}
                    {{-- Fin Pago Consignacion ---}}
                    @endswitch
                </div>
            {{-- fin registro pago --}}
            </div>

{{--                <div>--}}
{{--                    <div class="camera">--}}
{{--                        <video id="video">Video stream not available.</video>--}}
{{--                        <button id="start-button" @click="activarCamara()">Capture photo</button>--}}
{{--                    </div>--}}

{{--                    <canvas id="canvas" style="display: none"></canvas>--}}
{{--                    <div class="output">--}}
{{--                        <img id="photo" alt="The screen capture will appear in this box." />--}}
{{--                    </div>--}}

{{--                    <button id="start-button" @click="takePicture()">tomar photo</button>--}}
{{--                </div>--}}



        </div>

        <script>
            function activarCamara() {
                const video = document.getElementById("video");
                video.addEventListener(
                    "canplay",
                    (ev) => {
                        const width = 640; // We will scale the photo width to this
                        let height = 0;
                        let streaming = false;
                        if (!streaming) {
                            height = video.videoHeight / (video.videoWidth / width);

                            video.setAttribute("width", width + 'px');
                            video.setAttribute("height", height + 'px');
                            canvas.setAttribute("width", width + 'px');
                            canvas.setAttribute("height", height + 'px');
                        }
                    },
                    false,
                );

                navigator.mediaDevices
                    .getUserMedia({ video: true, audio: false })
                    .then((stream) => {
                        video.srcObject = stream;
                        video.play();
                    })
                    .catch((err) => {
                        console.error(`An error occurred: ${err}`);
                    });
            }

            function takePicture() {
                const canvas = document.getElementById("canvas");
                const photo = document.getElementById("photo");
                const video = document.getElementById("video");
                const width = 480; // We will scale the photo width to this
                let height = 240;
                // video.setAttribute("width", width + 'px');
                // video.setAttribute("height", height+ 'px');
                canvas.setAttribute("width", width+ 'px');
                canvas.setAttribute("height", height+ 'px');
                const context = canvas.getContext("2d");
                if (width && height) {
                    canvas.width = width;
                    canvas.height = height;
                    context.drawImage(video, 0, 0, width, height);

                    const data = canvas.toDataURL("image/png");
                    photo.setAttribute("src", data);
                } else {
                    clearPhoto();
                }
            }
        </script>

        <x-slot:actions>
            <x-button label="Cancelar" wire:click="cancel()" class="btn-cds-action"/>
            <x-cds::button wire:click="guardar()" label="Guardar" class="btn-cds-action btn-primary" />

        </x-slot:actions>

    </x-cds::modal>
</div>
