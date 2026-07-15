<?php

return [
    [
        'icon' => 'carbon.container.registry',
        'title' => 'Actividad Masiva',
        'description' => 'Informar actividad masiva',
        // 'action' => 'proceso.fichas-masivas',
        'route' => 'actividades.masivas',
    ],
    [
        'icon' => 'carbon.pdf',
        'title' => 'Fichas',
        'description' => 'Fichas de cobranzas seleccionadas',
        // 'action' => 'proceso.fichas-masivas',
        'route' => 'informes.fichas',
    ],
    [
        'icon' => 'carbon.xls',
        'title' => 'Cronologias de clientes',
        'description' => 'Cronologías de clientes por rango de fechas',
        // 'action' => 'informe.cronologias',
        'route' => 'informes.cronologias',
    ],
    [
        'icon' => 'carbon.xls',
        'title' => 'Tablas cronologias',
        'description' => 'Tablas de equivalencias actividades Orpro/Cliente',
        // 'action' => 'informe.tablas-cronologias',
        'route' => 'informes.equivalencias',
    ],
];
