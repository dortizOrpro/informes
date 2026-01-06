<table class="cabecera">
    <thead>
        <tr class="nomostrar">
            <td style="width: 20%;"></td>
            <td style="width: 60%;"></td>
            <td style="width: 20%;"></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
               @include('livewire.rendiciones.planillas.pdf.logo') 
            </td>
            <td class="cac">
                <p><b>ANEXO N° 1</b></p>
                <p><b>PLANILLA DE PAGO DE COTIZACIONES PREVISIONALES DECLARADAS FONDOS DE PENSIONES Y SEGURO DE CESANTIA</b></p>
                <p>(S&oacute;lo para trabajadores dependientes)</p>
            </td>
            <td class="nomostrar">Folio</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td class="bordes car">
                {{-- $cabecera[13] --}}
            </td>
        </tr>
    </tbody>
</table>