{{-- Variables originales en Pug/PHP --}}
{{--
$cabecera = $datos[0]
$arrRut = explode('-', $cabecera[0])
$strRut = number_format((int) $arrRut[0],0,'','.') . '-' . $arrRut[1]
$intAfiliados = count($datos)
$intHojas = floor($intAfiliados / 20) + 1
$arrPeriodo = explode('/', $cabecera[2])
$arrDeposito = explode('/', $cabecera[12])
$strKeywords = "R" . (int)$arrRut[0] . "P" . trim($arrPeriodo[1]) . trim($arrPeriodo[0]) . "D" . trim($arrDeposito[2]) . trim($arrDeposito[1]).trim($arrDeposito[0])
--}}

<!DOCTYPE html>
<html>
<head>
    <meta name="contenido" content="Planilla">
    {{-- include planilla.estilo.pug --}}
    @include('livewire.rendiciones.planillas.pdf.planilla_estilo') 
</head>
<body>

    {{-- Portada --}}
    {{-- $portada = true --}}
    @include('livewire.rendiciones.planillas.pdf.cabecera')
    <p class="sep"></p>
    @include('livewire.rendiciones.planillas.pdf.seccion_1')
    <p class="sep"></p>
    @include('livewire.rendiciones.planillas.pdf.seccion_3')
    <p class="sep"></p>
    @include('livewire.rendiciones.planillas.pdf.seccion_4')

    <div class="salto-pagina"></div>

    {{-- Segunda parte sin portada --}}
    {{-- $portada = false --}}
    @include('livewire.rendiciones.planillas.pdf.cabecera')
    <p class="sep"></p>
    @include('livewire.rendiciones.planillas.pdf.seccion_1')
    <p class="sep"></p>
    @include('livewire.rendiciones.planillas.pdf.afiliados')

</body>
</html>
