<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&display=swap"
          rel="stylesheet">
</head>
<body class="min-h-screen font-sans antialiased bg-base-100">

<div class="sticky top-0 z-50">

<div class="bg-secondary text-secondary-content flex w-full py-2 pl-4 h-[3rem] items-center">
    <div class="w-1/4 border-r-neutral border-r">
        <span class="font-semibold">daisyUI</span>
    </div>

{{--    <div class="flex-1">--}}
{{--        <div class="dropdown dropdown-hover pl-4">--}}
{{--            <div tabindex="0" role="button" class="btn btn-secondary justify-between hover:bg-secondary-content/20">--}}
{{--                <div>Menu</div>--}}
{{--                <div>--}}
{{--                    <x-icon name="carbon.chevron-down"/>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <ul tabindex="0" class="dropdown-content bg-secondary/80 menu rounded-box z-1 w-52 p-2 shadow-xl">--}}
{{--                <x-menu-item title="Archive" icon="o-archive-box" />--}}
{{--                <x-menu-item title="Remove" icon="o-trash" class="hover:bg-secondary-content/20" />--}}
{{--                <x-menu-item title="Restore" icon="o-arrow-path" class="hover:bg-secondary-content/20" />--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}


    <div class="flex-1">


        <ul class="jm-navbar-menu">
            <li><a>Item 1</a></li>
            <li>    <details>
                    <summary>Parent</summary>
                    <ul class="w-56 bg-secondary !mt-2">
                        <li>
                            <a>
                                <x-icon name="carbon.receipt" label="Recibo"/>
                                Submenu 1
                            </a>
                        </li>
                        <li><a>Submenu 2</a></li>
                        <li>
                            <details>
                                <summary>Parent</summary>
                                <ul>
                                    <li><a href="/calculadora" wire:navigate>Submenu 1</a></li>
                                    <li><a>Submenu 2</a></li>
                                </ul>
                            </details>
                        </li>
                    </ul>
                </details>
            </li>
            <li><a>Item 2</a></li>

            <li><a>Item 3</a></li>
        </ul>
    </div>








    <div class="flex-none">

        <label for="side-menu-drawer" class="drawer-button btn btn-secondary">
            <x-icon name="carbon.switcher" class="border-0"/>
        </label>

        <div class="drawer drawer-end z-50">
            <input id="side-menu-drawer" type="checkbox" class="drawer-toggle"/>
            <div class="drawer-side mt-[3rem]">
                <label for="side-menu-drawer" aria-label="close sidebar" class="drawer-overlay"></label>

                <div class="bg-secondary text-secondary-content min-h-full w-64 border-t-secondary-content/50 border-t">
                    <div class="p-4">
                        <x-avatar placeholder="RT" class="h-12 w-12">
                            <x-slot:title class="text-xl !font-bold">
                                @if($user = auth()->user())
                                    {{ $user->name }}
                                @else
                                    Anonimo
                                @endif

                            </x-slot:title>
                            <x-slot:subtitle class="text-neutral-content">
                                @if($user = auth()->user())
                                    <p>{{$user->perfil }}</p>
                                @else
                                    --
                                @endif
                            </x-slot:title>
                        </x-avatar>
                    </div>
                    <x-menu class="!p-0">
                        <x-menu-item title="Remesas" icon="carbon.box" link="/remesas"/>
                        <x-menu-item title="Cobranzas" icon="carbon.document-multiple-01" link="https://sgc-cobranzas.orpro.cl" external="true"/>
                        <x-menu-item title="Recaudación" icon="carbon.money" link="https://sgc-recaudacion.orpro.cl" external="true"/>

                        <x-menu-item title="Consignaciones" icon="carbon.receipt" link="https://sgc-consignaciones.orpro.cl" external="true"/>
                        {{--                <x-menu-item title="Rendiciones" icon="carbon.calculation-alt" link="/" disabled/>--}}
                        {{--                <x-menu-item title="Judicial" icon="carbon.finance" link="/" disabled/>--}}
                        {{--                <x-menu-item title="Reportes" icon="carbon.delivery-parcel" link="/" disabled/>--}}
                        <x-menu-item title="Salir" icon="carbon.logout" link="/logout" no-wire-navigate="true"/>
                    </x-menu>

                </div>

            </div>
        </div>

    </div>
</div>

    <div class="breadcrumbs text-sm ps-4 bg-base-300">
        <ul>
            <li>
                <label for="app-menu-drawer" class="drawer-button btn btn-xs btn-ghost p-0">
                    <x-icon name="carbon.menu" class="border-0"/>
                </label>
            </li>
            <li><a>Home</a></li>
            <li><a>Documents</a></li>
            <li>Add Document</li>
        </ul>
    </div>


    {{-- APPLICATION MENU --}}
    <div class="drawer z-50">
        <input id="app-menu-drawer" type="checkbox" class="drawer-toggle"/>
        <div class="drawer-side mt-[84px]">
            <label for="app-menu-drawer" aria-label="close sidebar" class="drawer-overlay"></label>

            <div class="bg-base-200 text-base-content min-h-full w-64 border-t border-t-base-300">
                <x-menu class="!p-0">
                    <x-menu-item title="Remesas" icon="carbon.box" link="/remesas"/>
                    <x-menu-item title="Cobranzas" icon="carbon.document-multiple-01" link="https://sgc-cobranzas.orpro.cl" external="true"/>
                    <x-menu-item title="Recaudación" icon="carbon.money" link="https://sgc-recaudacion.orpro.cl" external="true"/>

                    <x-menu-item title="Consignaciones" icon="carbon.receipt" link="https://sgc-consignaciones.orpro.cl" external="true"/>
                    {{--                <x-menu-item title="Rendiciones" icon="carbon.calculation-alt" link="/" disabled/>--}}
                    {{--                <x-menu-item title="Judicial" icon="carbon.finance" link="/" disabled/>--}}
                    {{--                <x-menu-item title="Reportes" icon="carbon.delivery-parcel" link="/" disabled/>--}}
                    <x-menu-item title="Salir" icon="carbon.logout" link="/logout" no-wire-navigate="true"/>
                </x-menu>

            </div>

        </div>
    </div>
    {{--/ APPLICATION MENU --}}






</div>

<div class="w-full z-0">
    {{ $slot }}
</div>

</body>
</html>
