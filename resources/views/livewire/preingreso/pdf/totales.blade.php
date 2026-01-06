@php
    $adeudado = $totales->capital + $totales->reajuste + $totales->intereses + $totales->recargo + $totales->procuraduria;
@endphp

<h3>Fecha actualización: {{ date('d/m/Y', strtotime($vencimiento)) }}</h3>
<table class="table cobranza">
    <thead>
        <tr>
            <th class="text-left">DETALLE</th>
            <th>MONTO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-left">TOTAL ADEUDADO</td>
            <td>${{ number_format($adeudado, 0, ',', '.') }}</td>
        </tr>

        @if ($totales->gastos > 0)
        <tr>
            <td class="text-left">TOTAL COSTAS PROCESALES</td>
            <td>${{ number_format($totales->gastos, 0, ',', '.') }}</td>
        </tr>
        @endif

        @if ($totales->honorarios > 0)
        <tr>
            <td class="text-left">TOTAL HONORARIOS</td>
            <td>${{ number_format($totales->honorarios, 0, ',', '.') }}</td>
        </tr>
        @endif

        @if ($totales->procuraduria > 0)
        <tr>
            <td class="text-left">TOTAL PROCURADURIA</td>
            <td>${{ number_format($totales->procuraduria, 0, ',', '.') }}</td>
        </tr>
        @endif

        @if ($totales->iva > 0)
        <tr>
            <td class="text-left">TOTAL I.V.A.</td>
            <td>${{ number_format($totales->iva, 0, ',', '.') }}</td>
        </tr>
        @endif

        <tr>
            <td class="text-left"><strong>TOTAL A PAGAR</strong></td>
            <td><strong>${{ number_format($a_pago, 0, ',', '.') }}</strong></td>
        </tr>
    </tbody>
</table>

<div class="intro">
    <p>&nbsp;</p>
    <p>En el anexo se encuentra detallado los períodos y montos adeudados.</p>
</div>
