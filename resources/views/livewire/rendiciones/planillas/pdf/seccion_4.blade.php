<table class="cabecera">
    <thead>
        <tr>
            <td style="width: 22.10%;"></td>
            <td style="width: 22.10%;"></td>
            <td style="width: 14%;"></td>
            <td style="width: 1%;"></td>
            <td style="width: 7.10%;"></td>
            <td style="width: 22.10%;"></td>
            <td style="width: 1%;"></td>
            <td style="width: 14%;"></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="6" class="bordes">
                <b style="font-size: 8pt!important">SECCION V - ANTECEDENTES SOBRE EL PAGO</b>
            </td>
            <td rowspan="7">&nbsp;</td>
            <td rowspan="7" class="bordes" style="">
                @include('livewire.rendiciones.planillas.pdf.timbre')
            </td>
        </tr>

        <tr>
            <td colspan="2" class="bordes">FONDO DE PENSIONES</td>
            <td colspan="4" class="bordes">A.F.P.</td>
        </tr>

        <tr>
            <td class="bl">
                <p class="cac">
                    <span>EFECTIVO</span>
                    <span class="box" style="width: 10%; height: 6pt; margin-left:1rem"></span>
                </p>
            </td>
            <td class="br">
                <p class="cac">
                    <span>CHEQUE</span>
                    <span class="box" style="width: 10%; height: 6pt; margin-left:1rem"></span>
                </p>
            </td>
            <td colspan="3">
                <p class="cac">
                    <span>EFECTIVO</span>
                    <span class="box" style="width: 10%; height: 6pt; margin-left:1rem"></span>
                </p>
            </td>
            <td class="br">
                <p class="cac">
                    <span>CHEQUE</span>
                    <span class="box" style="width: 10%; height: 6pt; margin-left:1rem"></span>
                </p>
            </td>
        </tr>

        <tr>
            <td colspan="2" class="bl br">CHEQUE NOMINATIVO A: FONDO DE PENSIONES</td>
            <td colspan="4" class="br">CHEQUE NOMINATIVO A: A.F.P.</td>
        </tr>

        <tr>
            <td colspan="2" class="bl br bb">Cheque Nro. _______________ Banco _______________ Plaza _______________</td>
            <td colspan="4" class="br bb">Cheque Nro. _______________ Banco _______________ Plaza _______________</td>
        </tr>

        <tr>
            <td colspan="6"></td>
        </tr>

        <tr>
            <td class="bl bt bb" style="vertical-align: top; padding: 1rem">
                Declaro bajo juramento que los datos consignados son expresión fiel de la realidad
            </td>
            <td colspan="2" class="br bt bb cac" style="vertical-align: bottom; padding-right: 1rem">
                <p style="border-top: 1px solid black">
                    Firma del Empleador o Representante Legal
                </p>
            </td>
            <td>&nbsp;</td>
            <td colspan="2" class="bordes cac" style="vertical-align: top;">
                V° B° RECEPCIÓN Y CÁLCULO
            </td>
        </tr>
    </tbody>
</table>
