<table class="firma">
    <tbody>
        <tr>
            <td class="col1">
                <a href="#">
                    <img class="qr" src="{{ $qr }}" />
                </a>
                <br />
                <span class="label-qr">&nbsp;{{ $urlQr }}&nbsp;</span>
            </td>
            <td class="col2">
                <p>Generado por&nbsp;{{-- $preingreso->usuario --}}Usuario de prueba</p>
                <p>Agencia&nbsp;{{-- $preingreso->agencia --}}----</p>
                <p>{{ date('d-m-Y H:i:s', strtotime($vencimiento)) }}</p>
            </td>
        </tr>
    </tbody>
</table>
