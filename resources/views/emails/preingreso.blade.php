<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Detalle de Deuda Previsional</title>
  <style>
    body {
      background: darkgrey;
      margin: 0;
      padding: 0;
    }
    .template-correo {
      font-family: Helvetica, Arial, sans-serif;
      text-align: justify;
      padding: 1rem;
      line-height: 1.5rem;
      font-size: 10pt;
      background: white;
      color: black;
      border: 1px solid grey;
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      width: 800px;
      box-sizing: border-box;
    }
    .template-correo h3 {
      font-size: 12pt;
      font-weight: bold;
    }
    .template-correo b {
      font-weight: bold;
    }
    .template-correo .border-r {
      border-radius: 1rem;
      border: 1px solid black;
      padding: 0.5rem;
      background: #EEE;
    }
    .template-correo .text-center {
      text-align: center;
    }
    .template-correo .text-info {
      color: darkred !important;
    }
    .template-correo .firma {
      vertical-align: top;
      padding-left: 1rem;
      font-size: 90%;
    }
    .template-correo .text-capital {
      text-transform: capitalize;
    }
    .template-correo .logo {
      height: 4.5rem;
    }
    .vista-previa-template-correo table th {
      background-color: rgba(0, 122, 193, 0.25);
    }
    .vista-previa-template-correo table th,
    .vista-previa-template-correo table td {
      border-bottom: 1px solid rgba(0, 122, 193, 0.75) !important;
    }
    .vista-previa-template-correo table {
      margin-bottom: 0;
      margin-top: 0;
    }
    .template-correo .nota {
      margin-top: 1rem;
      margin-bottom: 1rem;
      border-radius: 0rem;
      border: 1px solid black;
      padding: 0.5rem;
      background: #FFF;
      white-space: pre-line;
    }
    .boton-web {
      background: red;
      color: white;
      padding-left: 0.5rem;
      padding-right: 0.5rem;
      font-weight: bold;
      margin-left: 0.25rem;
      border: 1px solid red;
      text-decoration: none;
      display: inline-block;
    }
  </style>
</head>
<body>
  <div class="template-correo">
    <p class="text-capital">
      Señores:<br>
      Deudor
    </p>

    <p>
      Junto con saludar, envío adjunto detalle de deuda previsional&nbsp;
      N° {{ $preingreso }} por $ {{ number_format($a_pago, 0, ',', '.') }}
    </p>

    <p>Para ingresar su pago, envíenos el comprobante de transferencia o depósito:</p>
    <ul>
      <li>Ingresando al sitio web <a href="https://www.orpro.cl" target="_blank" rel="noopener">www.orpro.cl</a>, botón <b>Documentar pago</b>.</li>
      <li>Por correo electrónico a <a href="mailto:transferencias@orpro.cl">transferencias@orpro.cl</a> indicando el RUT y N° de liquidación.</li>
    </ul>

    <p>Atentamente,</p>
    <p>&nbsp;</p>

    <table role="presentation" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td>
          <!-- Aquí podrías insertar un logo si lo deseas -->
          <!-- <img src="cid:logo" alt="ORPRO" class="logo"> -->
        </td>
        <td class="firma">
          <p>
            <b>Estudio Jurídico ORPRO S.A.</b><br>
            Cobranzas y regularizaciones<br>
            <a href="mailto:transferencias@orpro.cl">transferencias@orpro.cl</a>
          </p>
        </td>
      </tr>
    </table>
  </div>
</body>
</html>