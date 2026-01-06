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

<x-cds::nav sticky full-width class="bg-secondary z-50 h-[3rem]">
    <x-slot:left-actions>

    </x-slot:left-actions>
    <x-slot:brand>
        <x-icon name="carbon.circle-filled" class="text-secondary-content"
                label="Sistema de Gestión de Cobranzas 2025 -- TEST"/>

    </x-slot:brand>

    <x-slot:actions>

        <label for="side-menu-drawer" class="absolute right-0 drawer-button btn btn-secondary">
            <x-icon name="carbon.switcher" class="border-0"/>
        </label>
    </x-slot:actions>
</x-cds::nav>

{{-- APPLICATION MENU --}}
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
                <hr class="bg-secondary border-accent"/>
                <x-menu-item title="Recaudación" icon="carbon.money" link="/"/>
                <div class="pl-4">
                    <x-menu-item title="Calculadora" icon="carbon.calculation-alt" link="/calculadora"/>
                    <x-menu-item title="Rendiciones" icon="carbon.data-view-alt" link="/rendiciones"/>
                </div>
                <hr class="bg-secondary border-accent"/>
                <x-menu-item title="Remesas" icon="carbon.box" link="https://sgc-remesas.orpro.cl" external="true"/>
                <x-menu-item title="Cobranzas" icon="carbon.document-multiple-01" link="https://sgc-cobranzas.orpro.cl" external="true"/>
                <x-menu-item title="Consignaciones" icon="carbon.receipt" link="https://sgc-consignaciones.orpro.cl" external="true"/>

                <x-menu-item title="Tramitación" icon="carbon.scales" link="https://sgc-tramitacion.orpro.cl" external="true"/>

                <x-menu-item title="Contactos" icon="carbon.identification" link="https://sgc-contactos.orpro.cl" external="true"/>
                <x-menu-item title="Contactabilidad" icon="carbon.mail-all" link="https://sgc-contactabilidad.orpro.cl" external="true"/>
                <x-menu-item title="Inconcert" icon="carbon.phone-application" link="https://sgc-inconcert.orpro.cl" external="true"/>
                <x-menu-item title="Reportes" icon="carbon.report" link="https://sgc-reportes.orpro.cl" external="true"/>
                <x-menu-item title="Salir" icon="carbon.logout" link="/logout" no-wire-navigate="true"/>
            </x-menu>

        </div>

    </div>
</div>
{{--/ APPLICATION MENU --}}

{{-- BREADCRUM --}}
<div class="bg-base-300 py-1 px-2 sticky top-[3rem] z-20">
    <div class="breadcrumbs text-sm ms-4">
        <ul>
            @foreach(explode('.',\Illuminate\Support\Facades\Route::currentRouteName()) as $item)
                <li>
                    @if($item === 'inicio')
                        <a class="capitalize" href="/">{{ $item }}</a>
                    @else
                        <span class="capitalize">{{ $item }}</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
{{--/ BREADCRUM --}}

{{-- CONTENIDO --}}
<div class="w-full z-0">
    {{ $slot }}
</div>
{{--<x-cds::main full-width with-nav collapse-text="" collapse-icon="carbon.menu">--}}
{{--    <x-slot:content>--}}
{{--        {{ $slot }}--}}
{{--    </x-slot:content>--}}
{{--</x-cds::main>--}}
{{--/ CONTENIDO --}}

<x-toast/>
{{--@include('sweetalert2::index')--}}
</body>
</html>
