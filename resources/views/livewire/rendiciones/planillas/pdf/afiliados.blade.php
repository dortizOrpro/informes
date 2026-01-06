<table class="cabecera">
    <thead>
        <tr>
            <td style="width: 2%;"></td>
            <td style="width: 8%;"></td>
            <td style="width: 42%;"></td>
            <td style="width: 8%;"></td>
            <td style="width: 8%;"></td>
            <td style="width: 8%;"></td>
            <td style="width: 8%;"></td>
            <td style="width: 8%;"></td>
            <td style="width: 8%;"></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="9" class="bordes">
                <b>SECCION II - DETALLE DE COTIZACIONES Y DEPOSITOS DE AHORRO VOLUNTARIO</b>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="bordes">IDENTIFICACION DEL TRABAJADOR</td>
            <td colspan="6" class="bordes">FONDO DE PENSIONES</td>
        </tr>
        <tr>
            <td class="bordes">N°</td>
            <td class="bordes">
                <p class="cac">
                    R.U.T. o CI<br class="br-0">(con digito verif.)
                </p>
            </td>
            <td class="bordes">APELLIDO PATERNO, APELLIDO MATERNO Y NOMBRES</td>
            <td class="bordes">
                <p class="cac">Remuneración Imponible $</p>
            </td>
            <td class="bordes">
                <p class="cac">Cotización obligatoria $</p>
            </td>
            <td class="bordes">
                <p class="cac">Cotización voluntaria $</p>
            </td>
            <td class="bordes">
                <p class="cac">Deposito Convenido $</p>
            </td>
            <td class="bordes">
                <p class="cac">Indemnización $</p>
            </td>
            <td class="bordes">
                <p class="cac">Cuenta de Ahorro $</p>
            </td>
        </tr>

        {{-- 
            - $intSumaRem = 0
            - $intSumaCot = 0
            each $afiliado,$index in $datos
                - $arrAfiRut = explode('-',$afiliado[8])
                - $strAfiRut = number_format((int) $arrAfiRut[0], 0, '', '.') . '-'.$arrAfiRut[1]
                - $intSumaRem = $intSumaRem + (int) $afiliado[10]
                - $intSumaCot = $intSumaCot + (int) $afiliado[11]
        --}}

        <tr>
            <td class="bordes">&nbsp; {{-- $index + 1 --}}</td>
            <td class="bordes car">&nbsp; {{-- $strAfiRut --}}</td>
            <td class="bordes">&nbsp; {{-- $afiliado[9] --}}</td>
            <td class="bordes car">&nbsp; {{-- $afiliado[10] --}}</td>
            <td class="bordes car">&nbsp; {{-- $afiliado[11] --}}</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="3" class="bordes"><b>TOTAL DETALLE</b></td>
            <td class="bordes car">&nbsp; {{-- $intSumaRem --}}</td>
            <td class="bordes car">&nbsp; {{-- $intSumaCot --}}</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
        </tr>
    </tbody>
</table>
