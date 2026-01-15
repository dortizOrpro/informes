<?php

return [
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
    [
        'icon' => 'carbon.pdf',
        'title' => 'Fichas',
        'description' => 'Fichas de cobranzas seleccionadas',
        // 'action' => 'proceso.fichas-masivas',
        'route' => 'informes.fichas',
    ],
];
