<!--
    #{print_r($sumario, true)}
-->

<h3>Anexo</h3>
<table class="table cobranza">
    <thead>
        <tr>
            <th>N°</th>
            <th>COBRANZA</th>
            <th>INSTITUCION</th>
            <th>DOCUMENTO</th>
            <th>PERIODO</th>
            <th>CAPITAL</th>
            <th>A PAGO</th>
        </tr>
    </thead>
    <tbody>
        @php $fila = 0; @endphp
        @foreach ($detalle as $row)
            @php $fila++; @endphp
            <tr>
                <td>{{ $fila }}</td>
                <td>{{ $row->cobranza }}</td>
                <td>{{ $row->cliente }}</td>
                <td>{{ $row->resolucion }}</td>
                <td>{{ $row->periodo }}</td>
                <td>${{ number_format((int)$row->capital, 0, ',', '.') }}</td>
                <td>${{ number_format((int)$row->apago, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p>&nbsp;</p>

<p class="intro text-center">
    Este documento es solo para informar el monto de sus deudas previsionales y en ningún caso constituye prueba o evidencia de pagos recibidos por Orpro S.A.
</p>
