<table class="cabecera">
    <thead>
        <tr>
            <td style="width: 20%;"></td>
            <td style="width: 4%;"></td>
            <td style="width: 9%;"></td>
            <td style="width: 12%;"></td>
            <td style="width: 4%;"></td>
            <td style="width: 9%;"></td>
            <td style="width: 2%;"></td>
            <td style="width: 10%;"></td>
            <td style="width: 5%;"></td>
            <td style="width: 5%;"></td>
            <td style="width: 10%;"></td>
            <td style="width: 5%;"></td>
            <td style="width: 5%;"></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="6" class="bordes">
                <b style="font-size: 8pt!important">
                    SECCION III - RESUMEN DE COTIZACIONES Y DEPOSITOS DE AHORRO VOLUNTARIO
                </b>
            </td>
            <td>&nbsp;</td>
            <td colspan="6" class="bordes">
                <b style="font-size: 8pt!important">SECCION IV - ANTECEDENTES GENERALES</b>
            </td>
        </tr>

        <tr>
            <td colspan="3" class="bordes"><b>SUBSECCIÓN III.1. FONDOS DE PENSIONES</b></td>
            <td colspan="3" class="bordes"><b>SUBSECCIÓN III.2. A.F.P.</b></td>
            <td>&nbsp;</td>
            <td colspan="6" class="cac bl br">TIPO DE INGRESO</td>
        </tr>

        <tr>
            <td class="cac bordes">DETALLE</td>
            <td class="cac bordes">CODIGO</td>
            <td class="cac bordes">
                <p>Valores $</p>
                <p>(Sin Decimales)</p>
            </td>
            <td class="cac bordes">DETALLE</td>
            <td class="cac bordes">CODIGO</td>
            <td class="cac bordes">
                <p>Valores $</p>
                <p>(Sin Decimales)</p>
            </td>
            <td>&nbsp;</td>
            <td class="bl">REMUNERACIONES DEL MES</td>
            <td>
                <p class="box cac">X</p>
            </td>
            <td>Periodo</td>
            <td colspan="3" class="br">
                <p class="box car">
                    {{-- $cabecera[2] --}}
                </p>
            </td>
        </tr>

        <tr>
            <td class="bordes">Cotización Obligatoria</td>
            <td class="bordes">&nbsp;</td>
            <td class="car bordes">
                {{-- number_format((int) $cabecera[4],0,'','.') --}}
            </td>
            <td class="bordes">+ Recargo 20% Intereses</td>
            <td class="bordes">&nbsp;</td>
            <td class="car bordes">$ 0</td>
            <td>&nbsp;</td>
            <td colspan="6" class="bl br">TOTAL REMUNERACIONES</td>
        </tr>

        <tr>
            <td class="bordes">Cotización Voluntaria</td>
            <td class="bordes">&nbsp;</td>
            <td class="car bordes">$ 0</td>
            <td class="bordes">+ Costas de Cobranza</td>
            <td class="bordes">&nbsp;</td>
            <td class="car bordes">$ 0</td>
            <td>&nbsp;</td>
            <td colspan="2" class="bl">
                <p class="car box">
                    {{-- number_format((int) $cabecera[3],0,'','.') --}}
                </p>
            </td>
            <td colspan="4" class="br">&nbsp;</td>
        </tr>

        <tr>
            <td class="bordes">Depositos Convenidos</td>
            <td class="bordes">&nbsp;</td>
            <td class="car bordes">$ 0</td>
            <td class="bordes">TOTAL A PAGAR A.F.P.</td>
            <td class="bordes">&nbsp;</td>
            <td class="car bordes">$ 0</td>
            <td>&nbsp;</td>
            <td class="bl">Normal</td>
            <td class="bordes"></td>
            <td colspan="4" class="br">&nbsp;</td>
        </tr>

        <tr>
            <td class="bordes">Indemnización</td>
            <td class="bordes">&nbsp;</td>
            <td class="car bordes">$ 0</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="bl">Atrasada</td>
            <td class="bordes cac">X</td>
            <td colspan="4" class="br">&nbsp;</td>
        </tr>

        <tr>
            <td class="bordes">Depositos en Cta. de Ahorro</td>
            <td class="bordes">&nbsp;</td>
            <td class="car bordes">$ 0</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="bl">Adelantada</td>
            <td class="bordes"></td>
            <td colspan="2" style="text-align: right">Fecha de pago</td>
            <td colspan="2" class="br">
                <p class="box car">
                    {{-- $cabecera[12] --}}
                </p>
            </td>
        </tr>

        <tr>
            <td class="bordes">Sub Total a pagar Fondo de Pensiones</td>
            <td class="bordes">&nbsp;</td>
            <td class="car bordes">
                {{-- number_format((int) $cabecera[4],0,'','.') --}}
            </td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td>&nbsp;</td>
            <td rowspan="2" class="bl">Nro. afiliados informados</td>
            <td rowspan="2">
                <p class="box car">
                    {{-- $intAfiliados --}}
                </p>
            </td>
            <td></td>
            <td style="text-align: right">Número de hojas anexas</td>
            <td colspan="2" class="br">
                <p class="box car">
                    {{-- $intHojas --}}
                </p>
            </td>
        </tr>

        <tr>
            <td class="bordes">+ Reajustes Fondo de Pensiones</td>
            <td class="bordes">&nbsp;</td>
            <td class="car bordes">
                {{-- number_format((int) $cabecera[6],0,'','.') --}}
            </td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4" class="br">&nbsp;</td>
        </tr>

        <tr>
            <td class="bordes">+ Intereses Fondo de Pensiones</td>
            <td class="bordes">&nbsp;</td>
            <td class="car bordes">
                {{-- number_format((int) $cabecera[5],0,'','.') --}}
            </td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="6" class="br bl">&nbsp;</td>
        </tr>

        <tr>
            <td class="bordes">TOTAL A PAGAR FONDO DE PENSIONES</td>
            <td class="bordes">&nbsp;</td>
            <td class="car bordes">
                {{-- number_format((int) $cabecera[7],0,'','.') --}}
            </td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td class="bordes">&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="6" class="br bl bb">&nbsp;</td>
        </tr>
    </tbody>
</table>
