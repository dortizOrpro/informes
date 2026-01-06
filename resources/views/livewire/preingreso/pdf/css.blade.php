<style type="text/css">
    html {
        width: 8.5in;
        height: 11in;
        background: white;
    }

    h3 {
        font-family: Helvetica, sans-serif;
        font-size: 11pt;
        text-transform: uppercase;
    }

    @page {
        margin: 1cm 1cm 0.5cm;
        background: white;
    }

    body {
        font-family: courier, monospace;
        font-size: 8pt;
        margin-top: 1.3in;
        counter-reset: pagina;
        width: 7.7in;
        background: white;
        border: none;
    }

    p {
        margin-bottom: 0;
    }

    table {
        width: 100%;
    }

    .bloque-cabecera {
        background: white;
        top: 0;
        width: 7.7in;
        position: fixed;
    }

    .cabecera {
        width: 100%;
        padding: 0;
    }

    .cabecera .col01 {
        text-align: left;
        width: 20%;
    }

    .cabecera .col03 {
        width: 20%;
    }

    .cabecera img {
        width: 2cm;
    }

    .cabecera .col02 {
        font-family: helvetica, sans-serif;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 20px;
        vertical-align: middle;
        text-align: center;
    }

    .cabecera .col02 .p01 {
        margin: 0;
    }

    .cabecera .col02 .p02 {
        font-size: 12px;
        margin: 0;
    }

    .cabecera .col03 {
        /*border: 4px solid gray;*/
        text-align: right;
        font-family: courier, monospace;
        text-transform: capitalize;
        font-weight: bold;
        color: gray;
        font-size: 8pt;
        vertical-align: top;
    }

    .bloque-cabecera p.rut {
        text-align: right;
        font-family: courier, monospace;
        color: gray;
        font-size: 6pt;
    }

    .folio p {
        padding: 0;
        margin: 4px;
        font-family: courier, monospace;
    }

    .xfolio p:nth-child(3) {
        font-size: 8pt;
        color: gray;
    }

    .folio span.numpagina::before {
        counter-increment: pagina;
        content: counter(pagina);
    }

    table.cobranza-titulo {
        width: 100%;
        font-family: helvetica, sans-serif;
        text-transform: uppercase;
        border-collapse: collapse;
        margin-top: 0;
        font-size: 110%;
        margin-bottom: 0.25rem;
    }

    table.cobranza-titulo td {
        padding-left: 4px;
    }

    table.cobranza-titulo tr td.col2 {
        text-align: left;
        font-weight: bold;
        width: 13.571428571%;
    }

    table.cobranza-titulo tr td.col3 {
        font-weight: normal;
    }

    table.cobranza-titulo tr td.col1 {
        text-align: right;
        font-weight: bold;
        border: 1px solid;
        width: 5%;
        padding: 0.25rem;
    }

    table.cobranza {
        width: 100%;
        font-family: helvetica, sans-serif;
        text-transform: uppercase;
        border-collapse: collapse;
        margin-top: 0;
        margin-bottom: 0;
    }

    table.cobranza-celdas tr td:nth-child(1) {
        width: 5%;
    }

    table.cobranza-celdas tr td:nth-child(2),
    table.cobranza-celdas tr td:nth-child(3),
    table.cobranza-celdas tr td:nth-child(4),
    table.cobranza-celdas tr td:nth-child(5),
    table.cobranza-celdas tr td:nth-child(6),
    table.cobranza-celdas tr td:nth-child(7),
    table.cobranza-celdas tr td:nth-child(8) {
        width: 13.571428571%;
    }

    table.liquidacion-total tbody tr td:nth-child(1) {
      width: 59.285714284%;
      border: none;
    }

    table.liquidacion-total tbody tr td:nth-child(2) {
      width: 27.142857142%;
      text-align: left;
    }

    table.cobranza thead tr th {
        border: 1px solid black;
        padding: 4px;
        background: lightgray;
        font-weight: bold;
    }

    .cobranza-tabla {
        width: 100%;
        font-family: helvetica, sans-serif;
        text-transform: uppercase;
        border-collapse: collapse;
        margin-top: 0;
        margin-bottom: 0;
    }

    .gris {
        border: 1px solid black;
        padding: 4px;
        background: lightgray;
        font-weight: bold;
    }

    .celda {
        text-align: right;
        border: 1px solid black;
        padding: 4px;
        font-weight: bold;
    }

    .cobranza-tabla tbody td,
    table.cobranza tbody td {
        text-align: right;
        border: 1px solid black;
        padding: 3px;
    }

    table.cobranza tfoot tr td:nth-child(1) {
        background: white;
    }

    table.cobranza tfoot tr td:nth-child(2) {
        border: 1px solid black;
        padding: 4px;
        background: lightgray;
        font-weight: bold;
    }

    table.cobranza tfoot tr td:nth-child(3) {
        border: 1px solid black;
        padding: 4px;
        font-weight: bold;
        text-align: right;
    }

    .intro {
        font-family: helvetica, sans-serif;
        font-size: 130%;
        text-align: justify;
    }

    .intro p {
        margin-top: 0px;
        margin-bottom: 6pt;
    }

    .bloque-cobranza {
        /*page-break-inside:avoid;*/
        margin-bottom: 1.5rem;
        margin-top: 0.5rem;
    }

    .bloque-pie {
        /* position: fixed; */
        bottom: 0.5rem;
        width: 100%;
    }

    .bloque-pie table.info {
        table-layout: fixed;
        font-size: 6pt;
        color: gray;
        width: 100%;
    }

    .bloque-pie table.info td.col1 {
        text-align: left;
    }

    .bloque-pie table.info td.col2 {
        text-align: center;
    }

    .bloque-pie table.info td.col3 {
        text-align: right;
    }

    td.border-0 {
        border: 1px solid transparent !important;
    }

    .border-b {
        border-bottom: 1px solid black !important;
    }

    .intro {
        font-family: helvetica, sans-serif;
        font-size: 130%;
        text-align: justify;
    }

    .zona-qr {
        width: 6rem;
        text-align: center;
        background: green;
    }

    .qr {
        width: 4rem;
        height: 4rem;
    }

    .label-qr {
        font-family: courier, monospace !important;
        font-size: 100%;
        font-weight: bold;
    }

    table.firma {
        width: 100%;
        font-family: 'courier', monospace;
        text-transform: uppercase;
        border-collapse: collapse;
        margin-top: 0;
        font-size: 110%;
        margin-bottom: 0.25rem;
    }

    table.firma {
        /* position: absolute; */
        bottom: 2.5cm;
    }

    table.firma tbody td.col1 {
        width: 6rem;
        text-align: center;
    }

    table.firma tbody td.col2 {
        vertical-align: top;
    }

    table.firma tbody td.col2 p {
        padding: 0;
        margin: 0 0 0.25rem;
    }

    .corte-pagina {
        page-break-before: always;
    }

    .no-cortar {
        page-break-inside: avoid;
    }

    .deposito {
        padding-bottom: 1.5in;
    }

    .bloque-afiliado {
        /*page-break-inside:avoid;*/
        margin-bottom: 1.5rem;
        margin-top: 0.5rem;
    }

    table.afiliado-titulo {
        width: 100%;
        font-family: helvetica, sans-serif;
        text-transform: uppercase;
        border-collapse: collapse;
        margin-top: 0;
        font-size: 110%;
        margin-bottom: 0.25rem;
    }

    table.afiliado-titulo td {
        padding-left: 4px;
    }

    table.afiliado-titulo tr td.col2 {
        text-align: left;
        font-weight: bold;
        width: 13.571428571%;
    }

    table.afiliado-titulo tr td.col3 {
        font-weight: normal;
    }

    table.afiliado-titulo tr td.col1 {
        text-align: right;
        font-weight: bold;
        border: 1px solid;
        width: 5%;
        padding: 0.25rem;
    }

    table.afiliados {
        width: 100%;
        font-family: helvetica, sans-serif;
        text-transform: uppercase;
        border-collapse: collapse;
        margin-top: 0;
        margin-bottom: 0;
        page-break-inside: auto;
    }

    table.afiliados tr td.col1 {
        width: 5%;
        text-align: right;
        border: 1px solid black;
    }

    table.afiliados tr td.col2 {
        text-align: right;
        width: 13.571428571%;
        border: 1px solid black;
    }

    table.afiliados tr td.colnombre {
        text-align: left;
        width: 54.285714287%;
        border: 1px solid black;
    }

    table.afiliados thead tr th {
        border: 1px solid black;
        padding: 4px;
        background: lightgray;
        font-weight: bold;
        text-align: center;
    }

    .bloque-con-pago {
        border: 2px solid #2020c0;
        width: 10.5rem;
        padding: 0.5rem;
        position: fixed;
        top: 0.5rem;
        right: 0;
    }

    .bloque-con-pago p {
        font-weight: bold;
        color: #2020c0;
        margin: 0;
        padding: 0;
        text-align: center;
        text-transform: uppercase;
        font-family: 'courier', monospace;
        font-size: 0.6rem;
    }
    .bloque-con-pago p.text-left {
      text-align: left;
    }
    .bloque-con-pago p.text-right {
      text-align: right;
    }

    .text-left {
        text-align: left !important;
    }
    .bloque-con-pago p.separador {
      border-bottom: 1px dashed #2020c0;
      margin: 0.25rem 0 0.25rem 0;
    }
    .tachado {
        text-decoration: line-through;
    }
    .text-center {
        text-align: center;
    }
    .box {
        border: 1px solid grey !important;
        padding: 0.5rem !important;
    }
    .anulada {
        font-family: helvetica, sans-serif;
        position: fixed;
        font-size: 10rem;
        transform: rotate(-45deg);
        color: red;
        opacity: 0.7;
        left: -1rem;
        top: 22%;
    }
    .boton-web {
        background: red;
        color: white;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        padding-top: 0.25rem;
        font-weight: bold;
        margin-left: 0.25rem;
        border: 1px solid red;
    }

    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
    }
</style>
